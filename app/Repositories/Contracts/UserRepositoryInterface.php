<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getProfiles($id);
    public function getProfilesNotIn($user);
    public function getAdvogados();
    public function getUsersView($id);
    public function getUsersViewNotIn($id);
    public function rulesProfile($id = '');
    public function getStatesMonitors($id);
    public function getStatesNotIn($user);
    public function saveStates(User $user, array $dataform);
 }
