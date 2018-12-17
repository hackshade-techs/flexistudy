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
            'title' => 'Administración de acceso',

            'roles' => [
                'all'        => 'Todos los Roles',
                'create'     => 'Nuevo Rol',
                'edit'       => 'Modificar Rol',
                'management' => 'Administración de Roles',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'Todos los Usuarios',
                'change-password' => 'Cambiar la contraseña',
                'create'          => 'Nuevo Usuario',
                'deactivated'     => 'Usuarios Desactivados',
                'deleted'         => 'Usuarios Eliminados',
                'edit'            => 'Modificar Usuario',
                'main'            => 'Usuario',
                'view'            => 'Ver Usuario',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Gestór de Logs',
            'dashboard' => 'Principal',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Principal',
            'general'   => 'General',
            'system'    => 'Sistema',
            'course-management'    => 'Administrar cursos',
            'courses'    => 'Lista de cursos',
            'featured-courses'    => 'Administrar curso destacado',
            'withdrawal-requests'    => 'Administrar solicitudes de retiro',
            'manage-categories'    => 'Administrar categorías',
            'admin-messaging' => 'MESAJES DE ADMIN',
            'admin-messages' => 'Mesajes',
            'site-configuration' => 'CONFIGURACIÓN DEL SITIO',
            'environmental-variables' => 'Variables Ambientales',
            'site-settings' => 'Configuración del sitio',
            'blog-and-pages' => 'Blog y Páginas',
            'pages-and-articles' => 'Páginas y artículos',
            'maintenance' => 'MANTENIMIENTO DEL SITIO',
            'coupons' => 'Cupones de descuento'
            
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
            'ar'    => 'العربية (Arabic)',
            'zh'    => '(Chinese Simplified)',
            'zh-TW' => '(Chinese Traditional)',
            'da'    => 'Danés (Danish)',
            'de'    => 'Alemán (German)',
            'el'    => '(Greek)',
            'en'    => 'Inglés (English)',
            'es'    => 'Español (Spanish)',
            'fr'    => 'Francés (French)',
            'id'    => 'Indonesio (Indonesian)',
            'it'    => 'Italiano (Italian)',
            'ja'    => '(Japanese)',
            'lt'    => 'Lituano (Lithuanian)',
            'nl'    => 'Holandés (Dutch)',
            'pt_BR' => 'Portugués Brasileño',
            'ru'    => 'Russian (Russian)',
            'sv'    => 'Sueco (Swedish)',
            'th'    => '(Thai)',
            'tr'    => '(Turkish)',
        ],
    ],
];
