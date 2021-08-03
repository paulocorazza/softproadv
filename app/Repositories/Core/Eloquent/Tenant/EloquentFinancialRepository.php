<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Helpers\Helper;
use App\Models\Financial;
use App\Repositories\Contracts\FinancialRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentFinancialRepository extends BaseEloquentRepository
    implements FinancialRepositoryInterface
{
    public function model()
    {
        return Financial::class;
    }

    public function dataTables($column, $view, $request = null)
    {
        $model = $this->model
            ->query()
            ->with(['person', 'process']);


        return Datatables()->eloquent($model)
            ->addColumn($column, $view)
            ->editColumn('due_date', function ($model) {
                return Helper::formatDateTime($model->due_date, 'd/m/Y');
            })

            ->editColumn('payday', function ($model) {
                return isset($model->payday) ?  Helper::formatDateTime($model->payday, 'd/m/Y') : null;
            })
            ->make(true);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $data = $this->replaceValues($data);

            $financial = parent::create($data);

            if (!$financial) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível salvar o registro'
                ];
            }

            DB::commit();

            return ['status' => true];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível salvar o registro.' . $e->getMessage()
            ];
        }

    }

    public function update($id, array $data)
    {
        if (!$financial = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }


        DB::beginTransaction();

        try {
            $data = $this->replaceValues($data);

            $financial->update($data);

            if (!$financial) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível atualizar o registro'
                ];
            }


            DB::commit();

            return ['status' => true];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível atualizar o registro.' . $e->getMessage()
            ];
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function replaceValues(array $data): array
    {
        $data['honorary'] = isset($data['honorary']) ? 'S' : 'N';
        $data['register'] = isset($data['register']);
        $data['original'] = Helper::replaceDecimal($data['original']);
        $data['discount'] = isset($data['discount']) ? Helper::replaceDecimal($data['discount']) : 0;
        $data['fine'] = isset($data['fine']) ? Helper::replaceDecimal($data['fine']) : 0;
        $data['rate'] =  isset($data['rate']) ? Helper::replaceDecimal($data['rate']) : 0;
        $data['payment'] = Helper::replaceDecimal($data['payment']);
        return $data;
    }


    public function honorarys(Request $request)
    {
        $filtro = $request->all();

        return $this->model::where(function ($query) use ($filtro) {
            $query->whereBetween($filtro['date_for'], array($filtro['data_inicial'], $filtro['data_final']));
            $query->where('honorary', 'S');

            if ($filtro['person_id']) {
                $query->where('person_id', $filtro['person_id']);
            }
        })->get();
    }

    public function financial(Request $request)
    {
        $filtro = $request->all();

        $data = $this->model::with('person')->where(function ($query) use ($filtro) {
            $query->whereBetween($filtro['date_for'], array($filtro['data_inicial'], $filtro['data_final']));

            if ($filtro['person_id']) {
                $query->where('person_id', $filtro['person_id']);
            }

            if ($filtro['type']) {
                $query->where('type', $filtro['type']);
            }

            if ($filtro['status'] == 'baixado') {
                $query->whereNotNull('payday');
            }

            if ($filtro['status'] == 'aberto') {
                $query->whereNull('payday');
            }


        })->latest($filtro['date_for'])->get();


        return $data->groupBy('type');
    }

}
