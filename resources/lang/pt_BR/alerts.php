<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'Função criada com sucesso.',
            'deleted' => 'Função eliminada com sucesso.',
            'updated' => 'Função atualizada com sucesso.',
        ],

        'users' => [
            'confirmation_email'  => 'Uma nova mensagem de confirmação foi enviada para o seu email.',
            'created'             => 'Utilizador criado com sucesso.',
            'deleted'             => 'Utilizador eliminado com sucesso.',
            'deleted_permanently' => 'Utilizador eliminado de forma permanente.',
            'restored'            => 'Utilizador restaurado com sucesso.',
            'session_cleared'      => "A sessão do utilizador foi encerrada com sucesso.",
            'updated'             => 'Utilizador atualizado com sucesso.',
            'updated_password'    => 'A senha do utilizador foi atualizada com sucesso.',
        ],
    ],
    
    'frontend' => [
        'general' => [
            'delete-confirm-title' => "¿Você tem certeza?", 
            'delete-confirm-text' => "¡Esta secção será eliminada de forma permanente com todas as suas lições!",
            'yes-delete' => "Sim, eliminar.",
            "cancel" => "Cancelar",
            "wrong-price" => "Parece que o pedido de compra foi realizado com um preço incorreto. Negocio cancelado."
        ]   
        
    ]
];
