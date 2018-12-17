<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/avatar/{user}', 'Frontend\User\ProfileController@updateAvatar');

// course

Route::get('/author/course/{id}', 'Frontend\Author\CourseController@getCourse');
Route::put('/author/course/{id}', 'Frontend\Author\CourseController@update');
Route::put('/author/course/price/{id}/update', 'Frontend\Author\CourseController@updatePrice');


Route::post('/author/course/image/{id}', 'Frontend\Author\CourseController@updateImage');

/**** MOBILE APP ROUTES ****/
Route::post('/login', 'Api\UserController@login');

// fetch all courses
Route::get('/courses', 'Api\CourseController@fetchAll');
Route::get('/courses/{id}', 'Api\CourseController@getCourseById');

// blog and pages content
Route::get('/page/{page}', 'Api\BlogController@showPage');
Route::get('/blog', 'Api\BlogController@getPosts');
Route::get('/posts/{id}', 'Api\BlogController@showPost');

/*
Route::get('/blog/category/{category}', 'BlogController@getPostsByCategory')->name('blog.category.index');

*/

// frontend fetch quiz questions
Route::get('/user/quiz/{lesson}/questions', 'Frontend\User\QuizController@fetchQuestions');

Route::get('braintree/token', 'Frontend\Payments\BraintreeController@token');

Route::group(['middleware' => 'auth:api'], function () {
    
    // section
    Route::post('/author/section', 'Frontend\Author\SectionController@store');
    Route::get('/author/{course}/sections', 'Frontend\Author\SectionController@getSections');
    Route::get('/author/section/{id}', 'Frontend\Author\SectionController@edit');
    Route::put('/author/section/{id}', 'Frontend\Author\SectionController@update');
    Route::put('/author/sections/draggable', 'Frontend\Author\SectionController@updateDraggable');
    Route::delete('/author/section/{id}', 'Frontend\Author\SectionController@destroy');
    
    //quiz
    Route::post('/author/quiz/{lesson_id}/question', 'Frontend\Author\QuizController@saveQuestion');
    Route::put('/author/quiz/{question_id}/update', 'Frontend\Author\QuizController@updateQuestion');
    Route::delete('/author/quiz/{question_id}', 'Frontend\Author\QuizController@deleteQuestion');
    
    // save quiz attempt
    Route::post('/user/quiz/{leson}/saveAttempt', 'Frontend\User\QuizController@saveAttempt');

    
    Route::group(['namespace' => 'Api'], function () {
        // login and logout
        Route::get('/profile', 'UserController@profile');
        Route::post('/logout', 'UserController@logout');
        
        // logged in user's courses
        Route::get('/user/{id}/courses', 'UserController@getLoggedInUserCourses');
    });
});



// lesson
Route::get('/author/lesson/{id}', 'Frontend\Author\LessonController@edit');
Route::post('/author/lesson', 'Frontend\Author\LessonController@store');
Route::put('/author/lesson/{id}', 'Frontend\Author\LessonController@update');
Route::put('/author/lessons/draggable', 'Frontend\Author\LessonController@updateDraggable');
Route::delete('/author/lesson/{id}', 'Frontend\Author\LessonController@destroy');


// content
Route::get('/author/lesson/content/{id}', 'Frontend\Author\ContentController@edit');
Route::get('/author/lesson/video-content/{lesson_id}', 'Frontend\Author\ContentController@editEmbed');

Route::post('/author/lesson/video/upload', 'Frontend\Author\ContentController@uploadVideo');
Route::post('/author/lesson/article/create', 'Frontend\Author\ContentController@createArticle');
Route::put('/author/lesson/video/update', 'Frontend\Author\ContentController@updateVideo');
Route::put('/author/lesson/article/{id}', 'Frontend\Author\ContentController@updateArticle');

// content embed
Route::post('/author/lesson/{id}/video/embed', 'Frontend\Author\ContentController@embedVideo');
Route::put('/author/lesson/{id}/video/update-embed', 'Frontend\Author\ContentController@updateEmbedVideo');

// coupons
Route::get('/author/course/{id}/coupons', 'Frontend\Author\CouponController@getCoupons');
Route::post('/author/course/coupon', 'Frontend\Author\CouponController@store');
Route::put('/author/coupon/{id}/activate', 'Frontend\Author\CouponController@activate');




