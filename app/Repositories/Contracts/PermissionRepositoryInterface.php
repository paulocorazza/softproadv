<?php

namespace App\Repositories\Contracts;

interface PermissionRepositoryInterface
{
    public function getProfiles($id);
    public function getProfilesNotIn($permission);
}
