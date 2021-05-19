<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DistrictRepositoryInterface;
use Illuminate\Http\Request;

class DistrictController extends ControllerStandard
{
    public function __construct(DistrictRepositoryInterface $district)
    {
        $this->model = $district;
        $this->title = 'Comarca';
        $this->view = 'tenants.districts';
        $this->route = 'districts';

        $this->middleware('can:districts');

        $this->middleware('can:create_district')->only(['create', 'store']);
        $this->middleware('can:update_district')->only(['edit', 'update']);
        $this->middleware('can:view_district')->only(['show']);
        $this->middleware('can:delete_district')->only(['delete']);
    }

    public function sticks($id)
    {
        if (request()->ajax()) {
            return $this->model->getSticks($id);
        }

        $district = $this->model->find($id);

        $title = 'Varas da Comarca: ' . $district->name;

        return view('tenants.districts.sticks', compact('district', 'title'));
    }

    public function listSticks($id)
    {
        $district = $this->model->find($id);

        $sticks = $this->model->getSticksAvailable($district);

        $title = 'Vincular perfil a permissão: ' . $district->name;

        return view('tenants.districts.sticks-add', compact('district', 'sticks', 'title'));
    }

    public function AddSticks(Request $request, $id)
    {
        $dataForm = $request->get('sticks');

        $district = $this->model->find($id);


        $district->sticks()->attach($dataForm);

        return redirect()->route('districts.sticks', $district->id)
            ->with('success', 'Vara(s) adicionado com sucesso!');
    }

    public function deleteStick($id, $stickId)
    {
        $district = $this->model->find($id);

        $stick = $district->sticks()->detach($stickId);

        return redirect()->route('districts.sticks', $district->id)
            ->with('success', 'Vara removida com sucesso!');

    }
}
