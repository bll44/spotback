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
	elseif( strlen(session('ActiveUser')->username) <= 0 )
	{
		session()->flush();
		session()->regenerate();
		return redirect('active_user');
	}
	else
	{
		// if there is an ActiveUser, authenticate the active user
		$UserController = new \App\Http\Controllers\UserController;
		return $UserController->tryAuthentication();
	}
});

Route::get('test', 'UserController@test');

Route::get('playlist/view/{playlistId}', 'PlaylistController@view');

Route::get('playlists', 'PlaylistController@getPlaylists');

Route::get('active_user', 'UserController@switchActiveUser');
Route::get('change_user_state', 'UserController@changeUserState');