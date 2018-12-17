<?php

/**
 * All route names are prefixed with 'admin.'.
 */
 
 // categories
Route::get('categories', 'AdminCategoryController@index')->name('categories.index');
Route::get('categories/create', 'AdminCategoryController@create')->name('categories.create');
Route::post('categories', 'AdminCategoryController@store')->name('categories.store');
Route::get('categories/{category}/edit', 'AdminCategoryController@edit')->name('categories.edit');
Route::put('categories/{category}', 'AdminCategoryController@update')->name('categories.update');
Route::post('categories/{category}/delete', 'AdminCategoryController@destroy')->name('categories.destroy');

// coupons
Route::get('coupons', 'AdminCouponController@index')->name('coupons');
Route::get('coupons/{id}/activate', 'AdminCouponController@activate')->name('coupons.activation');
Route::post('coupons', 'AdminCouponController@store')->name('coupons.store');
Route::delete('coupons/{id}', 'AdminCouponController@destroy')->name('coupons.destroy');


 // blog categories
Route::get('blog-categories', 'AdminBlogCategoryController@index')->name('blog.categories.index');
Route::get('blog-categories/create', 'AdminBlogCategoryController@create')->name('blog.categories.create');
Route::post('blog-categories', 'AdminBlogCategoryController@store')->name('blog.categories.store');
Route::get('blog-categories/{category}/edit', 'AdminBlogCategoryController@edit')->name('blog.categories.edit');
Route::put('blog-categories/{category}', 'AdminBlogCategoryController@update')->name('blog.categories.update');
Route::post('blog-categories/{category}/delete', 'AdminBlogCategoryController@destroy')->name('blog.categories.destroy');
 
 // blog posts and pages
Route::get('pages/', 'AdminBlogController@index')->name('pages.index');
Route::get('pages/create', 'AdminBlogController@create')->name('pages.create');
Route::post('pages', 'AdminBlogController@store')->name('pages.store');
Route::get('pages/{post}/edit/{locale}', 'AdminBlogController@edit')->name('pages.edit');
Route::put('pages/{post}/{locale}', 'AdminBlogController@update')->name('pages.update');
Route::post('pages/{post}/{locale}/delete', 'AdminBlogController@destroy')->name('pages.destroy');
 
 // courses
Route::get('courses', 'AdminCourseController@index')->name('courses.index');
Route::post('courses/api', 'AdminCourseController@fetch')->name('courses.get');
Route::get('courses/{course}/review', 'AdminCourseController@review')->name('courses.review');
Route::delete('courses/{course}/destroy', 'AdminCourseController@destroy')->name('courses.destroy');
Route::get('courses/{course}/approval', 'AdminCourseController@statusUpdate')->name('courses.status.update');

// manage featured courses
Route::get('courses/featured', 'AdminCourseController@featured')->name('courses.featured');
Route::get('courses/fetch-all', 'AdminCourseController@fetchAllCourses')->name('courses.all.fetch');
Route::get('courses/featured/fetch', 'AdminCourseController@fetchFeatured')->name('courses.featured.fetch');
Route::put('courses/featured/update', 'AdminCourseController@updateFeatured')->name('courses.featured.update');



Route::get('withdrawals', 'AdminRevenueController@index')->name('withdrawals.index');
Route::post('withdrawals/api', 'AdminRevenueController@fetch')->name('withdrawals.get');
Route::put('withdrawals/api', 'AdminRevenueController@updateStatus')->name('withdrawals.update');

// edit environment variable

Route::get('settings/env', 'AdminSiteSettingsController@editEnv')->name('settings.env');
Route::post('settings/env/save', 'AdminSiteSettingsController@saveEnv')->name('settings.env.save');


// Site Settings
Route::get('settings', 'AdminSiteSettingsController@index')->name('settings.index');
Route::put('settings/update', 'AdminSiteSettingsController@updateSettings')->name('settings.update');


// System Messages
Route::get('messages', 'AdminSystemMessageController@index')->name('messages.index');
Route::put('messages/{id}', 'AdminSystemMessageController@update')->name('messages.update');
Route::post('messages', 'AdminSystemMessageController@store')->name('messages.store');
Route::get('messages/create', 'AdminSystemMessageController@create')->name('messages.create');
Route::get('messages/{id}/edit', 'AdminSystemMessageController@edit')->name('messages.edit');
Route::delete('messages/{id}/destroy', 'AdminSystemMessageController@destroy')->name('messages.destroy');
Route::get('messages/{id}/send', 'AdminSystemMessageController@send')->name('messages.send');
