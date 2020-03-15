<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Http\Request;


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

    public function getStatesByName($id, Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $country = $this->relationships([
                'states' => function ($query) use ($search) {
                    $query->where('initials', 'LIKE', "%$search%");
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
}
