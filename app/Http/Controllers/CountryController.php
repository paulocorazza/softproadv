<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Http\Request;

class CountryController extends ControllerStandard
{
    public function __construct(CountryRepositoryInterface $country)
    {
        $this->model = $country;
        $this->title = 'Pais';
        $this->view = 'tenants.countries';
        $this->route = 'countries';

        $this->middleware('can:countries');

        $this->middleware('can:create_country')->only(['create', 'store']);
        $this->middleware('can:update_country')->only(['edit', 'update']);
        $this->middleware('can:view_country')->only(['show']);
        $this->middleware('can:delete_country')->only(['delete']);
    }

    public function getStates($id)
    {

        $return = $this->model->getStates($id);

        if (!$return['status']) {
            return redirect()->back()
                             ->withErrors($return['message']);
        }

        return response()->json($return['data']);
    }
}
