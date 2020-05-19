<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\GroupAction;
use App\Repositories\Contracts\GroupActionRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentGroupActionRepository extends BaseEloquentRepository
    implements GroupActionRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return GroupAction::class;
    }


    public function getGroupActions()
    {
        return $this->model->orderBy('name', 'ASC')
                           ->get()
                           ->pluck('name', 'id');
    }

    public function getTypeActions($id)
    {
          if ($id) {

            $group = $this->relationships([
                'type_actions' => function ($query) {
                    $query->orderBy('name');
                }
            ])->find($id);

            return [
                'status'  => true,
                'data'    => $group->type_actions,
            ];
        }

        return [
            'status' => false,
            'message' => 'Não foi possível realizar a pesquisa.'
        ];
    }
}
