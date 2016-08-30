<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Curl\Curl;

class Playlist extends Model
{
    protected $table = 'playlists';

    public function getTracks()
    {
    	$url = str_replace(['{user_id}', '{playlist_id}'],
                           [session()->get('ActiveUser'), $this->playlist_id],
                           'https://api.spotify.com/v1/users/{user_id}/playlists/{playlist_id}/tracks');
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer ' . <REPLACE_WITH_USER->AUTH_TOKEN>)
    	
    	
    	return 0;
    }
}
