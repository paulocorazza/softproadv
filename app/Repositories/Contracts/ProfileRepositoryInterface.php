<?php

namespace App\Repositories\Contracts;

interface ProfileRepositoryInterface
{
    public function getUsers($id);
    public function getUserNotIn($profile);
    public function getPermissions($id);
    public function getPermissionNotInt($profile);
}
