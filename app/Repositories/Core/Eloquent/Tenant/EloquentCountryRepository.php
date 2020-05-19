<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentCountryRepository extends BaseEloquentRepository
    implements CountryRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Country::class;
    }

    public function getStates($id)
    {
        if ($id) {
            $country = $this->relationships([
                'states' => function ($query) {
                    $query->orderBy('initials');
                }
            ])->find($id);

            return [
                'status' => true,
                'data' => $country->states
            ];
        }

        return [
            'status' => false,
            'message' => 'Não foi possível realizar a pesquisa.'
        ];
    }


    public function getCountries()
    {
        return $this->model->get()->pluck('name', 'id');
    }
}
