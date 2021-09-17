<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class MonitorTableSeeder extends Seeder
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
            /** MONITOR */
            ['name' => 'monitor_start',       'label' => 'Iniciar monitoramento de um processo'],
            ['name' => 'monitor_stop', 'label' => 'Encerrar monitoramento de um processo'],
            ['name' => 'monitor_delete', 'label' => 'Excluir o monitoramento de um processo'],
            ['name' => 'monitor_progress',   'label' => 'Menu de monitoramento de andamentos'],
            ['name' => 'monitor_oab',   'label' => 'Menu de monitoramento de OAB'],
        ]);
    }
}
