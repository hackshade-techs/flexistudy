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
        'all'     => 'Todos',
        'yes'     => 'Sim',
        'no'      => 'Não',
        'custom'  => 'Personalizado',
        'actions' => 'Ações',
        'active'  => 'Ativo',
        'buttons' => [
            'save'   => 'Guardar',
            'update' => 'Atualizar',
        ],
        'hide'              => 'Ocultar',
        'inactive'          => 'Inativo',
        'none'              => 'Nenhum',
        'show'              => 'Mostrar',
        'toggle_navigation' => 'Alterar estado enu de navegação',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Criar função',
                'edit'       => 'Editar função',
                'management' => 'Gestão de funções',

                'table' => [
                    'number_of_users' => 'Número de utilizadores',
                    'permissions'     => 'Permissões',
                    'role'            => 'Função',
                    'sort'            => 'Ordenar',
                    'total'           => 'Todas funções',
                ],
            ],

            'users' => [
                'active'              => 'Utilizadores ativos',
                'all_permissions'     => 'Todas permissões',
                'change_password'     => 'Mudar palavra-passe',
                'change_password_for' => 'Mudar palavra-passe de :utilizador',
                'create'              => 'Criar utilizador',
                'deactivated'         => 'Utilizador desativado',
                'deleted'             => 'Utilizador eliminado',
                'edit'                => 'Modificar utilizador',
                'management'          => 'Gerenciamento de utilizadores',
                'no_permissions'      => 'Sem permissões',
                'no_roles'            => 'Sem Funções para configurar.',
                'permissions'         => 'Permissões',

                'table' => [
                    'confirmed'      => 'Confirmado',
                    'created'        => 'Criado',
                    'email'          => 'Email',
                    'id'             => 'ID',
                    'last_updated'   => 'Ultima atualização',
                    'name'           => 'Nome',
                    'first_name'     => 'Primeiro nome',
                    'last_name'      => 'Ultimo nome',
                    'no_deactivated' => 'Nao existem utilizadores desativados',
                    'no_deleted'     => 'Nao existem utilizadores apagados',
                    'roles'          => 'Funções',
                    'total'          => 'Total de utilizadores',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Visão geral',
                        'history'  => 'História',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmado',
                            'created_at'   => 'Criado em',
                            'deleted_at'   => 'Apagado em',
                            'email'        => 'Email',
                            'last_updated' => 'Última Actualización',
                            'name'         => 'Nome',
                            'first_name'   => 'Primeiro nome',
                            'last_name'    => 'Ultimo nome',
                            'status'       => 'Estado',
                        ],
                    ],
                ],

                'view' => 'Ver Utilizador',
            ],
        ],
        
        'courses' => [
            'drag-here' => 'Arrastre desde aquí',
            'drop-here' => 'Coloque aqui o curso a apresentar',
            'update-featured-list' => 'Atualizar lista de próximos cursos',
            'course-management' => 'Gestão de cursos',  
            'course-management-small' => 'Gerir todos os cursos criados por autores',
            'featured-courses-small' => 'Gerir todos os cursos em destaque',
            'featured-courses' => 'Cursos em destaque',
            'all-courses' => 'Todos os cursos',
            'approved' => 'Aprovado',
            'pending-approval' => 'Aprovação pendente',
            'unpublished' => 'Não publicado',
            'draft' => 'Borrador',
            'title' => 'Título',
            'author' => 'Autor',
            'category' => 'Categoría',
            'price' => 'Preço',
            'language' => 'Idioma',
            'published' => 'Publicado',
            'approved' => 'Aprovado',
            'review' => 'Rever',
            'mark-as-featured' => 'Marcar como Destaque',
            'unmark-as-featured' => 'Desmarcar como Destaque',
            'preview' => 'Pré-visualização do interface',
            'review-comment' => 'Comentário',
            'decision' => 'Decisão',
            'not-approved' => 'Nao aprovado',
            'cancel' => 'Cancelar',
            'submit-review' => 'Enviar opinião ',
            'enter-comment' => 'Introduzir comentário...',
            'live-course' => 'Curso ao vivo',
            'unpublished-by-author' => 'Não publicado pelo autor',
            'awaiting-admin-approval' => 'Aguarda aprovação do administrador',
            'draft-course' => 'Curso em projeto',
        ],
        
        'categories' => [
            'category-management' => 'Gestão de categorias',  
            'category-management-small' => 'Gerir todas as categorías. Note que você não pode excluir uma categoria que tenha cursos.'
        ],
        
        'withdrawal' => [
            'withdrawal-management' => 'Gerir pedidos de fundos de levantamento',  
            'withdrawal-management-small' => 'Lista de levantamentos / pedido de pagamento de Autores',
            'user'  => 'Utilizador',
            'paypal-email'  => 'Email por PayPal',
            'amount'  => 'Montante solicitado',
            'comment'  => 'Comentário',
            'user-account-balance'  => 'Saldo da conta do utilizador',
            'status'  => 'Estado',
            'date'  => 'Data',
            'all-requests' => 'Todos os pedidos de levantamento',
            'submitted' => 'Pedidos de levantamento submetidos',
            'processing'=> 'Pedidos em processamento ',
            'processed' => 'Pedidos procesados',
            'update-request' => 'Pedido de Actualização'
        
        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Iniciar sessão',
            'login_button'       => 'Iniciar sessão',
            'login_with'         => 'Iniciar sessão mediante :social_media',
            'register_box_title' => 'Registo',
            'register_button'    => 'Registo',
            'reset_password_box_title'    => 'Redefinir palavra-passe',
            'remember_me'        => 'Lembrar-me',
        ],

        'passwords' => [
            'forgot_password'                 => 'Esqueceu-se da palavra-passe?',
            'reset_password_box_title'        => 'Redefinir palavra-passe',
            'reset_password_button'           => 'Redefinir palavra-passe',
            'send_password_reset_link_button' => 'Enviar link para redefinir palavra-passe',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Código Alfa de País',
                'alpha2'  => 'Código Alfa 2 de País',
                'alpha3'  => 'Código Alfa 3 de País',
                'numeric' => 'Código Numérico de País',
            ],

            'macro_examples' => 'Exemplos de Macro',

            'state' => [
                'mexico' => 'Lista de Estados de México',
                'us'     => [
                    'us'       => 'Estados Unidos',
                    'outlying' => 'Territorios Periféricos de Estados Unidos',
                    'armed'    => 'Fuerzas Armadas de Estados Unidos',
                ],
            ],

            'territories' => [
                'canada' => 'Lista de Provincias e Territórios do Canadá',
            ],

            'timezone' => 'Fuso horário',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Mudar a palavra-passe',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Criado em',
                'edit_information'   => 'Editar a informação',
                'email'              => 'Email',
                'last_updated'       => 'Última atualização',
                'name'               => 'Nome',
                'first_name'         => 'Primeiro nome',
                'last_name'          => 'Último nome',
                'update_information' => 'Atualizar a informação',
            ],
        ],

    ],
];
