<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
    	'user_id', 
    	'provider_user_id', 
    	'provider',
    	'avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}