<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getProfiles($id);
    public function getProfilesNotIn($user);
    public function getAdvogados();
 }
