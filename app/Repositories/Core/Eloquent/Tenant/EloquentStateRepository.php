<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


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


    public function dataTables($column, $view, $request = null)
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


    public function getCities($id)
    {
        if ($id) {

            $state = $this->relationships('cities')->where('iso', '=', $id)->first();

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

    public function getStates()
    {
        return $this->model->orderBy('title', 'ASC')
            ->get()
            ->pluck('title', 'id');
    }
}
