<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

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
		$active = $http->active;
		// set active user in session
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

	public function getPlaylists()
	{
		$user = new User;
		$user->username = session('ActiveUser');
		$playlists = $user->playlists()->items;
		// return $playlists;

		return view('user/playlists', compact('playlists'));
	}
}
