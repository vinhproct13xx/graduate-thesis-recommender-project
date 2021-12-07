<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('create-xml','CreateXmlController@create');
Route::post('hehe','CreateXmlController@hehe');
Route::group(['middleware'=>'locale'],function () {
    Route::group(['namespace' => 'Api'], function () {
        Route::post('/upload-image', 'UtityController@uploadImage')->name('api.utity.upload_image');
        Route::post('/remove-image', 'UtityController@removeImage')->name('api.utity.remove_image');
        Route::group(['namespace' => 'Account', 'prefix' => 'account'], function () {
            Route::post('/', 'AccountController@register')->name('api.account.regester');
            Route::get('/logout', 'AccountController@logout')->middleware('auth.jwt')->name('api.account.logout');
            Route::post('/login', 'AccountController@login')->name('api.account.login');
            Route::post('/register', 'AccountController@register')->name('api.account.register');
            Route::post('/send-mail', 'AccountController@sendResetPasswordMail')->name('api.account.send_mail');
            Route::put('/reset-password', 'AccountController@resetPassword')->name('api.account.reset_password');
            Route::post('/update-profile', 'AccountController@updateProfile')->name('api.account.update_profile')->middleware('auth.jwt');
        });
        Route::group(['namespace' => 'Restaurant', 'prefix' => 'res'], function () {
            Route::post('/get-nearest', 'RestaurantController@getNearestRes')->name('api.res.nearest');
            Route::post('/get-suggest', 'RestaurantController@getSuggestedRes')->name('api.res.suggest');
            Route::post('/get-saved-res', 'RestaurantController@getSavedRes')->name('api.res.saved');
            Route::post('/save', 'RestaurantController@save')->name('api.res.save')->middleware('auth.jwt');
            Route::post('/un-save', 'RestaurantController@unSave')->name('api.res.un_save')->middleware('auth.jwt');
            Route::post('/get-more', 'RestaurantController@getMoreRes')->name('api.res.get_more');
            Route::post('/get-open-res', 'RestaurantController@getOpenRes')->name('api.res.get_open_res');
            Route::post('/create', 'RestaurantController@create')->name('api.res.create')->middleware('auth.jwt');
            Route::post('/get-list', 'RestaurantController@getlist')->name('api.res.get-list');
        });
        Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
            Route::post('/', 'CommentController@getList')->name('api.comment.get-list');
            Route::post('/get-comment-image', 'CommentController@getCommentImage')->name('api.comment.get_comment_image')->middleware('auth.jwt');
            Route::post('/create', 'CommentController@create')->name('api.comment.create');
            Route::post('/like', 'CommentController@like')->name('api.comment.like')->middleware('auth.jwt');
            Route::post('/run-al', 'CommentController@runAl')->name('api.comment.runal');
        });
        Route::group(['namespace' => 'Report', 'prefix' => 'report'], function () {
            Route::post('/create', 'ReportController@create')->name('api.report.create')->middleware('auth.jwt');
        });
    });
});

