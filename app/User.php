<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use \Curl\Curl;
use DB;

class User extends Authenticatable
{
	use Notifiable;

    protected $table = 'users';
    protected $auth_token = 'BQBtvtn9kjFkmLwAxRmYx3pN_xALyupA-x1K4aFt3D7rJst8kRfaPvGwh6NnP-kNhCF-V0A0Vem_v3KyNgcFXQ';

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
    	$curl->setHeader('Authorization', 'Bearer ' . session()->get('AuthToken'));
    	$curl->get($url);
    	return $curl->response;
    }

    public function keyRing()
    {
        return $this->hasOne('App\KeyRing');
    }

    public function authenticate()
    {
        $url = 'https://accounts.spotify.com/api/token';
        $curl = new Curl();

        $curl->setHeader('Authorization', 'Basic ' . $this->keyRing->b64_auth_code);
        $curl->post($url, ['grant_type' => 'client_credentials']);
        $authToken = $curl->response->access_token;
        
        // build query for update user_api_keys table
        $query = "UPDATE user_api_keys SET ";
        $query .= "auth_token = :auth_token, ";
        $query .= "auth_token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) ";
        $query .= "WHERE user_id = :user_id";

        // insert values and execute query
        $affectedRows = DB::update($query, ['auth_token' => $authToken, 'user_id' => $this->id]);

        // set the auth token in the session
        session(['AuthToken' => $authToken]);

        // return value of number of rows affected by update query
        return $affectedRows > 0 ? true : false;
    }

    public static function findByUsername($username)
    {
        $user = User::where('username', $username)->first();
        return $user;
    }
}
