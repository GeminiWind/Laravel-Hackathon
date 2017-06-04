<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('fire-event', function(){
	event(new App\Events\TestEvent());
});

Auth::routes();
Route::get('/home', 'HomeController@index');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
	Route::get('login','Auth\LoginController@showLoginForm');
	Route::post('login','Auth\LoginController@login')->name('admin.login');
	Route::get('register','Auth\RegisterController@showRegistrationForm');
	Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
	Route::get('/', function(){
			return view('admin.index');
	});
});
Route::group(['namespace' => 'Guest'], function () {
    Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
    Route::get('/callback/{provider}', 'SocialAuthController@callback');
});
