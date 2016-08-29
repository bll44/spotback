<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use \Curl\Curl;

class User extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function playlists()
    {
    	$url = env('SPOTIFY_API_BASE_URL') . 'users/' . $this->username . '/playlists';
    	$curl = new Curl();
    	$curl->setHeader('Authorization', 'Bearer BQBtvtn9kjFkmLwAxRmYx3pN_xALyupA-x1K4aFt3D7rJst8kRfaPvGwh6NnP-kNhCF-V0A0Vem_v3KyNgcFXQ');
    	$curl->get($url);
    	return $curl->response;
    }
}
