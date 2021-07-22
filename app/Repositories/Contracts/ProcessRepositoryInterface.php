<?php

namespace App\Repositories\Contracts;

use App\Models\Process;

interface ProcessRepositoryInterface
{
    public function updateContract($id, array $data);
    public function replaceTags(Process $process) : string;
}

