<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Helpers\Helper;
use App\Models\Financial;
use App\Repositories\Contracts\FinancialRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
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

    public function dataTables($column, $view)
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
        $data['original'] = Helper::replaceDecimal($data['original']);
        $data['discount'] = Helper::replaceDecimal($data['discount']);
        $data['fine'] = Helper::replaceDecimal($data['fine']);
        $data['rate'] = Helper::replaceDecimal($data['rate']);
        $data['payment'] = Helper::replaceDecimal($data['payment']);
        return $data;
    }

}
