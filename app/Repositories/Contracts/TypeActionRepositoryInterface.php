<?php

namespace App\Repositories\Contracts;

interface TypeActionRepositoryInterface
{
    public function getPhases($id);
    public function getPhasesNotIn($typeAction);
    public function getPhasesSelect($id);
}

