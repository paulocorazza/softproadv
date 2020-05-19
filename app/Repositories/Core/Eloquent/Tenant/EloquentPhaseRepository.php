<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Phase;
use App\Repositories\Contracts\PhaseRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentPhaseRepository extends BaseEloquentRepository
    implements PhaseRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return  Phase::class;
    }

    public function getPhases()
    {
        return $this->model->orderBy('name', 'ASC')
                           ->get()
                           ->pluck('name', 'id');
    }


    public function getStagesSelect($id)
    {
        if ($id) {

            $phase = $this->relationships([
                'stages' => function ($query) {
                    $query->orderBy('name');
                }
            ])->find($id);

            return [
                'status'  => true,
                'data'    => $phase->stages,
            ];
        }

        return [
            'status' => false,
            'message' => 'Não foi possível realizar a pesquisa.'
        ];
    }
}
