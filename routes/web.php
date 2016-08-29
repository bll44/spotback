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

Route::get('/', function () {
	if( ! session()->has('ActiveUser') )
	{
		return redirect('active_user');
	}
	elseif( strlen(session('ActiveUser')) <= 0 )
	{
		session()->flush();
		session()->regenerate();
		return redirect('active_user');
	}
	else
	{
		// if there is an ActiveUser, retrieve the user's playlists
		$UserController = new \App\Http\Controllers\UserController;
		return $UserController->getPlaylists();
	}
});

Route::get('active_user', 'UserController@switchActiveUser');
Route::get('change_user_state', 'UserController@changeUserState');

Route::get('crontab', 'PlaylistController@crontab');