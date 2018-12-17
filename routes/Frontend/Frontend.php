<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
 

Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

Route::get('/check/finish', 'Install\CheckController@finish')->name('check.finish');

// contact us
Route::get('/contact-us', 'ContactController@index')->name('contact.index');
Route::post('/contact-us/send', 'ContactController@sendMail')->name('contact.send');
        
// courses
Route::get('/courses', 'CourseController@getCourses')->name('course.get');
Route::get('/courses/tag/{tag}', 'CourseController@getCourses')->name('course.tag.get');

// set a cookie if there is a ref_id attached to the request
Route::get('/courses/{id}/learn', 'CourseController@show')->name('course.show')->middleware('affiliateCookie');

// course search
Route::get('/search/courses', 'SearchController@autocompleteCourse');
Route::get('/search/authors', 'SearchController@autocompleteAuthor');


//course review
Route::get('/courses/{course}/reviews', 'User\ReviewController@getReviews');

// lessons
Route::get('/{course}/learn/{lesson}', 'LessonController@show')->name('lesson.show');
    
// course payment
Route::get('/payment/course/{course}/checkout', 'Payments\StripePaymentController@checkout')->name('courses.checkout');
Route::post('/courses/charge', 'Payments\StripePaymentController@charge')->name('courses.charge');
Route::post('/courses/charge/paypal', 'Payments\PayPalPaymentController@charge')->name('courses.charge.paypal');
Route::get('/courses/charge/paypal', 'Payments\PayPalPaymentController@paymentStatus')->name('courses.charge.paypal.status');
Route::post('/courses/charge/razorpay', 'Payments\RazorpayPaymentController@charge')->name('courses.charge.razorpay');

Route::post('/courses/charge/braintree', 'Payments\BraintreeController@charge')->name('courses.charge.braintree');
Route::post('/courses/charge/omise', 'Payments\OmisePaymentController@charge')->name('courses.charge.omise');


// site pages
Route::get('/page/{page}', 'BlogController@showPage')->name('pages.show');
Route::get('/blog', 'BlogController@getPosts')->name('blog.index');
Route::get('/blog/category/{category}', 'BlogController@getPostsByCategory')->name('blog.category.index');
Route::get('/blog/{blog}', 'BlogController@showPost')->name('posts.show');

// coupon
Route::post('/courses/coupon', 'Payments\StripePaymentController@applyCoupon')->name('course.coupon.apply');    
    
