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

    'accepted'             => ':attribute turi b�ti priimtas.',
    'active_url'           => ':attribute netinkamas URL.',
    'after'                => ':attribute data turi b�ti po :date.',
    'after_or_equal'       => ':attribute data turi b�ti po arba lygi :date.',
    'alpha'                => ':attribute leid�iamos tik raid�s',
    'alpha_dash'           => ':attribute leid�iama tik raid�s, skai�iai ir br�k�niai',
    'alpha_num'            => ':attribute leid�iama tik raid�s ir skai�iai.',
    'array'                => ':attribute privalo b�ti masyvas.',
    'before'               => ':attribute privalo b�ti data prie� :date.',
    'before_or_equal'      => ':attribute data privalo b�ti po arba lygi :date.',
    'between'              => [
        'numeric' => ':attribute privalo b�ti tarp :min ir :max.',
        'file'    => ':attribute privalo b�ti tarp :min ir :max kilobait�.',
        'string'  => ':attribute privalo b�ti tarp :min ir :max simboli�.',
        'array'   => ':attribute privalo b�ti tarp :min ir :max vienet�.',
    ],
    'boolean'              => ':attribute laukas privalo b�ti true arba false.',
    'confirmed'            => ':attribute patvirtinimas neatitinka.',
    'date'                 => ':attribute netinkama data.',
    'date_format'          => ':attribute netinkamas formatas :format.',
    'different'            => ':attribute ir :other privalo b�ti skirtingi.',
    'digits'               => ':attribute privalo b�ti :digits skaitmen�.',
    'digits_between'       => ':attribute privalo b�ti tarp :min ir :max skaitmen�.',
    'dimensions'           => ':attribute turi netinkam� vaizdo i�matavim�.',
    'distinct'             => ':attribute laukas turi dublikat�.',
    'email'                => ':attribute privalo b�ti tinkamas el. pa�to adresas.',
    'exists'               => 'Pasirinktas :attribute netinkamas.',
    'file'                 => ':attribute privalo b�ti failas.',
    'filled'               => ':attribute laukas privalo tur�ti reik�m�.',
    'image'                => ':attribute privalo b�ti vaizdas.',
    'in'                   => 'Pasirinktas :attribute netinkamas.',
    'in_array'             => ':attribute laukas neegzistuoja :other.',
    'integer'              => ':attribute privalo b�ti integer tipo.',
    'ip'                   => ':attribute privalo b�ti tinkamas IP adresas.',
    'ipv4'                 => ':attribute privalo b�ti tinkamas IPv4 adresas.',
    'ipv6'                 => ':attribute privalo b�ti tinkamas IPv6 adresas.',
    'json'                 => ':attribute privalo b�ti tinkama JSON seka.',
    'max'                  => [
        'numeric' => ':attribute negali b�ti didesnis negu :max.',
        'file'    => ':attribute negali b�ti didesnis negu :max kilobait�.',
        'string'  => ':attribute negali b�ti didesnis negu :max simboli�.',
        'array'   => ':attribute negali tur�ti daugiau negu :max vienet�.',
    ],
    'mimes'                => ':attribute privalo b�ti failas tipo: :values.',
    'mimetypes'            => ':attribute privalo b�ti failas tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute privalo b�ti ma�iausiai :min.',
        'file'    => ':attribute privalo b�ti ma�iausiai :min kilobait�.',
        'string'  => ':attribute privalo b�ti ma�iausiai :min simboli�.',
        'array'   => ':attribute privalo b�ti ma�iausiai :min vienet�.',
    ],
    'not_in'               => 'Pasirinktas :attribute netinkamas.',
    'numeric'              => ':attribute privalo b�ti skai�ius.',
    'present'              => ':attribute laukas turi egzistuoti.',
    'regex'                => ':attribute formatas yra netinkamas.',
    'required'             => ':attribute laukas yra privalomas.',
    'required_if'          => ':attribute laukas yra privalomas kada :other yra :value.',
    'required_unless'      => ':attribute laukas yra privalomas nebent :other yra tarp :values.',
    'required_with'        => ':attribute laukas yra privalomas kada :values egzistuoja.',
    'required_with_all'    => ':attribute laukas yra privalomas kada :values egzistuoja.',
    'required_without'     => ':attribute laukas yra privalomas kada :values ne egzistuoja.',
    'required_without_all' => ':attribute laukas yra privalomas kada nei viena i� :values egzistuoja.',
    'same'                 => ':attribute ir :other turi sutapti.',
    'size'                 => [
        'numeric' => ':attribute privalo b�ti :size.',
        'file'    => ':attribute privalo b�ti :size kilobait�.',
        'string'  => ':attribute privalo b�ti :size simboli�.',
        'array'   => ':attribute privalo tur�ti :size vienetus.',
    ],
    'string'               => ':attribute privalo b�ti eilut�.',
    'timezone'             => ':attribute privalo b�ti tinkama laiko zona.',
    'unique'               => ':attribute jau panaudotas.',
    'uploaded'             => ':attribute klaida �keliant.',
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
            'rule-name' => 'pasirinktinis prane�imas',
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
                    'associated_roles' => 'Asocijuotos rol�s',
                    'dependencies'     => 'Priklausomyb�s',
                    'display_name'     => 'Rodomas pavadinimas',
                    'group'            => 'Grup�',
                    'group_sort'       => 'Grup� ru�iuoti',

                    'groups' => [
                        'name' => 'Grup�s pavadinimas',
                    ],

                    'name'       => 'Pavadinimas',
                    'first_name' => 'Vardas',
                    'last_name'  => 'Pavard�',
                    'system'     => 'Sistema',
                ],

                'roles' => [
                    'associated_permissions' => 'Asocijuotos teis�s',
                    'name'                   => 'Pavadinimas',
                    'sort'                   => 'R��iuoti',
                ],

                'users' => [
                    'active'                  => 'Aktyvus',
                    'associated_roles'        => 'Asocijuotos rol�s',
                    'confirmed'               => 'Patvirtintas',
                    'email'                   => 'El. pa�to adresas',
                    'name'                    => 'Pavadinimas',
                    'last_name'               => 'Padard�',
                    'first_name'              => 'Vardas',
                    'other_permissions'       => 'Kitos teis�s',
                    'password'                => 'Slapta�odis',
                    'password_confirmation'   => 'Slapta�od�io patvirtinimas',
                    'send_confirmation_email' => 'Si�sti patvirtinimo el. lai�k�',
                ],
            ],
        ],

        'frontend' => [
            'email'                     => 'El. pa�to adresas',
            'first_name'                => 'Vardas',
            'last_name'                 => 'Pavard�',
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
            'password'                  => 'Slapta�odis',
            'password_confirmation'     => 'Slapta�od�io patvirtinimas',
            'old_password'              => 'Senas slapta�odis',
            'new_password'              => 'Naujas slapta�odis',
            'new_password_confirmation' => 'Naujo slapta�od�io patvirtinimas',
            'title'                     => 'Antra�t�',
            'description'               => 'Apra�ymas',
            'technologies'              => 'Technologijos',
            'category'                  => 'Kategorija',
        ],
    ],

];
