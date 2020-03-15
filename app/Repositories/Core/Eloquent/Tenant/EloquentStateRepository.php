<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Country;
use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Http\Request;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentStateRepository extends BaseEloquentRepository
    implements StateRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return State::class;
    }


    public function dataTables($column, $view)
    {
        $model = $this->model
                      ->query()
                      ->with('country');


        return Datatables()->eloquent($model)
                           ->addColumn($column, $view)
           /* ->addColumn('pais', function ($query) {
                return $query->country->name;
            } ) */
                           ->make(true);

    }


    public function getCitiesByName($id, Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $state = $this->relationships([
                'cities' => function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                }
            ])->find($id);

            return [
              'status'  => true,
              'data'    => $state->cities,
            ];
        }

        return [
            'status' => false,
            'message' => 'Não foi possível realizar a pesquisa.'
        ];
    }

    public function getCountries()
    {
        return Country::get()->pluck('name', 'id');
    }
}
