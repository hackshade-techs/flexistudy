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
        'yes'     => 'Sí',
        'no'      => 'No',
        'custom'  => 'Personalizado',
        'actions' => 'Acciones',
        'active'  => 'Activo',
        'buttons' => [
            'save'   => 'Guardar',
            'update' => 'Actualizar',
        ],
        'hide'              => 'Ocultar',
        'inactive'          => 'Inactivo',
        'none'              => 'Ningúno',
        'show'              => 'Mostrar',
        'toggle_navigation' => 'Abrir/Cerrar menú de navegación',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Crear Rol',
                'edit'       => 'Modificar Rol',
                'management' => 'Administración de Roles',

                'table' => [
                    'number_of_users' => 'Número de Usuarios',
                    'permissions'     => 'Permisos',
                    'role'            => 'Rol',
                    'sort'            => 'Orden',
                    'total'           => 'Todos los Roles',
                ],
            ],

            'users' => [
                'active'              => 'Usuarios activos',
                'all_permissions'     => 'Todos los Permisos',
                'change_password'     => 'Cambiar la contraseña',
                'change_password_for' => 'Cambiar la contraseña para :user',
                'create'              => 'Crear Usuario',
                'deactivated'         => 'Usuarios desactivados',
                'deleted'             => 'Usuarios eliminados',
                'edit'                => 'Modificar Usuario',
                'management'          => 'Administración de Usuarios',
                'no_permissions'      => 'Sin Permisos',
                'no_roles'            => 'No hay Roles disponibles.',
                'permissions'         => 'Permisos',

                'table' => [
                    'confirmed'      => 'Confirmado',
                    'created'        => 'Creado',
                    'email'          => 'Correo',
                    'id'             => 'ID',
                    'last_updated'   => 'Última modificación',
                    'name'           => 'Nombre',
                    'first_name'     => 'Nombre de pila',
                    'last_name'      => 'Apellido',
                    'no_deactivated' => 'Ningún Usuario desactivado disponible',
                    'no_deleted'     => 'Ningún Usuario eliminado disponible',
                    'roles'          => 'Roles',
                    'total'          => 'Todos los Usuarios',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Resúmen',
                        'history'  => 'Historia',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmado',
                            'created_at'   => 'Creación',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Última Actualización',
                            'name'         => 'Nombre',
                            'first_name'   => 'Nombre de pila',
                            'last_name'    => 'Apellido',
                            'status'       => 'Estatus',
                        ],
                    ],
                ],

                'view' => 'Ver Usuario',
            ],
        ],
        
        'courses' => [
            'drag-here' => 'Arrastre desde aquí',
            'drop-here' => 'Tiro de la gota aquí para ofrecer',
            'update-featured-list' => 'Actualizar lista de cursos destacados',
            'course-management' => 'Administrar cursos',  
            'course-management-small' => 'Administrar todos los cursos creados por los autores',
            'featured-courses-small' => 'Administrar todos los cursos destacados',
            'featured-courses' => 'Cursos destacados',
            'all-courses' => 'Todos los cursos',
            'approved' => 'Aprobado',
            'pending-approval' => 'Aprobación pendiente',
            'unpublished' => 'Inédito',
            'draft' => 'Borrador',
            'title' => 'Título',
            'author' => 'Autor',
            'category' => 'Categoría',
            'price' => 'Precio',
            'language' => 'Idioma',
            'published' => 'Publicado',
            'approved' => 'Aprobado',
            'review' => 'Revisión',
            'mark-as-featured' => 'Marcar como Destacados',
            'unmark-as-featured' => 'Desmarcar como Destacados',
            'preview' => 'Vista previa en la interfaz',
            'review-comment' => 'Comentario',
            'decision' => 'Decisión',
            'not-approved' => 'No aprovado',
            'cancel' => 'Cancelar',
            'submit-review' => 'Enviar opinión',
            'enter-comment' => 'Introducir comentario...',
            'live-course' => 'Curso en vivo',
            'unpublished-by-author' => 'Inédito por autor',
            'awaiting-admin-approval' => 'A la espera de la aprobación del administrador',
            'draft-course' => 'Curso de borrador',
        ],
        
        'categories' => [
            'category-management' => 'Administrar categorías',  
            'category-management-small' => 'Administrar todas las categorías. Tenga en cuenta que no puede eliminar una categoría que tiene cursos.'
        ],
        
        'withdrawal' => [
            'withdrawal-management' => 'Gestionar solicitudes de retiro de fondos',  
            'withdrawal-management-small' => 'Lista de solicitudes de retiro / pago de los autores',
            'user'  => 'Usuario',
            'paypal-email'  => 'Correo electrónico por PayPal',
            'amount'  => 'Importe solicitado',
            'comment'  => 'Comentario',
            'user-account-balance'  => 'Saldo de cuenta de usuario',
            'status'  => 'Estado',
            'date'  => 'Fecha',
            'all-requests' => 'Todas las solicitudes de retiro',
            'submitted' => 'Solicitudes de retiro presentadas',
            'processing'=> 'Tratamiento',
            'processed' => 'Solicitudes procesadas',
            'update-request' => 'Actualizar'
        
        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Iniciar Sesión',
            'login_button'       => 'Iniciar Sesión',
            'login_with'         => 'Iniciar Sesión mediante :social_media',
            'register_box_title' => 'Registrarse',
            'register_button'    => 'Registrarse',
            'reset_password_box_title'    => 'Restablecer la contraseña',
            'remember_me'        => 'Recordarme',
        ],

        'passwords' => [
            'forgot_password'                 => 'Se ha olvidado la contraseña?',
            'reset_password_box_title'        => 'Reiniciar contraseña',
            'reset_password_button'           => 'Reiniciar contraseña',
            'send_password_reset_link_button' => 'Enviar el correo de verificación',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Código Alfa de País',
                'alpha2'  => 'Código Alfa 2 de País',
                'alpha3'  => 'Código Alfa 3 de País',
                'numeric' => 'Código Numérico de País',
            ],

            'macro_examples' => 'Ejemplos de Macro',

            'state' => [
                'mexico' => 'Listado de Estados de México',
                'us'     => [
                    'us'       => 'Estados Unidos',
                    'outlying' => 'Territorios Periféricos de Estados Unidos',
                    'armed'    => 'Fuerzas Armadas de Estados Unidos',
                ],
            ],

            'territories' => [
                'canada' => 'Listado de Provincias y Territorios de Canada',
            ],

            'timezone' => 'Zonas horarias',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Cambiar la contraseña',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Creado el',
                'edit_information'   => 'Modificar la información',
                'email'              => 'Correo',
                'last_updated'       => 'Última modificación',
                'name'               => 'Nombre',
                'first_name'         => 'Nombre de pila',
                'last_name'          => 'Apellido',
                'update_information' => 'Actualizar la información',
            ],
        ],

    ],
];
