<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'Visi',
        'yes'     => 'Taip',
        'no'      => 'Ne',
        'custom'  => 'Nestandartinis',
        'actions' => 'Veiksmai',
        'active'  => 'Aktyvus',
        'buttons' => [
            'save'   => 'I�saugoti',
            'update' => 'Atnaujinti',
        ],
        'hide'              => 'Sl�pti',
        'inactive'          => 'Neaktyvus',
        'none'              => 'N�ra',
        'show'              => 'Rodyti',
        'toggle_navigation' => 'Pasirinkti navigacij�',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Sukurti rol�',
                'edit'       => 'Redaguoti rol�',
                'management' => 'Rol�s valdymas',

                'table' => [
                    'number_of_users' => 'Vartotoj� skai�ius',
                    'permissions'     => 'Teis�s',
                    'role'            => 'Rol�',
                    'sort'            => 'R��is',
                    'total'           => 'rol� viso|rol�s viso',
                ],
            ],

            'users' => [
                'active'              => 'Aktyv�s vartotojai',
                'all_permissions'     => 'Visos teis�s',
                'change_password'     => 'Keisti slapta�od�',
                'change_password_for' => 'Keisti slapta�od� :user',
                'create'              => 'Sukurti vartotoj�',
                'deactivated'         => 'Deaktyvuoti vartotoj�',
                'deleted'             => 'I�trinti vartotojai',
                'edit'                => 'Redaguoti vartotoj�',
                'management'          => 'Vartotojo valdymas',
                'no_permissions'      => 'Ne teis�s',
                'no_roles'            => 'Ne rol�s nustatymui.',
                'permissions'         => 'Teis�s',

                'table' => [
                    'confirmed'      => 'Patvirtintas',
                    'created'        => 'Sukurtas',
                    'email'          => 'El. pa�tas',
                    'id'             => 'ID',
                    'last_updated'   => 'Paskutin� kart� atnaujinta',
                    'name'           => 'Pavadinimas',
                    'first_name'     => 'Vardas',
                    'last_name'      => 'Pavard�',
                    'no_deactivated' => 'Ne deaktyvuoti vartotojai',
                    'no_deleted'     => 'Ne i�trinti vartotojai',
                    'roles'          => 'Rol�s',
                    'total'          => 'vartotojas viso|vartotojai viso',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Ap�valga',
                        'history'  => 'Istorija',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Patvirtintas',
                            'created_at'   => 'Sukurtas',
                            'deleted_at'   => 'I�trintas',
                            'email'        => 'E. pa�tas',
                            'last_updated' => 'Paskutin� kart� atnaujinta',
                            'name'         => 'Pavadinimas',
                            'first_name'   => 'Vardas',
                            'last_name'    => 'Pavard�',
                            'status'       => 'B�sena',
                        ],
                    ],
                ],

                'view' => 'Per�i�r�ti vartotoj�',
            ],
        ],
        
        'courses' => [
            'drag-here' => 'Vilkite i� �ia',
            'drop-here' => 'Pad�kite kurs� �ia kaip i�kelt�',
            'update-featured-list' => 'Atnaujinti i�kelt� kurs� s�ra��',
            'course-management' => 'Kurso valdymas',  
            'course-management-small' => 'Valdykite visus autori� sukurtus kursus',
            'featured-courses-small' => 'Valdykite visus i�keltus kursus',
            'featured-courses' => 'I�kelti kursai',
            'all-courses' => 'Visi kursai',
            'approved' => 'Patvirtinta',
            'pending-approval' => 'Laukiama patvirtinimo',
            'unpublished' => 'Nepaskelbtas',
            'draft' => 'Juodra�tis',
            'title' => 'Antra�t�',
            'author' => 'Autorius',
            'category' => 'Kategorija',
            'price' => 'Kaina',
            'language' => 'Kalba',
            'published' => 'Paskelbtas',
            'approved' => 'Patvirtintas',
            'review' => 'Per�i�ra',
            'mark-as-featured' => 'Pa�ym�ti kaip i�kelt�',
            'unmark-as-featured' => 'Nuimti �ym� kaip i�keltas',
            'preview' => 'Per�i�r�ti frontende',
            'review-comment' => 'Per�i�r�ti komentarus',
            'decision' => 'Sprendimas',
            'not-approved' => 'Ne patvirtinta',
            'cancel' => 'At�aukta',
            'submit-review' => 'Perduoti per�i�r�',
            'enter-comment' => '�vesti komentar�...',
            'live-course' => 'Kursai gyvai',
            'unpublished-by-author' => 'Nepaskelbta pagal autorius',
            'awaiting-admin-approval' => 'Laukiama admin patvirtinimo',
            'draft-course' => 'Ruo�iami kursai',
        ],
        
        'categories' => [
            'category-management' => 'Kategorij� valdymas',  
            'category-management-small' => 'Valdyti visas kategorijas. J�s negalite i�trinti kategorij� kuriose yra kursai'
        ],
        
        'withdrawal' => [
            'withdrawal-management' => 'Tvarkykite at�aukimo pra�ymus',  
            'withdrawal-management-small' => 'At�aukimo s�ra�as / i�mok� pra�ymai i� autori�',
            'user'  => 'Vartotojas',
            'paypal-email'  => 'PayPal El.pa�tas',
            'amount'  => 'Pra�oma suma',
            'comment'  => 'Komentaras',
            'user-account-balance'  => 'Vartotojo paskyros balansas',
            'status'  => 'B�sena',
            'date'  => 'Data',
            'all-requests' => 'Visi at�aukimo pra�ymai',
            'submitted' => 'Pateikti pra�ymai at�aukti',
            'processing'=> 'Pra�ymai apdorojami',
            'processed' => 'Apdoroti pra�ymai',
            'update-request' => 'Atnaujinti u�klaus�'
        
        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Prisijungti',
            'login_button'       => 'Prisijungti',
            'login_with'         => 'Prisijungti su :social_media',
            'register_box_title' => 'Registruotis',
            'register_button'    => 'Registruotis',
            'remember_me'        => 'Prisiminti mane',
            'reset_password_box_title'    => 'Atstatyti slapta�od�',
        ],

        'passwords' => [
            'forgot_password'                 => 'Pamir�ote slapta�od�?',
            'reset_password_box_title'        => 'Atstatyti slapta�od�',
            'reset_password_button'           => 'Atstatyti slapta�od�',
            'send_password_reset_link_button' => 'Si�sti slapta�od�io atstatymo nuorod�',
        ],

        'macros' => [
            'country' => [
                'alpha'   => '�alies alfa kodai',
                'alpha2'  => '�alies alfa 2 kodai',
                'alpha3'  => '�alies alfa 3 kodai',
                'numeric' => '�alies skaitmeniniai kodai',
            ],

            'macro_examples' => 'Makro pavyzd�iai',

            'state' => [
                'mexico' => 'Meksikos valstijos s�ra�as',
                'us'     => [
                    'us'       => 'JAV valstijos',
                    'outlying' => 'JAV atokios teritorijos',
                    'armed'    => 'JAV kariuomen�',
                ],
            ],

            'territories' => [
                'canada' => 'Kanados provincijos ir teritorij� s�ra�as',
            ],

            'timezone' => 'Laiko zona',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Pakeisti slapta�od�',
            ],

            'profile' => [
                'avatar'             => 'Avataras',
                'created_at'         => 'Sukurta',
                'edit_information'   => 'Redaguoti informacij�',
                'email'              => 'El. pa�tas',
                'last_updated'       => 'Paskutin� kart� atnaujinta',
                'name'               => 'Pavadinimas',
                'first_name'         => 'Vardas',
                'last_name'          => 'Pavard�',
                'update_information' => 'Atnaujinti informacij�',
            ],
        ],

    ],
];
