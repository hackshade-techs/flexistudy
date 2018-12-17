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
                'already_exists'    => 'Essa função já existe. Por favor escolha um nome diferente.',
                'cant_delete_admin' => 'Você não pode excluir a função de Administrador.',
                'create_error'      => 'Ocorreu um problema ao criar essa função. Por favor, tente novamente.',
                'delete_error'      => 'Ocorreu um problema ao eliminar essa função. Por favor, tente novamente.',
                'has_users'         => 'Você não pode eliminar uma função com utilizadores associados.',
                'needs_permission'  => 'Você deve selecionar pelo menos uma permissão para essa função.',
                'not_found'         => 'Essa função não existe.',
                'update_error'      => 'Ocorreu um problema ao atualizar essa função. Por favor, tente novamente.',
            ],

            'users' => [
                'cant_deactivate_self'  => 'Você não pode fazer isso consigo.',
                'cant_delete_admin'  => 'Você não pode apagar o super administrador.',
                'cant_delete_self'      => 'Não pode ser você a eliminar-se.',
                'cant_delete_own_session' => 'Você não pode eliminar sua própria sessão.',
                'cant_restore'          => 'Este utilizador não pode ser eliminado porque é impossivel restaurar.',
                'create_error'          => 'Ocorreu um problema ao criar o Utilizador.  Por favor, tente novamente.',
                'delete_error'          => 'Ocorreu um problema ao eliminar o Utilizador.  Por favor, tente novamente.',
                'delete_first'          => 'Este utilizador tem que ser eliminado para poder ser removido de forma permanente.',
                'email_error'           => 'Este endereço de email pertence a outro utilizador.',
                'mark_error'            => 'Ocorreu um problema ao atualizar este utilizador. Por favor, tente novamente.',
                'not_found'             => 'Este utilizador não existe.',
                'restore_error'         => 'Ocorreu um problema ao atualizar este utilizador. Por favor, tente novamente.',
                'role_needed_create'    => 'Você tem que escolher uma função.',
                'role_needed'           => 'Você deve escolher pelo menos uma função.',
                'session_wrong_driver'  => 'Para poder utilizar esta função a sua sessão tem que estar direcionada a uma base de dados.',
                'update_error'          => 'Ocorreu um problema ao atualizar este utilizador. Por favor, tente novamente.',
                'update_password_error' => 'Ocorreu um problema ao alterar a palavra-passe de utilizador. Por favor, tente novamente.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Sua conta já foi verificada.',
                'confirm'           => 'Confirme sua conta!',
                'created_confirm'   => 'Sua conta foi criada com sucesso. Enviamos um email para verificação da sua conta.',
                'mismatch'          => 'O código de verificação não corresponde.',
                'not_found'         => 'Esse código de verificação não existe.',
                'resend'            => 'Sua conta não está verificada. Por favor, clique no enlace de confirmação no seu email, ou <a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">Clique aqui</a> Para reenviar um email de verificação.',
                'success'           => 'Sua conta foi verificada com sucesso!',
                'resent'            => 'Um novo email de confirmação foi enviado para o seu endereço.',
            ],

            'deactivated' => 'Sua conta foi desativada.',
            'email_taken' => 'O email especificado já está registrado.',

            'password' => [
                'change_mismatch' => 'Esta não é sua palavra-passe antiga.',
                'reset_problem' => 'Ocorreu um problema ao restaurar sua palavra-passe.  Por favor reenvie para o email a palavra-passe restaurada..',
            ],

            'registration_disabled' => 'Neste momento já não é possivel efetuar o registo.',
        ],
    ],
];
