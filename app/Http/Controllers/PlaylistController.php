<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class PlaylistController extends Controller
{

    public function getPlaylists()
    {
        $user = new User;
        $user->username = session('ActiveUser');
        $playlists = $user->playlists()->items;
        
        return view('user/playlists', compact('playlists'));
    }
}
