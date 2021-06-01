<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
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
            /** USER */
            ['name' => 'users',       'description' => 'Gestão de Usuários'],
            ['name' => 'create_user', 'description' => 'Criar um novo Usuário'],
            ['name' => 'update_user', 'description' => 'Alterar um Usuário'],
            ['name' => 'view_user',   'description' => 'Visualizar um Usuário'],
            ['name' => 'delete_user', 'description' => 'Excluir um Usuário'],


            /** PROFILES */
            ['name' => 'profiles',       'description' => 'Gestão de Perfis'],
            ['name' => 'create_profile', 'description' => 'Criar um novo Perfil'],
            ['name' => 'update_profile', 'description' => 'Alterar um Perfil'],
            ['name' => 'view_profile',   'description' => 'Visualizar um Perfil'],
            ['name' => 'delete_profile', 'description' => 'Excluir um Perfil'],

            /** PERMISSIONS */
            ['name' => 'permissions',       'description' => 'Gestão de Permissões'],
            ['name' => 'create_permission', 'description' => 'Criar um nova Permissão'],
            ['name' => 'update_permission', 'description' => 'Alterar uma Permissão'],
            ['name' => 'view_permission',   'description' => 'Visualizar uma Permissão'],
            ['name' => 'delete_permission', 'description' => 'Excluir uma Permissão'],


            /** PERMISSIONS x PROFILES */
            ['name' => 'view_user_profile',        'description' => 'Visualizar Perfis do Usuário'],
            ['name' => 'view_profile_users',       'description' => 'Visualizar Usuários do Perfil'],
            ['name' => 'view_profile_permissions', 'description' => 'Visualizar Permissões do Perfil'],
            ['name' => 'view_permission_profile',  'description' => 'Visualizar Perfis da Permissão'],


            /** CITIES */
            ['name' => 'cities',      'description' => 'Gestão de Cidades'],
            ['name' => 'create_city', 'description' => 'Criar uma nova Cidade'],
            ['name' => 'update_city', 'description' => 'Alterar uma Cidade'],
            ['name' => 'view_city',   'description' => 'Visualizar uma Cidade'],
            ['name' => 'delete_city', 'description' => 'Excluir uma Cidade'],


            /** COUNTRIES */
            ['name' => 'countries',      'description' => 'Gestão de Países'],
            ['name' => 'create_country', 'description' => 'Criar um novo País'],
            ['name' => 'update_country', 'description' => 'Alterar um País'],
            ['name' => 'view_country',   'description' => 'Visualizar um País'],
            ['name' => 'delete_country', 'description' => 'Excluir um País'],


            /** STATES */
            ['name' => 'states',      'description' => 'Gestão de Estado'],
            ['name' => 'create_state', 'description' => 'Criar um novo Estado'],
            ['name' => 'update_state', 'description' => 'Alterar um Estado'],
            ['name' => 'view_state',   'description' => 'Visualizar um Estado'],
            ['name' => 'delete_state', 'description' => 'Excluir um Estado'],

            /** DISTRICT */
            ['name' => 'districts',       'description' => 'Gestão de Comarcas'],
            ['name' => 'create_district', 'description' => 'Criar uma nova Comarca'],
            ['name' => 'update_district', 'description' => 'Alterar uma Comarca'],
            ['name' => 'view_district',   'description' => 'Visualizar uma Comarca'],
            ['name' => 'delete_district', 'description' => 'Excluir uma Comarca'],

            /** EVENTS */
            ['name' => 'events',       'description' => 'Gestão de Atividades'],
            ['name' => 'create_event', 'description' => 'Criar uma nova Atividade'],
            ['name' => 'update_event', 'description' => 'Alterar uma Atividade'],
            ['name' => 'view_event',   'description' => 'Visualizar uma Atividade'],
            ['name' => 'delete_event', 'description' => 'Excluir uma Atividade'],

            /** FINANCIAL */
            ['name' => 'financials',       'description' => 'Gestão Financeira'],
            ['name' => 'create_financial', 'description' => 'Criar um novo contas a pagar / receber'],
            ['name' => 'update_financial', 'description' => 'Alterar um contas a pagar / receber'],
            ['name' => 'view_financial',   'description' => 'Visualizar um contas a pagar / receber'],
            ['name' => 'delete_financial', 'description' => 'Excluir um contas a pagar / receber'],

            /** FINANCIAL CATEGORY */
            ['name' => 'financial-category',        'description' => 'Gestão Categoria Financeira'],
            ['name' => 'create_financial_category', 'description' => 'Criar uma nova Categoria Financeira'],
            ['name' => 'update_financial_category', 'description' => 'Alterar um Categoria Financeira'],
            ['name' => 'view_financial_category',   'description' => 'Visualizar um Categoria Financeira'],
            ['name' => 'delete_financial_category', 'description' => 'Excluir um Categoria Financeira'],

            /** FINANCIAL CATEGORY */
            ['name' => 'financial-account',        'description' => 'Gestão Conta Financeira'],
            ['name' => 'create_financial_account', 'description' => 'Criar uma nova Conta Financeira'],
            ['name' => 'update_financial_account', 'description' => 'Alterar um Conta Financeira'],
            ['name' => 'view_financial_account',   'description' => 'Visualizar um Conta Financeira'],
            ['name' => 'delete_financial_account', 'description' => 'Excluir um Conta Financeira'],


            /** FORUM */
            ['name' => 'forums',       'description' => 'Gestão de Fóruns'],
            ['name' => 'create_forum', 'description' => 'Criar uma novo Fórum'],
            ['name' => 'update_forum', 'description' => 'Alterar um Fórum'],
            ['name' => 'view_forum',   'description' => 'Visualizar um Fórum'],
            ['name' => 'delete_forum', 'description' => 'Excluir um Fórum'],

            /** GROUP ACTION */
            ['name' => 'group_actions',       'description' => 'Gestão de Grupo de Ações'],
            ['name' => 'create_group_action', 'description' => 'Criar uma novo Grupo de Ações'],
            ['name' => 'update_group_action', 'description' => 'Alterar um Grupo de Ações'],
            ['name' => 'view_group_action',   'description' => 'Visualizar um Grupo de Ações'],
            ['name' => 'delete_group_action', 'description' => 'Excluir um Grupo de Ações'],

            /** ORIGINS */
            ['name' => 'origins',       'description' => 'Gestão de Origins'],
            ['name' => 'create_origin', 'description' => 'Criar uma nova Origem'],
            ['name' => 'update_origin', 'description' => 'Alterar uma Origem'],
            ['name' => 'view_origin',   'description' => 'Visualizar uma Origem'],
            ['name' => 'delete_origin', 'description' => 'Excluir uma Origem'],

            /** PEOPLE */
            ['name' => 'people',       'description' => 'Gestão de Pessoas'],
            ['name' => 'create_person', 'description' => 'Criar uma nova Pessoa'],
            ['name' => 'update_person', 'description' => 'Alterar uma Pessoa'],
            ['name' => 'view_person',   'description' => 'Visualizar uma Pessoa'],
            ['name' => 'delete_person', 'description' => 'Excluir uma Pessoa'],

            /** PHASE */
            ['name' => 'phases',       'description' => 'Gestão de Fases'],
            ['name' => 'create_phase', 'description' => 'Criar uma nova Fase'],
            ['name' => 'update_phase', 'description' => 'Alterar uma Fase'],
            ['name' => 'view_phase',   'description' => 'Visualizar uma Fase'],
            ['name' => 'delete_phase', 'description' => 'Excluir uma Fase'],

            /** PROCESSES */
            ['name' => 'processes',      'description' => 'Gestão de Processos'],
            ['name' => 'create_process', 'description' => 'Criar uma novo Processo'],
            ['name' => 'update_process', 'description' => 'Alterar um Processo'],
            ['name' => 'view_process',   'description' => 'Visualizar um Processo'],
            ['name' => 'delete_process', 'description' => 'Excluir um Processo'],


            /** SCHEDULE */
            ['name' => 'schedule',      'description' => 'Agenda'],


            /** STAGES */
            ['name' => 'stages',       'description' => 'Gestão de Etapas'],
            ['name' => 'create_stage', 'description' => 'Criar uma nova Etapa'],
            ['name' => 'update_stage', 'description' => 'Alterar uma Etapa'],
            ['name' => 'view_stage',   'description' => 'Visualizar uma Etapa'],
            ['name' => 'delete_stage', 'description' => 'Excluir uma Etapa'],


           /** STICKS */
            ['name' => 'sticks',       'description' => 'Gestão de Varas'],
            ['name' => 'create_stick', 'description' => 'Criar uma nova Vara'],
            ['name' => 'update_stick', 'description' => 'Alterar uma Vara'],
            ['name' => 'view_stick',   'description' => 'Visualizar uma Vara'],
            ['name' => 'delete_stick', 'description' => 'Excluir uma Vara'],

            /** TYPE ACTION */
            ['name' => 'type_actions',       'description' => 'Gestão de Varas'],
            ['name' => 'create_type_action', 'description' => 'Criar uma nova Vara'],
            ['name' => 'update_type_action', 'description' => 'Alterar uma Vara'],
            ['name' => 'view_type_action',   'description' => 'Visualizar uma Vara'],
            ['name' => 'delete_type_action', 'description' => 'Excluir uma Vara'],
            ['name' => 'view_type_action_phases', 'description' => 'Visualizar Fases do Tipo de Ação'],

            /** TYPE ADDRESS */
            ['name' => 'type_address',       'description' => 'Gestão de Tipos de Endereços'],
            ['name' => 'create_type_address', 'description' => 'Criar uma novo Tipo de Endereço'],
            ['name' => 'update_type_address', 'description' => 'Alterar um Tipo de Endereço'],
            ['name' => 'view_type_address',   'description' => 'Visualizar um Tipo de Endereço'],
            ['name' => 'delete_type_address', 'description' => 'Excluir um Tipo de Endereço'],


            /** REPORTS */
            ['name' => 'rel-honorary',                'description' => 'Relatório de Honorários'],
            ['name' => 'rel-financial-process',       'description' => 'Relatório de Ficha Financeira'],
            ['name' => 'rel-financial',               'description' => 'Relatório de Contas a Pagar / Receber'],
        ]);
    }
}
