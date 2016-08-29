<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyRing extends Model
{
	protected $table = 'user_api_keys';
    protected $token;

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
