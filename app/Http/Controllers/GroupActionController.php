<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\GroupActionRepositoryInterface;

class GroupActionController extends ControllerStandard
{
    public function __construct(GroupActionRepositoryInterface $group)
    {
        $this->model = $group;
        $this->title = 'Grupo de Ação';
        $this->view = 'tenants.group-actions';
        $this->route = 'group-actions';

        $this->middleware('can:group_actions');

        $this->middleware('can:create_group_action')->only(['create', 'store']);
        $this->middleware('can:update_group_action')->only(['edit', 'update']);
        $this->middleware('can:view_group_action')->only(['show']);
        $this->middleware('can:delete_group_action')->only(['delete']);
    }
}