// user's public profile page   
Route::get('/user/{user}', 'ProfileController@show')->name('user.public.profile');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        
        
        
        // notifications
        Route::get('my-notifications', function () {
            return view('frontend.user.user-notifications');
        });
        
        Route::delete('user/{user}/notifications', function(App\Models\Access\User\User $user){
           $user->unreadNotifications->map(function($n){
              $n->markAsRead(); 
           }); 
           return back();
        });
        
        Route::get('notifications/{id}','NotificationController@markAsRead')->name('notification.mark-as-read');
        
        // become an author
        Route::get('/teach/start', 'CourseController@becomAnAuthor')->name('become.author');
        Route::post('/teach/start', 'CourseController@store')->name('become.author.store');
        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');
        
        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
        
        /*
         * User Affiliate Sales
         */
        
        Route::get('revenue/affiliate', 'RevenueController@myRevenue')->name('revenue.affiliate');
        Route::get('revenue/withdraw', 'RevenueController@requestWithdrawal')->name('revenue.withdraw');
        
        // User courses
        Route::get('courses/my-courses/learning', 'CourseController@myCourses')->name('courses.learning');
        Route::get('courses/my-purchases/history', 'CourseController@myPurchases')->name('courses.purchases');
        Route::get('courses/my-wishlist/learning', 'CourseController@myWishlist')->name('courses.wishlist');
        
        
        // completion
        Route::post('/lessons/{lesson}/mark-as-complete', 'CourseController@markAsComplete')->name('lessons.completion');
        Route::post('/lessons/{lesson}/mark-as-incomplete', 'CourseController@markAsInComplete')->name('lessons.incompletion');
        
        // bookmark courses
        Route::post('/courses/{course}/create-bookmark', 'CourseController@bookmark');
        Route::get('/courses/{course}/get-wishlist-status', 'CourseController@getBookmarkStatus');
        Route::delete('/courses/{course}/delete-bookmark', 'CourseController@unbookmark');
        
        // announcements
        Route::get('/courses/{course}/learn/announcements', 'AnnouncementController@index')->name('announcements.index');
        Route::get('/announcements/api/{id}/get-comments', 'AnnouncementController@getComments');
        Route::post('/announcements/api/{id}/store-comment', 'AnnouncementController@storeComment');
        Route::put('/announcements/api/comment/{id}/update-comment', 'AnnouncementController@updateComment');
        Route::get('/announcements/api/comment/{id}/get-edit-comment', 'AnnouncementController@getComment');
        Route::delete('/announcements/api/comment/{id}/delete-comment', 'AnnouncementController@deleteComment');
        
        // questions
        Route::get('/courses/{course}/learn/questions', 'QuestionController@index')->name('questions.index');
        Route::get('/courses/{course}/learn/question/{question}', 'QuestionController@show')->name('questions.show');
        Route::get('/questions/api/{id}/get-questions', 'QuestionController@getQuestions');
        Route::get('/questions/api/{id}/get-edit-question', 'QuestionController@getQuestion');
        Route::post('/questions/api/{id}/store-question', 'QuestionController@storeQuestion');
        Route::put('/questions/api/{id}/update-question', 'QuestionController@updateQuestion');
        Route::delete('/questions/api/{id}/delete-question', 'QuestionController@deleteQuestion');
        
        // follow questions
        Route::post('/questions/{question}/follow-question', 'QuestionController@follow');
        Route::get('/questions/{question}/get-follow-status', 'QuestionController@getFollowStatus');
        Route::delete('/questions/{question}/unfollow-question', 'QuestionController@unfollow');
        
        // answers
        Route::get('/questions/api/{id}/get-answers', 'QuestionController@getAnswers');
        Route::get('/questions/api/answer/{id}/get-edit-answer', 'QuestionController@getAnswer');
        Route::post('/questions/api/{id}/store-answer', 'QuestionController@storeAnswer');
        Route::put('/questions/api/answer/{id}/update-answer', 'QuestionController@updateAnswer');
        Route::delete('/questions/api/answer/{id}/delete-answer', 'QuestionController@deleteAnswer');
        Route::put('/answers/api/{answer}/mark-as-answer', 'QuestionController@markAsAnswer');
        
        // helpful answers
        Route::post('/answers/{answer}/mark-as-helpful', 'QuestionController@markAsHelpful');
        Route::get('/answers/{answer}/get-mark-status', 'QuestionController@getMarkStatus');
        Route::delete('/answers/{answer}/unmark-as-helpful', 'QuestionController@unmarkAsHelpful');
        
        // messaging
        Route::get('/messages', 'MessageController@index')->name('messages');
        Route::get('/threads/api/fetch', 'MessageController@fetchThreads');
        Route::get('/messages/api/{thread}/fetch', 'MessageController@fetchThreadMessages');
        Route::put('/threads/api/thread/{thread}', 'MessageController@markThreadAsRead');
        Route::put('/messages/api/{id}', 'MessageController@update')->name('messages.update');
        Route::post('/', 'MessageController@store')->name('messages.store');
        
        Route::get('/{user}/getMessages/{thread}', 'MessageController@getThreadMessages');

        // reviews
        Route::post('/courses/api/{course}/review', 'ReviewController@store');
        
    });
    
    // user enrolls to course
    Route::get('/courses/{course}/enroll', 'CourseController@enroll')->name('course.enroll');
    
    
    /*
        Author routes
    */
    Route::group(['namespace' => 'Author', 'as' => 'author.', 'middleware' => 'author'], function () {
        
        // courses
        Route::get('/author/courses', 'CourseController@index')->name('course.index');
        Route::get('/author/course/create', 'CourseController@create')->name('course.create');
        Route::get('/author/course/{course}/curriculum', 'CourseController@curriculum')->name('course.curriculum');
        Route::get('/author/course/{course}/manage', 'CourseController@edit')->name('course.edit');
        Route::post('/author/course', 'CourseController@store')->name('course.store');
        Route::put('/author/course/{id}/publish/update', 'CourseController@submitForReview')->name('submit.review');
        Route::delete('/author/course/{course}/destroy', 'CourseController@destroy')->name('course.destroy');
        // review-notes
        Route::get('/author/courses/{course}/manage/approval', 'CourseController@adminReview')->name('course.approval');
        
        Route::post('/author/lesson/{lesson}/attachment/upload', 'LessonController@uploadAttachment')->name('attachment');
        Route::delete('/author/lesson/{lesson}/attachment/{attachment}/destroy', 'LessonController@deleteAttachment')->name('attachment.destroy');

        // coupons
        Route::get('/author/courses/{course}/manage/price-and-coupons', 'CouponController@index')->name('coupons.index');
        
        
        
        // announcements
        Route::get('/author/courses/{course}/manage/announcements', 'AnnouncementController@index')->name('announcements.index');
        Route::get('/author/courses/{course}/manage/announcements/create', 'AnnouncementController@create')->name('announcements.create');
        Route::post('/author/courses/{course}/manage/announcements', 'AnnouncementController@store')->name('announcements.store');
        
        // earnings
        Route::get('/author/earnings', 'RevenueController@index')->name('revenue.index');
        Route::get('/author/allearnings/{user}/fetch', 'RevenueController@fetchAllEarning')->name('revenue.fetch');
        Route::get('/author/withdrawals', 'RevenueController@requestWithdrawal')->name('withdrawals');
            
            
    });
    
});
