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

        $this->middleware('can:create_countries')->only(['create', 'store']);
        $this->middleware('can:update_countries')->only(['edit', 'update']);
        $this->middleware('can:view_countries')->only(['show']);
        $this->middleware('can:delete_countries')->only(['delete']);
    }

    public function getStatesByName($id, Request $request)
    {
        $return = $this->model->getStatesByName($id, $request);

        if (!$return['status']) {
            return redirect()->back()
                             ->withErrors($return['message']);
        }

        return response()->json($return['data']);
    }
}
