<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TypeAddressRepositoryInterface;

class TypeAddressController extends ControllerStandard
{
    public function __construct(TypeAddressRepositoryInterface $typeAddress)
    {
        $this->model = $typeAddress;
        $this->title = 'Tipos de Endereço';
        $this->view = 'tenants.typeAddress';
        $this->route = 'type-address';

        $this->middleware('can:type_address');

        $this->middleware('can:create_type_address')->only(['create', 'store']);
        $this->middleware('can:update_type_address')->only(['edit', 'update']);
        $this->middleware('can:view_type_address')->only(['show']);
        $this->middleware('can:delete_type_address')->only(['delete']);
    }
}
