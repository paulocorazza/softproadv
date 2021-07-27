<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\City;
use App\Models\Person;
use App\Models\State;
use App\Repositories\Contracts\PersonRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentPersonRepository extends BaseEloquentRepository
    implements PersonRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    /**
     * @param array $data
     * @param $person
     * @return bool
     */
    private function saveAddress(array $data, $person)
    {
        if (isset($data['addresses'])) {
            foreach ($data['addresses'] as $item) {

                $id = ($item['id'] > 0) ? $item['id'] : 0;

                $item['state_id'] = State::where('iso', $item['iso'])->first()->id;
                $item['city_id'] = City::where('iso', $item['city_iso'])->first()->id;

                $insert = $person->addresses()->updateOrCreate(['id' => $id], $item);

                if (!$insert) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }


    /**
     * @param array $data
     * @param $person
     * @return bool
     */
    private function saveContacts(array $data, $person)
    {
        if (isset($data['contacts'])) {
            foreach ($data['contacts'] as $item) {

                $id = ($item['id'] > 0) ? $item['id'] : 0;

                $insert = $person->contacts()->updateOrCreate(['id' => $id], $item);

                if (!$insert) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Person::class;
    }

    public function dataTables($column, $view)
    {

        $model = $this->model->query();

        return Datatables()
            ->eloquent($model)
            ->addColumn($column, $view)
            ->filterColumn('type_person_list', function ($query, $keyword) {
                $query->whereJsonContains('type_person', "$keyword");
            })
            ->make(true);
    }


    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $data['type_person'] = json_encode($data['type_person'], JSON_UNESCAPED_UNICODE);

            $data['state'] = (isset($data['state']) ? 'I' : 'A');
            $data['user_id'] = Auth::user()->id;

            $person = parent::create($data);

            $addresses = $this->saveAddress($data, $person);
            $contacts = $this->saveContacts($data, $person);


            if (!$person || !$addresses || !$contacts) {
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
        if (!$person = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }

        DB::beginTransaction();
        try {
            $data['type_person'] = json_encode($data['type_person'], JSON_UNESCAPED_UNICODE);

            $data['state'] = (isset($data['state']) ? 'I' : 'A');

            $person->update($data);

            $addresses = $this->saveAddress($data, $person);
            $contacts = $this->saveContacts($data, $person);

            if (!$person || !$addresses || !$contacts) {
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


    public function getPersonProcesses(Request $request)
    {
        $data = [];

        if ($request->has('q') && !empty($request->q)) {

            $search = $request->q;

            $data = DB::table('processes')
                        ->select('processes.id', DB::raw('CONCAT(processes.number_process, \' - \', people.name) AS process'))
                        ->join('people', 'processes.person_id', '=', 'people.id')
                        ->orWhere('processes.number_process', 'like', "%$search%")
                        ->orWhere('people.name', 'LIKE', "%$search%")
                        ->orWhere('people.cpf', 'LIKE', "%$search%")
                        ->get();

            return [
                'status' => true,
                'data' => $data,
            ];
        }

        return [
            'status' => true,
            'data' => $data,
        ];
    }


    public function getPersonProcessesFinancial(Request $request)
    {
        $filtro = $request->all();

        return $this->model
            ->whereHas('processes.financials', function ($query) use ($filtro) {
                return $query->whereBetween($filtro['date_for'], array($filtro['data_inicial'], $filtro['data_final']));
            })
            ->with('processes.financials', function ($query) use ($filtro) {
                return $query->whereBetween($filtro['date_for'], array($filtro['data_inicial'], $filtro['data_final']));
            })
            ->select(['id', 'name', 'fantasy'])
            ->where(function ($query) use ($filtro) {
                if ($filtro['person_id']) {
                    return $query->where('id', $filtro['person_id']);
                }
            })
            ->get();
    }
}
