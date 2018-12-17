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
                'already_exists'    => 'Ðis rolë jau egzistuoja. Pasirinkite kità pavadinimà.',
                'cant_delete_admin' => 'Negalite iðtrinti Administratoriaus rolës.',
                'create_error'      => 'Kuriant ðià rolæ kilo problema. Bandykite dar kartà.',
                'delete_error'      => 'Trinant ðià rolæ kilo problema. Bandykite dar kartà.',
                'has_users'         => 'Negalima iðtrinti rolës turinèios susijusius vartotojus.',
                'needs_permission'  => 'Rolei reikia priskirti bent vienà teisæ.',
                'not_found'         => 'Ði rolë neegzistuoja.',
                'update_error'      => 'Keièiant ðià rolæ kilo problema. Bandykite dar kartà.',
            ],

            'users' => [
                'cant_deactivate_self'  => 'Jûs negalite to padaryti sau.',
                'cant_delete_admin'  => 'Jûs negalite iðtrinti super administratoriaus.',
                'cant_delete_self'      => 'Jûs negalite iðtrinti savæs.',
                'cant_delete_own_session' => 'Jûs negalite iðtrinti savo sesijos.',
                'cant_restore'          => 'Vartotojas nebuvo iðtrintas, todël negali bûti atstatytas.',
                'create_error'          => 'Kuriant vartotojà kilo problema. Bandykite dar kartà.',
                'delete_error'          => 'Trinant vartotojà kilo problema. Bandykite dar kartà.',
                'delete_first'          => 'Vartotojas turi bûti iðtrintas prieð panaikinant já visiðkai.',
                'email_error'           => 'Ðis el. paðto adresas priklauso kitam vartotojui.',
                'mark_error'            => 'Keièiant vartotojà kilo problema. Bandykite dar kartà.',
                'not_found'             => 'Ðis vartotojas neegzistuoja.',
                'restore_error'         => 'Atstatant vartotojà kilo problema. Bandykite dar kartà.',
                'role_needed_create'    => 'Privalote pasirinkti bent vienà rolæ.',
                'role_needed'           => 'Privalote pasirinkti bent vienà rolæ.',
                'session_wrong_driver'  => 'Jûsø  sesijos valdiklis privalo bûti nustatytas duomenø bazei, kad naudoti ðá funkcionalumà.',
                'update_error'          => 'Atnaujinant vartotojà kilo problema. Bandykite dar kartà.',
                'update_password_error' => 'Keièiant vartotojo slaptaþodá kilo problema. Bandykite dar kartà.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Jûsø paskyra jau patvirtinta.',
                'confirm'           => 'Patvirtinkite savo paskyrà!',
                'created_confirm'   => 'Jûsø paskyra buvo sëkmingai sukurta. Mes atsiøsime jums el. laiðkà, kad patvirtintume jûsø paskyrà.',
                'mismatch'          => 'Jûsø patvirtinimo kodas nesutampa.',
                'not_found'         => 'Ðis patvirtinimo kodas neegzistuoja.',
                'resend'            => 'Jûsø paskyra nepatvirtinta. Spustelëkite patvirtinimo nuorodà el. laiðke arba <a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">spausti èia</a> pakartotinai siøsti patvirtinimo el. laiðkà.',
                'success'           => 'Jûsø sàskaita sëkmingai patvirtinta!',
                'resent'            => 'Naujas patvirtinimo el. laiðkas iðsiøstas faile nurodytu adresu.',
            ],

            'deactivated' => 'Jûsø paskyra buvo iðjungta.',
            'email_taken' => 'Ðis el. paðto adresas jau yra priimtas.',

            'password' => [
                'change_mismatch' => 'Tai ne jûsø senas slaptaþodis.',
                'reset_problem' => 'Ið naujo nustatant slaptaþodá kilo problema. Praðome dar kartà iðsiøsti el. paðto slaptaþodá.',
            ],

            'registration_disabled' => 'Registracija ðiuo metu uþdaryta.',
        ],
    ],
];
