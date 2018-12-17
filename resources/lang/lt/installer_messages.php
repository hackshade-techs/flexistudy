<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'Diegimo programa',
    'next' => 'Kitas �ingsnis',
    'back' => 'Ankstesnis',
    'finish' => 'Diegti',
    'no-spaces' => 'Neleid�iama joki� tarp� .env faile. �d�kite eilutes, kuriose yra tarp� dvigubomis kabut�mis (t.y. "John Doe"). Be to, nepalikite tarp� po lygyb�s �enklo.',
    'forms' => [
        'errorTitle' => '�vyko tokios klaidos:',
    ],

    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'Sveiki',
        'title'   => 'Diegimo programa',
        'message' => 'Lengvas diegimo ir s�rankos vedlys.',
        'next'    => 'Patikrinkite reikalavimus',
    ],

    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => '�ingsnis 1 | Serverio reikalavimai',
        'title' => 'Serverio reikalavimai',
        'next'    => 'Patikrinkite teises',
    ],

    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => '�ingsnis 2 | Teis�s',
        'title' => 'Teis�s',
        'next' => 'Konfig�ruoti aplink�',
    ],

    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'save' => 'I�saugoti .env',
        'menu' => [
            'templateTitle' => '�ingsnis 3 | Aplinkos nustatymai',
            'title' => 'Aplinkos nustatymai',
            'desc' => 'Pasirinkite, kaip norite konfig�ruoti programos <code>.env</code> fail�.',
            'wizard-button' => 'Naudoti vedl�',
            'classic-button' => 'Klasikinis teksto redaktorius',
        ],
        'wizard' => [
            'templateTitle' => '�ingsnis 3 | Aplinkos nustatymai | Vedlys',
            'title' => ' <code>.env</code> Vedlys',
            'tabs' => [
                'environment' => 'Aplinka',
                'database' => 'Duomen� baz�',
                'application' => 'Programa'
            ],
            'form' => [
                'name_required' => 'B�tinas aplinkos pavadinimas.',
                'app_name_label' => 'Programos pavadinimas',
                'app_name_placeholder' => 'Programos pavadinimas',
                'app_environment_label' => 'Programos aplinka',
                'app_environment_label_local' => 'Vietinis',
                'app_environment_label_developement' => 'Vystymas',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => 'Prod',
                'app_environment_label_other' => 'Kita',
                'app_environment_placeholder_other' => '�veskite savo aplink�...',
                'app_debug_label' => 'Programos Debugeris',
                'app_debug_label_true' => 'True',
                'app_debug_label_false' => 'False',
                'app_log_level_label' => 'Programos log� lygis',
                'app_log_level_label_debug' => 'debugeris',
                'app_log_level_label_info' => 'informacija',
                'app_log_level_label_notice' => 'pastaba',
                'app_log_level_label_warning' => '�sp�jimas',
                'app_log_level_label_error' => 'klaida',
                'app_log_level_label_critical' => 'kritinis',
                'app_log_level_label_alert' => '�sp�jimas',
                'app_log_level_label_emergency' => 'skubus atv�jis',
                'app_url_label' => 'Programos Url',
                'app_url_placeholder' => 'Programos Url',
                'db_connection_label' => 'Duomen� baz�s prisijungimas',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Duomen� baz�s Hostas',
                'db_host_placeholder' => 'Duomen� baz�s Hostas',
                'db_port_label' => 'Duomen� baz�s portas',
                'db_port_placeholder' => 'Duomen� baz�s portas',
                'db_name_label' => 'Duomen� baz�s pavadinimas',
                'db_name_placeholder' => 'Duomen� baz�s pavadinimas',
                'db_username_label' => 'Duomen� baz�s vartotojas',
                'db_username_placeholder' => 'Duomen� baz�s vartotojas',
                'db_password_label' => 'Duomen� baz�s slapta�odis',
                'db_password_placeholder' => 'Duomen� baz�s slapta�odis',

                'app_tabs' => [
                    'more_info' => 'Daugiau informacijos',
                    'broadcasting_title' => 'Transliacija, Spartinimas, Sesija, &amp; Eil�',
                    'broadcasting_label' => 'Transliacijos valdiklis',
                    'broadcasting_placeholder' => 'Transliacijos valdiklis',
                    'cache_label' => 'Spartinimo valdiklis',
                    'cache_placeholder' => 'Spartinimo valdiklis',
                    'session_label' => 'Sesijos valdiklis',
                    'session_placeholder' => 'Sesijos valdiklis',
                    'queue_label' => 'Eil�s valdiklis',
                    'queue_placeholder' => 'Eil�s valdiklis',
                    'redis_label' => 'Redis valdiklis',
                    'redis_host' => 'Redis hostas',
                    'redis_password' => 'Redis slapta�odis',
                    'redis_port' => 'Redis portas',

                    'mail_label' => 'El. pa�tas',
                    'mail_driver_label' => 'El. pa�to valdiklis',
                    'mail_driver_placeholder' => 'El. pa�to valdiklis',
                    'mail_host_label' => 'El. pa�to hostas',
                    'mail_host_placeholder' => 'El. pa�to hostas',
                    'mail_port_label' => 'El. pa�to portas',
                    'mail_port_placeholder' => 'El. pa�to portas',
                    'mail_username_label' => 'El. pa�to vartotojas',
                    'mail_username_placeholder' => 'El. pa�to vartotojas',
                    'mail_password_label' => 'El. pa�to slapta�odis',
                    'mail_password_placeholder' => 'El. pa�to slapta�odis',
                    'mail_encryption_label' => 'El. pa�to �ifravimas',
                    'mail_encryption_placeholder' => 'El. pa�to �ifravimas',

                    'pusher_label' => 'St�miklis',
                    'pusher_app_id_label' => 'St�miklis programos Id',
                    'pusher_app_id_palceholder' => 'St�miklis programos Id',
                    'pusher_app_key_label' => 'St�miklis programos raktas',
                    'pusher_app_key_palceholder' => 'St�miklis programos raktas',
                    'pusher_app_secret_label' => 'St�miklis programos sl�pinys',
                    'pusher_app_secret_palceholder' => 'St�miklis programos sl�pinys',
                ],
                'buttons' => [
                    'setup_database' => 'Duomen� baz�s nustatymas',
                    'setup_application' => 'Programos nustatymas',
                    'install' => 'Diegti',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => '�ingsnis 3 | Aplinkos nustatymai | Klasikinis redaktorius',
            'title' => 'Klasikinis aplinkos redaktorius',
            'save' => 'I�saugoti.env',
            'back' => 'Naudoti formos vedl�',
            'install' => 'I�saugoti ir diegti',
        ],
        'success' => 'J�s� .env failo nustatymai buvo i�saugoti.',
        'errors' => 'Nepavyko i�saugoti .env failo, pra�ome sukurti j� rankiniu b�du.',
    ],

    'install' => 'Diegti',

    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Laravel Diegimo programa s�kmingai �diegta ',
    ],

    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => '�diegimas baigtas',
        'templateTitle' => '�diegimas baigtas',
        'finished' => 'Programa s�kmingai �diegta.',
        'migration' => 'Migraavimas &amp; konsol�s i�vestis:',
        'console' => 'Programa konsol�s i�vestis:',
        'log' => 'Diegimo log �ra�ai:',
        'env' => 'Galutinis .env failas:',
        'exit' => 'Paspauskite �ia, kad i�eitum�te',
    ],

    /**
     *
     * Update specific translations
     *
     */
    'updater' => [
        /**
         *
         * Shared translations.
         *
         */
        'title' => 'Laravel atnaujintojas',

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome' => [
            'title'   => 'Atnaujintojas',
            'message' => 'Atnaujinimo vedlys.',
        ],

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'overview' => [
            'title'   => 'ap�valga',
            'message' => 'Tai 1 atnaujinimas.|Yra :number atnaujinim�.',
            'install_updates' => "Diegti atnaujinimus"
        ],

        /**
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => 'Baigta',
            'finished' => 'Programos duomen� baz� buvo s�kmingai atnaujinta.',
            'exit' => 'Paspauskite �ia, kad i�eitum�te',
        ],

        'log' => [
            'success_message' => 'Laravel diegimo programa s�kmingai atnaujinta ',
        ],
    ],
];
