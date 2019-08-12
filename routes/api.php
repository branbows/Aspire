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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::group([ 'prefix' => 'v1/'], function () {
    
    Route::post('login', 'Auth\LoginController@authenticate');
    Route::post('register', 'API\RegisterController@postRegisterApp');
    Route::get('dashboard-top-records', 'API\GeneralController@getTopExamAndLms');
    Route::get('exam-categories', 'API\GeneralController@examCategories');
    Route::get('lms-categories', 'API\GeneralController@lmsCategories');
    Route::get('lms/{slug?}', 'API\LmsController@lms');
    Route::get('lms/series/{slug}/{content_slug?}', 'API\LmsController@viewItem');
    Route::get('exams/student-exam-series/{slug}', 'API\ExamsController@viewSeriesItem');
    Route::get('exams/{slug?}', 'API\ExamsController@exams');
    Route::get('user/profile/{id}', 'API\UsersController@profile');
    Route::get('user/settings/{id}', 'API\UsersController@settings');
    Route::post('user/update-password', 'API\UsersController@updatePassword');
    Route::post('users/edit/{id}', 'API\UsersController@update');
    Route::post('users/reset-password', 'API\UsersController@resetUsersPassword');
    Route::post('users/social-login', 'API\UsersController@socialLoginUser');
    
    //upload user profile image
    Route::post('profile-image', 'API\UsersController@uploadUserProfileImage');




    Route::get('exam-series', 'API\ExamsController@examSeries');
    Route::get('lms-series', 'API\LmsController@lmsSeries');
    
    Route::get('user/subscriptions/{id}', 'API\UsersController@paymentsHistory');
    Route::get('user/bookmarks/{id}', 'API\UsersController@bookmarks');
    Route::post('bookmarks/delete/{bookmark_id}', 'API\UsersController@deleteBookmarkById');
    
    Route::post('feedback/send', 'API\UsersController@saveFeedBack');
    Route::post('update-payment', 'API\UsersController@updatePayment');
    


    Route::post('users/settings/{slug}', 'API\UsersController@updateSettings');
    Route::get('notifications', 'API\GeneralController@notifications');


    Route::get('get-exam-questions/{slug}', 'API\ExamsController@getQuestions');
    // Route::get('exam-series/{slug?}', function($slug){
    //     dd('asdf');
    // });

    // Route::get('dashboard-top-records', function(){
    // 	dd('yep');
    // });
    
    // Route::get('logout/{api_token}', 'UserController@logout');
    
    //static pages
    Route::get('pages/{slug?}', 'API\GeneralController@staticPages');
    Route::post('update/user-sttings/{user_id}', 'API\UsersController@updateUserPreferrenses');
    Route::get('instructions/{exam_slug}', 'API\UsersController@instructions');
    Route::get('analysis/subject/{user_id}', 'API\UsersController@subjectAnalysis');
    Route::get('analysis/exam/{user_id}', 'API\UsersController@examAnalysis');
    Route::get('analysis/history/{user_id}/{exam_id?}', 'API\UsersController@historyAnalysis');



    Route::post('bookmarks/save', 'API\UsersController@saveBookmarks');
    Route::post('validate/coupon', 'API\GeneralController@validateCoupon');
    Route::get('payment-gateway/details', 'API\GeneralController@gatewayDetails');
    Route::post('save-transaction', 'API\GeneralController@saveTransaction');
    
    Route::post('finish-exam/{slug}', 'API\ExamsController@finishExam');

    Route::get('get-exam-key/{slug}', 'API\ExamsController@getExamKey');
    Route::post('update-offline-payment', 'API\UsersController@updateOfflinePayment');
    Route::get('get-currency-code', 'API\GeneralController@getCurrencyCode');

    Route::get('get-payment-gateways', 'API\GeneralController@getPaymentGateways');

});
