<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'locale'],function (){
    Route::group(['namespace'=>'Web'],function (){
        Route::get('change-language/{language}', 'WebController@changeLanguage')->name('user.change-language');
        Route::get('/login', function () {
            return view('Web.Account.login');
        });
        Route::get('/register', function () {
            return view('Web.Account.register');
        });
        Route::get('/forget', function () {
            return view('Web.Account.forget');
        });

        Route::get('/', 'WebController@index')->name('user.index');

        Route::get('res-detail/{id}', 'WebController@getDetail');

        Route::get('more-res/{type}', 'WebController@moreRes');

        Route::get('search/{value}', 'WebController@search');

        Route::get('/profile', 'WebController@profile');

        Route::get('/new-res', 'WebController@newRes');

    });
    Route::get('/create-xml', 'CreateXmlController@create');
    Route::get('/test', function (){
        return view('Web.Pages.test');
    });
});

Route::get('auth/google', 'Api\Account\AccountController@redirectToGoogle');
Route::get('auth/google/callback', 'Api\Account\AccountController@handleGoogleCallback');
