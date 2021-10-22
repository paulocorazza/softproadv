<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class MeetPermissionsTableSeeder extends Seeder
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
            ['name' => 'meets',       'label' => 'Gestão de Atendimentos'],
            ['name' => 'create_meet', 'label' => 'Criar uma novo Atendimento'],
            ['name' => 'update_meet', 'label' => 'Alterar um Atendimento'],
            ['name' => 'view_meet',   'label' => 'Visualizar um Atendimento'],
            ['name' => 'delete_meet', 'label' => 'Excluir um Atendimento'],
        ]);
    }
}
