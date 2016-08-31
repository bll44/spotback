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
		$user = User::findByUsername($username);
		if($active)
		{
			session(['ActiveUser' => $user]);
			// return session()->get('ActiveUser')->username;
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
		$user = User::where('username', session()->get('ActiveUser')->username)->first();
		
		// perform the authentication
		try 
		{
			if($user->authenticate())
			{
				return redirect('playlists');
			}
		} 
		catch (Exception $e) 
		{
			session()->flush();
			session()->regenerate();
			return 'Exception: ' . $e->getMessage() . "\n";
		}
	}

	public function test()
	{
		$user = new User;
		return $user->findByUsername('smerfmurph');

	}
}
