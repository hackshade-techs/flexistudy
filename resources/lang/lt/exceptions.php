<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists'    => '�is rol� jau egzistuoja. Pasirinkite kit� pavadinim�.',
                'cant_delete_admin' => 'Negalite i�trinti Administratoriaus rol�s.',
                'create_error'      => 'Kuriant �i� rol� kilo problema. Bandykite dar kart�.',
                'delete_error'      => 'Trinant �i� rol� kilo problema. Bandykite dar kart�.',
                'has_users'         => 'Negalima i�trinti rol�s turin�ios susijusius vartotojus.',
                'needs_permission'  => 'Rolei reikia priskirti bent vien� teis�.',
                'not_found'         => '�i rol� neegzistuoja.',
                'update_error'      => 'Kei�iant �i� rol� kilo problema. Bandykite dar kart�.',
            ],

            'users' => [
                'cant_deactivate_self'  => 'J�s negalite to padaryti sau.',
                'cant_delete_admin'  => 'J�s negalite i�trinti super administratoriaus.',
                'cant_delete_self'      => 'J�s negalite i�trinti sav�s.',
                'cant_delete_own_session' => 'J�s negalite i�trinti savo sesijos.',
                'cant_restore'          => 'Vartotojas nebuvo i�trintas, tod�l negali b�ti atstatytas.',
                'create_error'          => 'Kuriant vartotoj� kilo problema. Bandykite dar kart�.',
                'delete_error'          => 'Trinant vartotoj� kilo problema. Bandykite dar kart�.',
                'delete_first'          => 'Vartotojas turi b�ti i�trintas prie� panaikinant j� visi�kai.',
                'email_error'           => '�is el. pa�to adresas priklauso kitam vartotojui.',
                'mark_error'            => 'Kei�iant vartotoj� kilo problema. Bandykite dar kart�.',
                'not_found'             => '�is vartotojas neegzistuoja.',
                'restore_error'         => 'Atstatant vartotoj� kilo problema. Bandykite dar kart�.',
                'role_needed_create'    => 'Privalote pasirinkti bent vien� rol�.',
                'role_needed'           => 'Privalote pasirinkti bent vien� rol�.',
                'session_wrong_driver'  => 'J�s�  sesijos valdiklis privalo b�ti nustatytas duomen� bazei, kad naudoti �� funkcionalum�.',
                'update_error'          => 'Atnaujinant vartotoj� kilo problema. Bandykite dar kart�.',
                'update_password_error' => 'Kei�iant vartotojo slapta�od� kilo problema. Bandykite dar kart�.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'J�s� paskyra jau patvirtinta.',
                'confirm'           => 'Patvirtinkite savo paskyr�!',
                'created_confirm'   => 'J�s� paskyra buvo s�kmingai sukurta. Mes atsi�sime jums el. lai�k�, kad patvirtintume j�s� paskyr�.',
                'mismatch'          => 'J�s� patvirtinimo kodas nesutampa.',
                'not_found'         => '�is patvirtinimo kodas neegzistuoja.',
                'resend'            => 'J�s� paskyra nepatvirtinta. Spustel�kite patvirtinimo nuorod� el. lai�ke arba <a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">spausti �ia</a> pakartotinai si�sti patvirtinimo el. lai�k�.',
                'success'           => 'J�s� s�skaita s�kmingai patvirtinta!',
                'resent'            => 'Naujas patvirtinimo el. lai�kas i�si�stas faile nurodytu adresu.',
            ],

            'deactivated' => 'J�s� paskyra buvo i�jungta.',
            'email_taken' => '�is el. pa�to adresas jau yra priimtas.',

            'password' => [
                'change_mismatch' => 'Tai ne j�s� senas slapta�odis.',
                'reset_problem' => 'I� naujo nustatant slapta�od� kilo problema. Pra�ome dar kart� i�si�sti el. pa�to slapta�od�.',
            ],

            'registration_disabled' => 'Registracija �iuo metu u�daryta.',
        ],
    ],
];
