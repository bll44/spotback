<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Playlist;

class PlaylistController extends Controller
{

    public function getPlaylists()
    {
        $user = new User;
        $user->username = session('ActiveUser');
        $playlists = $user->playlists()->items;
        // return $playlists;
        
        return view('playlist/list', compact('playlists'));
    }

    public function view($playlistId)
    {
        $playlist = new Playlist;
        $playlist->playlist_id = $playlistId;
        $playlist->getTracks();

    }
}
