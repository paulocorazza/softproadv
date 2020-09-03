<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getProfiles($id);
    public function getProfilesNotIn($user);
    public function getAdvogados();
    public function getUsersView($id);
    public function getUsersViewNotIn($id);
 }
