<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'SoftPro - Advogados',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-logo
    |
    */

    'logo' => '<b>SofPro</b> ADV',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image-xl',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SoftPro',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Extra Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand-md',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#66-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'false',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-menu
    |
    */

    'menu' => [
        ['header' => 'Meu Painel'],

        [
            'text' => 'Gerenciamento',
            'icon' => 'fas fa-solar-panel',
            'submenu' => [
                [
                    'text' => 'Planos',
                    'url' => 'tenants/plans',
                    'icon' => 'fab fa-paypal',
                    'label_color' => 'success',
                    'can' => 'plans'
                ],

                [
                    'text' => 'Empresas',
                    'url' => 'tenants/companies',
                    'icon' => 'far fa-building',
                    'label_color' => 'success',
                    'can' => 'companies'
                ],

                [
                    'text' => 'Pessoas',
                    'url' => 'people',
                    'icon' => 'fas fa-id-card',
                    'label_color' => 'success',
                    'can' => 'peoples'
                ],


                [
                    'text' => 'Processos',
                    'url' => 'process',
                    'icon' => 'fas fa-balance-scale',
                    'label_color' => 'success',
                    'can' => 'process'
                ],

                [
                    'text' => 'Agenda',
                    'url' => 'schedule',
                    'icon' => 'fas fa-calendar-check',
                    'label_color' => 'success',
                    'can' => 'schedule'
                ],

                [
                    'text' => 'Atividades',
                    'url' => 'tasks',
                    'icon' => 'fas fa-tasks',
                    'label_color' => 'success',
                    'can' => 'tasks'
                ],

                [
                    'text' => 'Financeiro',
                    'url' => 'financial',
                    'icon' => 'fas fa-comment-dollar',
                    'label_color' => 'success',
                    'can' => 'financial'
                ],


            ],
        ],





        ['header' => 'Sistema'],
        [
            'text' => 'Configurações',
            'icon' => 'fas fa-cogs',
            'submenu' => [
                [
                    'text' => 'Tipos de endereços',
                    'url' => 'type-address',
                    'icon' => 'far fa-address-card',
                    'can' => 'type_address'
                ],

                [
                    'text' => 'Paises',
                    'url' => 'countries',
                    'icon' => 'fas fa-globe-americas',
                    'can' => 'countries'
                ],

                [
                    'text' => 'Estados',
                    'url' => 'states',
                    'icon' => 'fas fa-flag',
                    'can' => 'states'
                ],

                [
                    'text' => 'Cidades',
                    'url' => 'cities',
                    'icon' => 'fas fa-city',
                    'can' => 'cities'
                ],

                [
                    'text' => 'Origem das Pessoas',
                    'url' => 'origins',
                    'icon' => 'fas fa-id-card-alt',
                    'can' => 'origins'
                ],

                [
                    'text' => 'Foruns',
                    'url' => 'forums',
                    'icon' => 'fas fa-archway',
                    'can' => 'forums'
                ],

                [
                    'text' => 'Varas',
                    'url' => 'sticks',
                    'icon' => 'fas fa-sitemap',
                    'can' => 'sticks'
                ],

                [
                    'text' => 'Comarcas',
                    'url' => 'districts',
                    'icon' => 'fa fa-map-signs',
                    'can' => 'districts'
                ],
            ],
        ],

        [
            'text' => 'Segurança',
            'icon' => 'fas fa-user-lock',


            'submenu' => [
                [
                    'text' => 'Usuários',
                    'url' => 'users',
                    'icon' => 'fas fa-user-tie',
                    'can' => 'users'
                ],

                [
                    'text' => 'Perfis',
                    'url' => 'profiles',
                    'icon' => 'fas fa-users',
                    'can' => 'profiles'
                ],


                [
                    'text' => 'Permissões',
                    'url' => 'permissions',
                    'icon' => 'fa fa-unlock-alt',
                    'can' => 'permissions'
                ],


                [
                    'text' => 'Minha Conta',
                    'url' => 'profile',
                    'icon' => 'fas fa-fw fa-user',
                ],

                [
                    'text' => 'change_password',
                    'url' => 'password/reset',
                    'icon' => 'fas fa-fw fa-lock',
                ]
            ]
        ]


    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-plugins
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
