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
            ['name' => 'users',       'label' => 'Gestão de Usuários'],
            ['name' => 'create_user', 'label' => 'Criar um novo Usuário'],
            ['name' => 'update_user', 'label' => 'Alterar um Usuário'],
            ['name' => 'view_user',   'label' => 'Visualizar um Usuário'],
            ['name' => 'delete_user', 'label' => 'Excluir um Usuário'],


            /** PROFILES */
            ['name' => 'profiles',       'label' => 'Gestão de Perfis'],
            ['name' => 'create_profile', 'label' => 'Criar um novo Perfil'],
            ['name' => 'update_profile', 'label' => 'Alterar um Perfil'],
            ['name' => 'view_profile',   'label' => 'Visualizar um Perfil'],
            ['name' => 'delete_profile', 'label' => 'Excluir um Perfil'],

            /** PERMISSIONS */
            ['name' => 'permissions',       'label' => 'Gestão de Permissões'],
            ['name' => 'create_permission', 'label' => 'Criar um nova Permissão'],
            ['name' => 'update_permission', 'label' => 'Alterar uma Permissão'],
            ['name' => 'view_permission',   'label' => 'Visualizar uma Permissão'],
            ['name' => 'delete_permission', 'label' => 'Excluir uma Permissão'],


            /** PERMISSIONS x PROFILES */
            ['name' => 'view_user_profile',        'label' => 'Visualizar Perfis do Usuário'],
            ['name' => 'view_profile_users',       'label' => 'Visualizar Usuários do Perfil'],
            ['name' => 'view_profile_permissions', 'label' => 'Visualizar Permissões do Perfil'],
            ['name' => 'view_permission_profile',  'label' => 'Visualizar Perfis da Permissão'],


            /** CITIES */
            ['name' => 'cities',      'label' => 'Gestão de Cidades'],
            ['name' => 'create_city', 'label' => 'Criar uma nova Cidade'],
            ['name' => 'update_city', 'label' => 'Alterar uma Cidade'],
            ['name' => 'view_city',   'label' => 'Visualizar uma Cidade'],
            ['name' => 'delete_city', 'label' => 'Excluir uma Cidade'],


            /** COUNTRIES */
            ['name' => 'countries',      'label' => 'Gestão de Países'],
            ['name' => 'create_country', 'label' => 'Criar um novo País'],
            ['name' => 'update_country', 'label' => 'Alterar um País'],
            ['name' => 'view_country',   'label' => 'Visualizar um País'],
            ['name' => 'delete_country', 'label' => 'Excluir um País'],


            /** STATES */
            ['name' => 'states',      'label' => 'Gestão de Estado'],
            ['name' => 'create_state', 'label' => 'Criar um novo Estado'],
            ['name' => 'update_state', 'label' => 'Alterar um Estado'],
            ['name' => 'view_state',   'label' => 'Visualizar um Estado'],
            ['name' => 'delete_state', 'label' => 'Excluir um Estado'],

            /** DISTRICT */
            ['name' => 'districts',       'label' => 'Gestão de Comarcas'],
            ['name' => 'create_district', 'label' => 'Criar uma nova Comarca'],
            ['name' => 'update_district', 'label' => 'Alterar uma Comarca'],
            ['name' => 'view_district',   'label' => 'Visualizar uma Comarca'],
            ['name' => 'delete_district', 'label' => 'Excluir uma Comarca'],

            /** EVENTS */
            ['name' => 'events',       'label' => 'Gestão de Atividades'],
            ['name' => 'create_event', 'label' => 'Criar uma nova Atividade'],
            ['name' => 'update_event', 'label' => 'Alterar uma Atividade'],
            ['name' => 'view_event',   'label' => 'Visualizar uma Atividade'],
            ['name' => 'delete_event', 'label' => 'Excluir uma Atividade'],

            /** FINANCIAL */
            ['name' => 'financials',       'label' => 'Gestão Financeira'],
            ['name' => 'create_financial', 'label' => 'Criar um novo contas a pagar / receber'],
            ['name' => 'update_financial', 'label' => 'Alterar um contas a pagar / receber'],
            ['name' => 'view_financial',   'label' => 'Visualizar um contas a pagar / receber'],
            ['name' => 'delete_financial', 'label' => 'Excluir um contas a pagar / receber'],

            /** FINANCIAL CATEGORY */
            ['name' => 'financial-category',        'label' => 'Gestão Categoria Financeira'],
            ['name' => 'create_financial_category', 'label' => 'Criar uma nova Categoria Financeira'],
            ['name' => 'update_financial_category', 'label' => 'Alterar um Categoria Financeira'],
            ['name' => 'view_financial_category',   'label' => 'Visualizar um Categoria Financeira'],
            ['name' => 'delete_financial_category', 'label' => 'Excluir um Categoria Financeira'],

            /** FINANCIAL CATEGORY */
            ['name' => 'financial-account',        'label' => 'Gestão Conta Financeira'],
            ['name' => 'create_financial_account', 'label' => 'Criar uma nova Conta Financeira'],
            ['name' => 'update_financial_account', 'label' => 'Alterar um Conta Financeira'],
            ['name' => 'view_financial_account',   'label' => 'Visualizar um Conta Financeira'],
            ['name' => 'delete_financial_account', 'label' => 'Excluir um Conta Financeira'],


            /** FORUM */
            ['name' => 'forums',       'label' => 'Gestão de Fóruns'],
            ['name' => 'create_forum', 'label' => 'Criar uma novo Fórum'],
            ['name' => 'update_forum', 'label' => 'Alterar um Fórum'],
            ['name' => 'view_forum',   'label' => 'Visualizar um Fórum'],
            ['name' => 'delete_forum', 'label' => 'Excluir um Fórum'],

            /** GROUP ACTION */
            ['name' => 'group_actions',       'label' => 'Gestão de Grupo de Ações'],
            ['name' => 'create_group_action', 'label' => 'Criar uma novo Grupo de Ações'],
            ['name' => 'update_group_action', 'label' => 'Alterar um Grupo de Ações'],
            ['name' => 'view_group_action',   'label' => 'Visualizar um Grupo de Ações'],
            ['name' => 'delete_group_action', 'label' => 'Excluir um Grupo de Ações'],

            /** ORIGINS */
            ['name' => 'origins',       'label' => 'Gestão de Origins'],
            ['name' => 'create_origin', 'label' => 'Criar uma nova Origem'],
            ['name' => 'update_origin', 'label' => 'Alterar uma Origem'],
            ['name' => 'view_origin',   'label' => 'Visualizar uma Origem'],
            ['name' => 'delete_origin', 'label' => 'Excluir uma Origem'],

            /** PEOPLE */
            ['name' => 'people',       'label' => 'Gestão de Pessoas'],
            ['name' => 'create_person', 'label' => 'Criar uma nova Pessoa'],
            ['name' => 'update_person', 'label' => 'Alterar uma Pessoa'],
            ['name' => 'view_person',   'label' => 'Visualizar uma Pessoa'],
            ['name' => 'delete_person', 'label' => 'Excluir uma Pessoa'],

            /** PHASE */
            ['name' => 'phases',       'label' => 'Gestão de Fases'],
            ['name' => 'create_phase', 'label' => 'Criar uma nova Fase'],
            ['name' => 'update_phase', 'label' => 'Alterar uma Fase'],
            ['name' => 'view_phase',   'label' => 'Visualizar uma Fase'],
            ['name' => 'delete_phase', 'label' => 'Excluir uma Fase'],

            /** PROCESSES */
            ['name' => 'processes',      'label' => 'Gestão de Processos'],
            ['name' => 'create_process', 'label' => 'Criar uma novo Processo'],
            ['name' => 'update_process', 'label' => 'Alterar um Processo'],
            ['name' => 'view_process',   'label' => 'Visualizar um Processo'],
            ['name' => 'delete_process', 'label' => 'Excluir um Processo'],


            /** SCHEDULE */
            ['name' => 'schedule',      'label' => 'Agenda'],


            /** STAGES */
            ['name' => 'stages',       'label' => 'Gestão de Etapas'],
            ['name' => 'create_stage', 'label' => 'Criar uma nova Etapa'],
            ['name' => 'update_stage', 'label' => 'Alterar uma Etapa'],
            ['name' => 'view_stage',   'label' => 'Visualizar uma Etapa'],
            ['name' => 'delete_stage', 'label' => 'Excluir uma Etapa'],


           /** STICKS */
            ['name' => 'sticks',       'label' => 'Gestão de Varas'],
            ['name' => 'create_stick', 'label' => 'Criar uma nova Vara'],
            ['name' => 'update_stick', 'label' => 'Alterar uma Vara'],
            ['name' => 'view_stick',   'label' => 'Visualizar uma Vara'],
            ['name' => 'delete_stick', 'label' => 'Excluir uma Vara'],

            /** TYPE ACTION */
            ['name' => 'type_actions',       'label' => 'Gestão de Varas'],
            ['name' => 'create_type_action', 'label' => 'Criar uma nova Vara'],
            ['name' => 'update_type_action', 'label' => 'Alterar uma Vara'],
            ['name' => 'view_type_action',   'label' => 'Visualizar uma Vara'],
            ['name' => 'delete_type_action', 'label' => 'Excluir uma Vara'],
            ['name' => 'view_type_action_phases', 'label' => 'Visualizar Fases do Tipo de Ação'],

            /** TYPE ADDRESS */
            ['name' => 'type_address',       'label' => 'Gestão de Tipos de Endereços'],
            ['name' => 'create_type_address', 'label' => 'Criar uma novo Tipo de Endereço'],
            ['name' => 'update_type_address', 'label' => 'Alterar um Tipo de Endereço'],
            ['name' => 'view_type_address',   'label' => 'Visualizar um Tipo de Endereço'],
            ['name' => 'delete_type_address', 'label' => 'Excluir um Tipo de Endereço'],

            /** CONTRACT MODEL */
            ['name' => 'contracts',       'label' => 'Gestão de Modelo de Contratos'],
            ['name' => 'create_contract', 'label' => 'Criar um novo Modelo de Contrato'],
            ['name' => 'update_contract', 'label' => 'Alterar um Modelo de Contrato'],
            ['name' => 'view_contract',   'label' => 'Visualizar um Modelo de Contrato'],
            ['name' => 'delete_contract', 'label' => 'Excluir um Modelo de Contrato'],


            /** REPORTS */
            ['name' => 'rel-honorary',                'label' => 'Relatório de Honorários'],
            ['name' => 'rel-financial-process',       'label' => 'Relatório de Ficha Financeira'],
            ['name' => 'rel-financial',               'label' => 'Relatório de Contas a Pagar / Receber'],
        ]);
    }
}
