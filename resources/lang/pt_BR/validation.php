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

    'accepted'             => 'O :attribute deve ser aceite.',
    'active_url'           => 'O :attribute não é um URL válido.',
    'after'                => 'O :attribute deve ser uma data depois de :date.',
    'after_or_equal'       => 'O :attribute deve ser uma data depois de ou igual a :date.',
    'alpha'                => 'O :attribute só deve conter letras.',
    'alpha_dash'           => 'O :attribute só deve conter letras, números e traços.',
    'alpha_num'            => 'O :attribute só deve conter letras e números.',
    'array'                => 'O :attribute deve ser uma lista.',
    'before'               => 'O :attribute  deve ser uma data antes de :date.',
    'before_or_equal'      => 'O :attribute deve ser uma data antes de ou igual a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve ser um número entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve ter entre :min e :max carateres.',
        'array'   => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'O :attribute de confirmação não corresponde.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não corresponde ao formato :format.',
    'different'            => 'O :attribute e :other devem ser diferentes.',
    'digits'               => 'O :attribute deve ser :digits dígitos.',
    'digits_between'       => 'O :attribute deve ser entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute tem um valor duplicado.',
    'email'                => 'O :attribute deve ser um e-mail válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ser preenchido.',
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'in_array'             => 'O :attribute não existe em :other.',
    'integer'              => 'O :attribute deve ser um número inteiro.',
    'ip'                   => 'O :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O :attribute deve ter um JSON válido.',
    'max'                  => [
        'numeric' => 'O número :attribute não deve ser maior que :max.',
        'file'    => 'O ficheiro :attribute não deve ter mais que :max kilobytes.',
        'string'  => 'O texto :attribute não deve ter mais que :max carateres.',
        'array'   => 'A lista :attribute não deve ter mais que :max itens.',
    ],
    'mimes'                => 'O :attribute deve ser um ficheiro :values.',
    'min'                  => [
        'numeric' => 'O número :attribute deve ser maior que :min.',
        'file'    => 'O ficheiro :attribute deve ter mais que :min kilobytes.',
        'string'  => 'O texto :attribute deve ter mais que :min carateres.',
        'array'   => 'A lista :attribute deve ter mais que :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório, exceto quando :other está em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não estão presentes.',
    'required_without_all' => 'O campo :attribute é obrigatório quando :values não estão presentes.',
    'same'                 => 'O :attribute e :other devem coincidir.',
    'size'                 => [
        'numeric' => 'O número :attribute deve ter :size carateres.',
        'file'    => 'O ficheiro :attribute deve ter :size kilobytes.',
        'string'  => 'O texto :attribute deve ter :size carateres.',
        'array'   => 'A lista :attribute deve ter :size itens.',
    ],
    'string'               => 'O :attribute deve ser texto.',
    'timezone'             => 'O :attribute deve ser uma zona válida.',
    'unique'               => 'O :attribute já está a ser usado.',
    'url'                  => 'O formato de :attribute é inválido.',

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
            'rule-name' => 'mensagem-personalizado',
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
                    'associated_roles' => 'Fuções associadas',
                    'dependencies'     => 'Dependencias',
                    'display_name'     => 'Nombre a visualizar',
                    'group'            => 'Grupo',
                    'group_sort'       => 'Ordem do Grupo',

                    'groups' => [
                        'name' => 'Nome do Grupo',
                    ],

                    'name'   => 'Nome',
                    'first_name' => 'Primeiro nome',
                    'last_name'  => 'Último Nome',
                    'system' => 'Sistema?',
                ],

                'roles' => [
                    'associated_permissions' => 'Permissões associadas',
                    'name'                   => 'Nome',
                    'sort'                   => 'Ordem',
                ],

                'users' => [
                    'active'                  => 'Ativo',
                    'associated_roles'        => 'Funçoes associadas',
                    'confirmed'               => 'Confirmado',
                    'email'                   => 'Direção de email',
                    'name'                    => 'Nome',
                    'first_name'              => 'Primeiro Nome',
                    'last_name'               => 'Último Nome',
                    'other_permissions'       => 'Outras Permissões',
                    'password'                => 'Palavra-passe',
                    'password_confirmation'   => 'Confirmação da palavras-passe',
                    'send_confirmation_email' => 'Enviar email de confirmação',
                ],
            ],
        ],

        'frontend' => [
            'email'                     => 'Email',
            'first_name'                => 'Primeiro nome',
            'last_name'                 => 'Último nome',
            'username'                  => 'Nome de utilizador',
            'tagline'                   => 'Trabalho',
            'bio'                       => 'Sobre mi',
            'facebook'                  => 'Facebook',
            'linkedin'                  => 'LinkedIn',
            'github'                    => 'GitHub',
            'twitter'                   => 'Twitter',
            'youtube'                   => 'YouTube',
            'web'                       => 'Website',
            'avatar'                    => 'Avatar',
            'password'                  => 'Palavra-passe',
            'password_confirmation'     => 'Confirmação da palavras-passe',
            'old_password'              => 'Palavra-passe antiga',
            'new_password'              => 'Nova Palavra-passe',
            'new_password_confirmation' => 'Confirmação da nova palavra-passe',
            'title'                     => 'Título',
            'description'               => 'Descrição',
            'technologies'              => 'Tecnologias',
            'category'                  => 'Categoria',
        ],
    ],

];
