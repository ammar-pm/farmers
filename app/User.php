<?php

namespace App;

use Laravel\Spark\User as SparkUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends SparkUser
{

    use SoftDeletes;
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'language',
        'password',
        'occupation',
        'phoneNumber',
        'linkedln',
        'facebook',
        'twitter',
        'google'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];


    public function favorites()
    {
        return $this->belongsToMany(Dataset::class, 'favorites', 'user_id', 'dataset_id')->withTimeStamps();
    }


}