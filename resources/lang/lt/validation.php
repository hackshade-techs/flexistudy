<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute turi bûti priimtas.',
    'active_url'           => ':attribute netinkamas URL.',
    'after'                => ':attribute data turi bûti po :date.',
    'after_or_equal'       => ':attribute data turi bûti po arba lygi :date.',
    'alpha'                => ':attribute leidþiamos tik raidës',
    'alpha_dash'           => ':attribute leidþiama tik raidës, skaièiai ir brûkðniai',
    'alpha_num'            => ':attribute leidþiama tik raidës ir skaièiai.',
    'array'                => ':attribute privalo bûti masyvas.',
    'before'               => ':attribute privalo bûti data prieð :date.',
    'before_or_equal'      => ':attribute data privalo bûti po arba lygi :date.',
    'between'              => [
        'numeric' => ':attribute privalo bûti tarp :min ir :max.',
        'file'    => ':attribute privalo bûti tarp :min ir :max kilobaitø.',
        'string'  => ':attribute privalo bûti tarp :min ir :max simboliø.',
        'array'   => ':attribute privalo bûti tarp :min ir :max vienetø.',
    ],
    'boolean'              => ':attribute laukas privalo bûti true arba false.',
    'confirmed'            => ':attribute patvirtinimas neatitinka.',
    'date'                 => ':attribute netinkama data.',
    'date_format'          => ':attribute netinkamas formatas :format.',
    'different'            => ':attribute ir :other privalo bûti skirtingi.',
    'digits'               => ':attribute privalo bûti :digits skaitmenø.',
    'digits_between'       => ':attribute privalo bûti tarp :min ir :max skaitmenø.',
    'dimensions'           => ':attribute turi netinkamà vaizdo iðmatavimà.',
    'distinct'             => ':attribute laukas turi dublikatø.',
    'email'                => ':attribute privalo bûti tinkamas el. paðto adresas.',
    'exists'               => 'Pasirinktas :attribute netinkamas.',
    'file'                 => ':attribute privalo bûti failas.',
    'filled'               => ':attribute laukas privalo turëti reikðmæ.',
    'image'                => ':attribute privalo bûti vaizdas.',
    'in'                   => 'Pasirinktas :attribute netinkamas.',
    'in_array'             => ':attribute laukas neegzistuoja :other.',
    'integer'              => ':attribute privalo bûti integer tipo.',
    'ip'                   => ':attribute privalo bûti tinkamas IP adresas.',
    'ipv4'                 => ':attribute privalo bûti tinkamas IPv4 adresas.',
    'ipv6'                 => ':attribute privalo bûti tinkamas IPv6 adresas.',
    'json'                 => ':attribute privalo bûti tinkama JSON seka.',
    'max'                  => [
        'numeric' => ':attribute negali bûti didesnis negu :max.',
        'file'    => ':attribute negali bûti didesnis negu :max kilobaitø.',
        'string'  => ':attribute negali bûti didesnis negu :max simboliø.',
        'array'   => ':attribute negali turëti daugiau negu :max vienetø.',
    ],
    'mimes'                => ':attribute privalo bûti failas tipo: :values.',
    'mimetypes'            => ':attribute privalo bûti failas tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute privalo bûti maþiausiai :min.',
        'file'    => ':attribute privalo bûti maþiausiai :min kilobaitø.',
        'string'  => ':attribute privalo bûti maþiausiai :min simboliø.',
        'array'   => ':attribute privalo bûti maþiausiai :min vienetø.',
    ],
    'not_in'               => 'Pasirinktas :attribute netinkamas.',
    'numeric'              => ':attribute privalo bûti skaièius.',
    'present'              => ':attribute laukas turi egzistuoti.',
    'regex'                => ':attribute formatas yra netinkamas.',
    'required'             => ':attribute laukas yra privalomas.',
    'required_if'          => ':attribute laukas yra privalomas kada :other yra :value.',
    'required_unless'      => ':attribute laukas yra privalomas nebent :other yra tarp :values.',
    'required_with'        => ':attribute laukas yra privalomas kada :values egzistuoja.',
    'required_with_all'    => ':attribute laukas yra privalomas kada :values egzistuoja.',
    'required_without'     => ':attribute laukas yra privalomas kada :values ne egzistuoja.',
    'required_without_all' => ':attribute laukas yra privalomas kada nei viena ið :values egzistuoja.',
    'same'                 => ':attribute ir :other turi sutapti.',
    'size'                 => [
        'numeric' => ':attribute privalo bûti :size.',
        'file'    => ':attribute privalo bûti :size kilobaitø.',
        'string'  => ':attribute privalo bûti :size simboliø.',
        'array'   => ':attribute privalo turëti :size vienetus.',
    ],
    'string'               => ':attribute privalo bûti eilutë.',
    'timezone'             => ':attribute privalo bûti tinkama laiko zona.',
    'unique'               => ':attribute jau panaudotas.',
    'uploaded'             => ':attribute klaida ákeliant.',
    'url'                  => ':attribute formatas netinkamas.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pasirinktinis praneðimas',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'Asocijuotos rolës',
                    'dependencies'     => 'Priklausomybës',
                    'display_name'     => 'Rodomas pavadinimas',
                    'group'            => 'Grupë',
                    'group_sort'       => 'Grupë ruðiuoti',

                    'groups' => [
                        'name' => 'Grupës pavadinimas',
                    ],

                    'name'       => 'Pavadinimas',
                    'first_name' => 'Vardas',
                    'last_name'  => 'Pavardë',
                    'system'     => 'Sistema',
                ],

                'roles' => [
                    'associated_permissions' => 'Asocijuotos teisës',
                    'name'                   => 'Pavadinimas',
                    'sort'                   => 'Rûðiuoti',
                ],

                'users' => [
                    'active'                  => 'Aktyvus',
                    'associated_roles'        => 'Asocijuotos rolës',
                    'confirmed'               => 'Patvirtintas',
                    'email'                   => 'El. paðto adresas',
                    'name'                    => 'Pavadinimas',
                    'last_name'               => 'Padardë',
                    'first_name'              => 'Vardas',
                    'other_permissions'       => 'Kitos teisës',
                    'password'                => 'Slaptaþodis',
                    'password_confirmation'   => 'Slaptaþodþio patvirtinimas',
                    'send_confirmation_email' => 'Siøsti patvirtinimo el. laiðkà',
                ],
            ],
        ],

        'frontend' => [
            'email'                     => 'El. paðto adresas',
            'first_name'                => 'Vardas',
            'last_name'                 => 'Pavardë',
            'username'                  => 'Vartotojo vardas',
            'tagline'                   => 'Pareigos',
            'bio'                       => 'Apie mane',
            'facebook'                  => 'Facebook',
            'linkedin'                  => 'LinkedIn',
            'github'                    => 'GitHub',
            'twitter'                   => 'Twitter',
            'youtube'                   => 'YouTube',
            'web'                       => 'Website',
            'avatar'                    => 'Avatar',
            'password'                  => 'Slaptaþodis',
            'password_confirmation'     => 'Slaptaþodþio patvirtinimas',
            'old_password'              => 'Senas slaptaþodis',
            'new_password'              => 'Naujas slaptaþodis',
            'new_password_confirmation' => 'Naujo slaptaþodþio patvirtinimas',
            'title'                     => 'Antraðtë',
            'description'               => 'Apraðymas',
            'technologies'              => 'Technologijos',
            'category'                  => 'Kategorija',
        ],
    ],

];
