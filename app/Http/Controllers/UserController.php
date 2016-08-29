<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use \Curl\Curl;

class UserController extends Controller
{
	public function switchActiveUser()
	{
		$users = User::all();
		return view('select_user', compact('users'));
	}

	public function changeUserState(Request $http)
	{
		$username = $http->user;
		$active = $http->active; // yes 
		// set ActiveUser in session
		if($active)
		{
			session(['ActiveUser' => $username]);
		}
		else
		{
			session()->flush();
			session()->regenerate();
		}
		return redirect('/');
	}

	public function tryAuthentication()
	{
		$user = User::where('username', session()->get('ActiveUser'))->first();
		if($user->authenticate())
		{
			return redirect('playlists');
		}
		else
		{
			session()->flush();
			session()->regenerate();
			return 'Authentication failed. Please contact the system administrator.';
		}
	}
}
