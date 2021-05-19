<?php

namespace App\Repositories\Contracts;

use App\Models\District;

interface DistrictRepositoryInterface
{
    public function getSticks($id);
    public function getDistricts();
    public function getSticksAvailable(District $district);
}

