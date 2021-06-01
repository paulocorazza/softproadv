<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface FinancialRepositoryInterface
{
    public function honorarys(Request $request);
    public function financial(Request $request);
}

