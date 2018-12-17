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
            'save'   => 'Iðsaugoti',
            'update' => 'Atnaujinti',
        ],
        'hide'              => 'Slëpti',
        'inactive'          => 'Neaktyvus',
        'none'              => 'Nëra',
        'show'              => 'Rodyti',
        'toggle_navigation' => 'Pasirinkti navigacijà',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Sukurti rolæ',
                'edit'       => 'Redaguoti rolæ',
                'management' => 'Rolës valdymas',

                'table' => [
                    'number_of_users' => 'Vartotojø skaièius',
                    'permissions'     => 'Teisës',
                    'role'            => 'Rolë',
                    'sort'            => 'Rûðis',
                    'total'           => 'rolë viso|rolës viso',
                ],
            ],

            'users' => [
                'active'              => 'Aktyvûs vartotojai',
                'all_permissions'     => 'Visos teisës',
                'change_password'     => 'Keisti slaptaþodá',
                'change_password_for' => 'Keisti slaptaþodá :user',
                'create'              => 'Sukurti vartotojà',
                'deactivated'         => 'Deaktyvuoti vartotojà',
                'deleted'             => 'Iðtrinti vartotojai',
                'edit'                => 'Redaguoti vartotojà',
                'management'          => 'Vartotojo valdymas',
                'no_permissions'      => 'Ne teisës',
                'no_roles'            => 'Ne rolës nustatymui.',
                'permissions'         => 'Teisës',

                'table' => [
                    'confirmed'      => 'Patvirtintas',
                    'created'        => 'Sukurtas',
                    'email'          => 'El. paðtas',
                    'id'             => 'ID',
                    'last_updated'   => 'Paskutiná kartà atnaujinta',
                    'name'           => 'Pavadinimas',
                    'first_name'     => 'Vardas',
                    'last_name'      => 'Pavardë',
                    'no_deactivated' => 'Ne deaktyvuoti vartotojai',
                    'no_deleted'     => 'Ne iðtrinti vartotojai',
                    'roles'          => 'Rolës',
                    'total'          => 'vartotojas viso|vartotojai viso',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Apþvalga',
                        'history'  => 'Istorija',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Patvirtintas',
                            'created_at'   => 'Sukurtas',
                            'deleted_at'   => 'Iðtrintas',
                            'email'        => 'E. paðtas',
                            'last_updated' => 'Paskutiná kartà atnaujinta',
                            'name'         => 'Pavadinimas',
                            'first_name'   => 'Vardas',
                            'last_name'    => 'Pavardë',
                            'status'       => 'Bûsena',
                        ],
                    ],
                ],

                'view' => 'Perþiûrëti vartotojà',
            ],
        ],
        
        'courses' => [
            'drag-here' => 'Vilkite ið èia',
            'drop-here' => 'Padëkite kursà èia kaip iðkeltà',
            'update-featured-list' => 'Atnaujinti iðkeltø kursø sàraðà',
            'course-management' => 'Kurso valdymas',  
            'course-management-small' => 'Valdykite visus autoriø sukurtus kursus',
            'featured-courses-small' => 'Valdykite visus iðkeltus kursus',
            'featured-courses' => 'Iðkelti kursai',
            'all-courses' => 'Visi kursai',
            'approved' => 'Patvirtinta',
            'pending-approval' => 'Laukiama patvirtinimo',
            'unpublished' => 'Nepaskelbtas',
            'draft' => 'Juodraðtis',
            'title' => 'Antraðtë',
            'author' => 'Autorius',
            'category' => 'Kategorija',
            'price' => 'Kaina',
            'language' => 'Kalba',
            'published' => 'Paskelbtas',
            'approved' => 'Patvirtintas',
            'review' => 'Perþiûra',
            'mark-as-featured' => 'Paþymëti kaip iðkeltà',
            'unmark-as-featured' => 'Nuimti þymæ kaip iðkeltas',
            'preview' => 'Perþiûrëti frontende',
            'review-comment' => 'Perþiûrëti komentarus',
            'decision' => 'Sprendimas',
            'not-approved' => 'Ne patvirtinta',
            'cancel' => 'Atðaukta',
            'submit-review' => 'Perduoti perþiûrà',
            'enter-comment' => 'Ávesti komentarà...',
            'live-course' => 'Kursai gyvai',
            'unpublished-by-author' => 'Nepaskelbta pagal autorius',
            'awaiting-admin-approval' => 'Laukiama admin patvirtinimo',
            'draft-course' => 'Ruoðiami kursai',
        ],
        
        'categories' => [
            'category-management' => 'Kategorijø valdymas',  
            'category-management-small' => 'Valdyti visas kategorijas. Jûs negalite iðtrinti kategorijø kuriose yra kursai'
        ],
        
        'withdrawal' => [
            'withdrawal-management' => 'Tvarkykite atðaukimo praðymus',  
            'withdrawal-management-small' => 'Atðaukimo sàraðas / iðmokø praðymai ið autoriø',
            'user'  => 'Vartotojas',
            'paypal-email'  => 'PayPal El.paðtas',
            'amount'  => 'Praðoma suma',
            'comment'  => 'Komentaras',
            'user-account-balance'  => 'Vartotojo paskyros balansas',
            'status'  => 'Bûsena',
            'date'  => 'Data',
            'all-requests' => 'Visi atðaukimo praðymai',
            'submitted' => 'Pateikti praðymai atðaukti',
            'processing'=> 'Praðymai apdorojami',
            'processed' => 'Apdoroti praðymai',
            'update-request' => 'Atnaujinti uþklausà'
        
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
            'reset_password_box_title'    => 'Atstatyti slaptaþodá',
        ],

        'passwords' => [
            'forgot_password'                 => 'Pamirðote slaptaþodá?',
            'reset_password_box_title'        => 'Atstatyti slaptaþodá',
            'reset_password_button'           => 'Atstatyti slaptaþodá',
            'send_password_reset_link_button' => 'Siøsti slaptaþodþio atstatymo nuorodà',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Ðalies alfa kodai',
                'alpha2'  => 'Ðalies alfa 2 kodai',
                'alpha3'  => 'Ðalies alfa 3 kodai',
                'numeric' => 'Ðalies skaitmeniniai kodai',
            ],

            'macro_examples' => 'Makro pavyzdþiai',

            'state' => [
                'mexico' => 'Meksikos valstijos sàraðas',
                'us'     => [
                    'us'       => 'JAV valstijos',
                    'outlying' => 'JAV atokios teritorijos',
                    'armed'    => 'JAV kariuomenë',
                ],
            ],

            'territories' => [
                'canada' => 'Kanados provincijos ir teritorijø sàraðas',
            ],

            'timezone' => 'Laiko zona',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Pakeisti slaptaþodá',
            ],

            'profile' => [
                'avatar'             => 'Avataras',
                'created_at'         => 'Sukurta',
                'edit_information'   => 'Redaguoti informacijà',
                'email'              => 'El. paðtas',
                'last_updated'       => 'Paskutiná kartà atnaujinta',
                'name'               => 'Pavadinimas',
                'first_name'         => 'Vardas',
                'last_name'          => 'Pavardë',
                'update_information' => 'Atnaujinti informacijà',
            ],
        ],

    ],
];
