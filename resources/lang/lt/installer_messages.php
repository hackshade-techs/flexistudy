<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'Diegimo programa',
    'next' => 'Kitas þingsnis',
    'back' => 'Ankstesnis',
    'finish' => 'Diegti',
    'no-spaces' => 'Neleidþiama jokiø tarpø .env faile. Ádëkite eilutes, kuriose yra tarpø dvigubomis kabutëmis (t.y. "John Doe"). Be to, nepalikite tarpø po lygybës þenklo.',
    'forms' => [
        'errorTitle' => 'Ávyko tokios klaidos:',
    ],

    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'Sveiki',
        'title'   => 'Diegimo programa',
        'message' => 'Lengvas diegimo ir sàrankos vedlys.',
        'next'    => 'Patikrinkite reikalavimus',
    ],

    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Þingsnis 1 | Serverio reikalavimai',
        'title' => 'Serverio reikalavimai',
        'next'    => 'Patikrinkite teises',
    ],

    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Þingsnis 2 | Teisës',
        'title' => 'Teisës',
        'next' => 'Konfigûruoti aplinkà',
    ],

    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'save' => 'Iðsaugoti .env',
        'menu' => [
            'templateTitle' => 'Þingsnis 3 | Aplinkos nustatymai',
            'title' => 'Aplinkos nustatymai',
            'desc' => 'Pasirinkite, kaip norite konfigûruoti programos <code>.env</code> failà.',
            'wizard-button' => 'Naudoti vedlá',
            'classic-button' => 'Klasikinis teksto redaktorius',
        ],
        'wizard' => [
            'templateTitle' => 'Þingsnis 3 | Aplinkos nustatymai | Vedlys',
            'title' => ' <code>.env</code> Vedlys',
            'tabs' => [
                'environment' => 'Aplinka',
                'database' => 'Duomenø bazë',
                'application' => 'Programa'
            ],
            'form' => [
                'name_required' => 'Bûtinas aplinkos pavadinimas.',
                'app_name_label' => 'Programos pavadinimas',
                'app_name_placeholder' => 'Programos pavadinimas',
                'app_environment_label' => 'Programos aplinka',
                'app_environment_label_local' => 'Vietinis',
                'app_environment_label_developement' => 'Vystymas',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => 'Prod',
                'app_environment_label_other' => 'Kita',
                'app_environment_placeholder_other' => 'Áveskite savo aplinkà...',
                'app_debug_label' => 'Programos Debugeris',
                'app_debug_label_true' => 'True',
                'app_debug_label_false' => 'False',
                'app_log_level_label' => 'Programos logø lygis',
                'app_log_level_label_debug' => 'debugeris',
                'app_log_level_label_info' => 'informacija',
                'app_log_level_label_notice' => 'pastaba',
                'app_log_level_label_warning' => 'áspëjimas',
                'app_log_level_label_error' => 'klaida',
                'app_log_level_label_critical' => 'kritinis',
                'app_log_level_label_alert' => 'áspëjimas',
                'app_log_level_label_emergency' => 'skubus atvëjis',
                'app_url_label' => 'Programos Url',
                'app_url_placeholder' => 'Programos Url',
                'db_connection_label' => 'Duomenø bazës prisijungimas',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Duomenø bazës Hostas',
                'db_host_placeholder' => 'Duomenø bazës Hostas',
                'db_port_label' => 'Duomenø bazës portas',
                'db_port_placeholder' => 'Duomenø bazës portas',
                'db_name_label' => 'Duomenø bazës pavadinimas',
                'db_name_placeholder' => 'Duomenø bazës pavadinimas',
                'db_username_label' => 'Duomenø bazës vartotojas',
                'db_username_placeholder' => 'Duomenø bazës vartotojas',
                'db_password_label' => 'Duomenø bazës slaptaþodis',
                'db_password_placeholder' => 'Duomenø bazës slaptaþodis',

                'app_tabs' => [
                    'more_info' => 'Daugiau informacijos',
                    'broadcasting_title' => 'Transliacija, Spartinimas, Sesija, &amp; Eilë',
                    'broadcasting_label' => 'Transliacijos valdiklis',
                    'broadcasting_placeholder' => 'Transliacijos valdiklis',
                    'cache_label' => 'Spartinimo valdiklis',
                    'cache_placeholder' => 'Spartinimo valdiklis',
                    'session_label' => 'Sesijos valdiklis',
                    'session_placeholder' => 'Sesijos valdiklis',
                    'queue_label' => 'Eilës valdiklis',
                    'queue_placeholder' => 'Eilës valdiklis',
                    'redis_label' => 'Redis valdiklis',
                    'redis_host' => 'Redis hostas',
                    'redis_password' => 'Redis slaptaþodis',
                    'redis_port' => 'Redis portas',

                    'mail_label' => 'El. paðtas',
                    'mail_driver_label' => 'El. paðto valdiklis',
                    'mail_driver_placeholder' => 'El. paðto valdiklis',
                    'mail_host_label' => 'El. paðto hostas',
                    'mail_host_placeholder' => 'El. paðto hostas',
                    'mail_port_label' => 'El. paðto portas',
                    'mail_port_placeholder' => 'El. paðto portas',
                    'mail_username_label' => 'El. paðto vartotojas',
                    'mail_username_placeholder' => 'El. paðto vartotojas',
                    'mail_password_label' => 'El. paðto slaptaþodis',
                    'mail_password_placeholder' => 'El. paðto slaptaþodis',
                    'mail_encryption_label' => 'El. paðto ðifravimas',
                    'mail_encryption_placeholder' => 'El. paðto ðifravimas',

                    'pusher_label' => 'Stûmiklis',
                    'pusher_app_id_label' => 'Stûmiklis programos Id',
                    'pusher_app_id_palceholder' => 'Stûmiklis programos Id',
                    'pusher_app_key_label' => 'Stûmiklis programos raktas',
                    'pusher_app_key_palceholder' => 'Stûmiklis programos raktas',
                    'pusher_app_secret_label' => 'Stûmiklis programos slëpinys',
                    'pusher_app_secret_palceholder' => 'Stûmiklis programos slëpinys',
                ],
                'buttons' => [
                    'setup_database' => 'Duomenø bazës nustatymas',
                    'setup_application' => 'Programos nustatymas',
                    'install' => 'Diegti',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => 'Þingsnis 3 | Aplinkos nustatymai | Klasikinis redaktorius',
            'title' => 'Klasikinis aplinkos redaktorius',
            'save' => 'Iðsaugoti.env',
            'back' => 'Naudoti formos vedlá',
            'install' => 'Iðsaugoti ir diegti',
        ],
        'success' => 'Jûsø .env failo nustatymai buvo iðsaugoti.',
        'errors' => 'Nepavyko iðsaugoti .env failo, praðome sukurti já rankiniu bûdu.',
    ],

    'install' => 'Diegti',

    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Laravel Diegimo programa sëkmingai ádiegta ',
    ],

    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Ádiegimas baigtas',
        'templateTitle' => 'Ádiegimas baigtas',
        'finished' => 'Programa sëkmingai ádiegta.',
        'migration' => 'Migraavimas &amp; konsolës iðvestis:',
        'console' => 'Programa konsolës iðvestis:',
        'log' => 'Diegimo log áraðai:',
        'env' => 'Galutinis .env failas:',
        'exit' => 'Paspauskite èia, kad iðeitumëte',
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
            'title'   => 'apþvalga',
            'message' => 'Tai 1 atnaujinimas.|Yra :number atnaujinimø.',
            'install_updates' => "Diegti atnaujinimus"
        ],

        /**
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => 'Baigta',
            'finished' => 'Programos duomenø bazë buvo sëkmingai atnaujinta.',
            'exit' => 'Paspauskite èia, kad iðeitumëte',
        ],

        'log' => [
            'success_message' => 'Laravel diegimo programa sëkmingai atnaujinta ',
        ],
    ],
];
