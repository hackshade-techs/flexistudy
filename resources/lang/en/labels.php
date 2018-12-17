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
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'roles'          => 'Roles',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
        
        'courses' => [
            'drag-here' => 'Drag from here',
            'drop-here' => 'Drop course here to feature',
            'update-featured-list' => 'Update Featured Course List',
            'course-management' => 'Course Management',  
            'course-management-small' => 'Manage all courses created by authors',
            'featured-courses-small' => 'Manage all featured courses',
            'featured-courses' => 'Featured Courses',
            'all-courses' => 'All courses',
            'approved' => 'Approved',
            'pending-approval' => 'Pending Approval',
            'unpublished' => 'Unpublished',
            'draft' => 'Draft',
            'title' => 'Title',
            'author' => 'Author',
            'category' => 'Category',
            'price' => 'Price',
            'language' => 'Language',
            'published' => 'Published',
            'approved' => 'Approved',
            'review' => 'Review',
            'mark-as-featured' => 'Mark as Featured',
            'unmark-as-featured' => 'Unmark as Featured',
            'preview' => 'Preview in frontend',
            'review-comment' => 'Review comment',
            'decision' => 'Decision',
            'not-approved' => 'Not Approved',
            'cancel' => 'Cancel',
            'submit-review' => 'Submit review',
            'enter-comment' => 'Enter comment...',
            'live-course' => 'Live course',
            'unpublished-by-author' => 'Unpublished by Author',
            'awaiting-admin-approval' => 'Awaiting admin approval',
            'draft-course' => 'Draft course',
        ],
        
        'categories' => [
            'category-management' => 'Category Management',  
            'category-management-small' => 'Manage all categories. Note that you cannot delete a category that has courses.'
        ],
        
        'withdrawal' => [
            'withdrawal-management' => 'Manage Fund Withdrawal Requests',  
            'withdrawal-management-small' => 'List of withdrawal / payout requests from Authors',
            'user'  => 'User',
            'paypal-email'  => 'PayPal Email',
            'amount'  => 'Amount requested',
            'comment'  => 'Comment',
            'user-account-balance'  => 'User account balance',
            'status'  => 'Status',
            'date'  => 'Date',
            'all-requests' => 'All withdrawal requests',
            'submitted' => 'Submitted withdrawal requests',
            'processing'=> 'Requests being processed',
            'processed' => 'Processed requests',
            'update-request' => 'Update request'
        
        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
            'reset_password_box_title'    => 'Reset Password',
        ],

        'passwords' => [
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Country Alpha Codes',
                'alpha2'  => 'Country Alpha 2 Codes',
                'alpha3'  => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us'     => [
                    'us'       => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed'    => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
