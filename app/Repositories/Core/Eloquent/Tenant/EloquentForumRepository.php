<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Forum;
use App\Repositories\Contracts\ForumRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentForumRepository extends BaseEloquentRepository
    implements ForumRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Forum::class;
    }

    public function getForums()
    {
        return $this->model->orderBy('name')
                            ->get()
                            ->pluck('name', 'id');
    }
}
