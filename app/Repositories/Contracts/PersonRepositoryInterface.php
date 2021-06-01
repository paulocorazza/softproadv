<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface PersonRepositoryInterface
{
    public function getPersonProcesses(Request $request);
    public function getPersonProcessesFinancial(Request $request);
}

