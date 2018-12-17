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
            'title' => 'Prieigos valdymas',

            'roles' => [
                'all'        => 'Visos rol�s',
                'create'     => 'Sukurti rol�',
                'edit'       => 'Redaguoti rol�',
                'management' => 'Roli� valdymas',
                'main'       => 'Rol�s',
            ],

            'users' => [
                'all'             => 'Visi vartotojai',
                'change-password' => 'Keisti slapta�od�',
                'create'          => 'Kurti vartotoj�',
                'deactivated'     => 'Neaktyv�s vartotojai',
                'deleted'         => 'I�trinti vartotojai',
                'edit'            => 'Redaguoti vartotoj�',
                'main'            => 'Vartotojai',
                'view'            => 'Per�i�r�ti vartotoj�',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Logo per�i�ra',
            'dashboard' => 'Valdymo skydelis',
            'logs'      => 'Logai',
        ],

        'sidebar' => [
            'dashboard' => 'Valdymo skydelis',
            'general'   => 'Bendra',
            'system'    => 'Sistema',
            'course-management'    => 'Kurso valdymas',
            'courses'    => 'Kurs� s�ra�as',
            'featured-courses'    => 'Valdyti i�skirtus kursus',
            'withdrawal-requests'    => 'Tvarkykite pa�alinimo u�klausas',
            'manage-categories'    => 'Valdykite kategorijas',
            'admin-messaging' => 'ADMINO PRANE�IMAS',
            'admin-messages' => 'Admino prane�imai',
            'site-configuration' => 'Svetain�s konfig�ravimas',
            'environmental-variables' => 'Aplinkos kintamieji',
            'site-settings' => 'Svetain�s nustatymai',
            'blog-and-pages' => 'Blogas ir Puslapiai',
            'pages-and-articles' => 'Puslapiai ir straipsniai',
            'maintenance' => 'SVETAIN�S PRIE�I�RA',
            'coupons' => 'Nuolaid� kuponai'
            
        ],
    ],

    'language-picker' => [
        'language' => 'Kalba',
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
            'lt'    => 'Lietuviškai (Lithuanian)',
            'nl'    => 'Dutch',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
        ],
    ],
];
