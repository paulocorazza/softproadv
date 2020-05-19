<?php

namespace App\Repositories\Contracts;

interface GroupActionRepositoryInterface
{
    public function getGroupActions();
    public function getTypeActions($id);

}

