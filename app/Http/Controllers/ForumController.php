<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ForumRepositoryInterface;

class ForumController extends ControllerStandard
{
    public function __construct(ForumRepositoryInterface $forum)
    {
        $this->model = $forum;
        $this->title = 'Fórum';
        $this->view = 'tenants.forums';
        $this->route = 'forums';

        $this->middleware('can:forums');

        $this->middleware('can:create_forum')->only(['create', 'store']);
        $this->middleware('can:update_forum')->only(['edit', 'update']);
        $this->middleware('can:view_forum')->only(['show']);
        $this->middleware('can:delete_forum')->only(['delete']);
    }
}
