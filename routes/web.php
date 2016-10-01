<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//Use App\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('broadcast', function(){

	$user = Request::input('name');
	event(new App\Events\UserRegisteredEvent($user)); 
	return 'Event has been fired!'; 
});

Route::get('listen', function(){
	   return view('events');
});

//mailable
Route::get('send/{event}', 'MailController@sendmail');

//Notification
Route::get('notify', 'NotificationController@sendNotification');
Route::get('notifications', 'NotificationController@show');
Route::delete('notifications', 'NotificationController@markasRead');


// Socialite for github
Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');


	