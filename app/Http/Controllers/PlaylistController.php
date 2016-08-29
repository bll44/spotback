<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class PlaylistController extends Controller
{
	public $baseUrl = env('SPOTIFY_API_BASE_URL');

    public function getPlaylists($user)
    {
    	$curl = curl_init();
    	// set the url
    	// curl_setopt($curl, 'CURLOPT_URL', $this->baseUrl . 'users/')
    }

    public function crontab()
    {

    }
}
