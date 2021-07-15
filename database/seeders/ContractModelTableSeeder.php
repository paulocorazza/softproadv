<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class ContractModelTableSeeder extends Seeder
{
    public function __construct(private Permission $permission)
    {
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->permission->insert([
            /** CONTRACT MODEL */
            ['name' => 'contracts',       'label' => 'Gestão de Modelo de Contratos'],
            ['name' => 'create_contract', 'label' => 'Criar um novo Modelo de Contrato'],
            ['name' => 'update_contract', 'label' => 'Alterar um Modelo de Contrato'],
            ['name' => 'view_contract',   'label' => 'Visualizar um Modelo de Contrato'],
            ['name' => 'delete_contract', 'label' => 'Excluir um Modelo de Contrato'],
        ]);
    }
}
