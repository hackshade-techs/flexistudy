<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Administração de acesso',

            'roles' => [
                'all'        => 'Todas as funções',
                'create'     => 'Criar função',
                'edit'       => 'Editar função',
                'management' => 'Gestão de funções',
                'main'       => 'Funções',
            ],

            'users' => [
                'all'             => 'Todos os utilizadores',
                'change-password' => 'Mudar palavra-passe',
                'create'          => 'Criar utilizador',
                'deactivated'     => 'Utilizador desativado',
                'deleted'         => 'Utilizador eliminado',
                'edit'            => 'Modificar utilizador',
                'main'            => 'Utilizadores',
                'view'            => 'Ver utilizador',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Visualizador de registo',
            'dashboard' => 'Painel de control',
            'logs'      => 'Registo',
        ],

        'sidebar' => [
            'dashboard' => 'Painel de control',
            'general'   => 'Geral',
            'system'    => 'Sistema',
            'course-management'    => 'Gestão de cursos',
            'courses'    => 'Lista de cursos',
            'featured-courses'    => 'Gerir os cursos em destaque',
            'withdrawal-requests'    => 'Gerir pedidos de levantamento',
            'manage-categories'    => 'Gerir categorias',
            'admin-messaging' => 'MENSAGEM DO ADMINISTRADOR',
            'admin-messages' => 'Mensagem do administrador',
            'site-configuration' => 'CONFIGURAÇÃO DO SITE',
            'environmental-variables' => 'Variáveis do sistem',
            'site-settings' => 'Configuração do site',
            'blog-and-pages' => 'Blog e Páginas',
            'pages-and-articles' => 'Páginas e artigos',
            'maintenance' => 'SITE EM MANUTENÇÃO',
            'coupons' => 'Vale de desconto'
            
        ],
    ],

    'language-picker' => [
        'language' => 'Idioma',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fr'    => 'French',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'lt'    => 'Lituano (Lithuanian)',
            'nl'    => 'Dutch',
            'pt_BR' => 'Portugués Brasileño',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
        ],
    ],
];
