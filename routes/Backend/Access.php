<?php

/**
 * All route names are prefixed with 'admin.access'.
 */
Route::group(['prefix' => 'access', 'as' => 'access.', 'namespace'  => 'Access'], function () {

    /*
     * User Management
     */
    Route::group(['middleware' => 'access.routeNeedsRole:1',], function () {
        
        Route::group(['namespace' => 'User'], function () {
            /*
             * For DataTables
             */
            Route::post('user/get', 'UserTableController')->name('user.get');

            /*
             * User Status'
             */
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');

            /*
             * User CRUD
             */
           //Route::resource('user', 'UserController');
            Route::get('user', 'UserController@index')->name('user.index');
            Route::get('user/create', 'UserController@create')->name('user.create');
            Route::get('user/{user}', 'UserController@show')->name('user.show');
            Route::post('user', 'UserController@store')->name('user.store');
            Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
            Route::patch('user/{user}', 'UserController@update')->name('user.update');
            Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');
            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);

                // Password
                Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
                Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password.post');

                // Access
                Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');

                // Session
                Route::get('clear-session', 'UserSessionController@clearSession')->name('user.clear-session');
            });

            /*
             * Deleted User
             */
            Route::group(['prefix' => 'user/{deletedUser}'], function () {
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });
        });

        /*
        * Role Management
        */
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', 'RoleController', ['except' => ['show']]);

            //For DataTables
            Route::post('role/get', 'RoleTableController')->name('role.get');
        });
    });
});
