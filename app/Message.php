<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Creater;

class Message extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'name',
        'org_name',
        'data_use',
        'type_of_org',
        'address',
        'tel',
        'fax',
        'email',
        'field_of_use_data',
        'response_type',
        'comments',
        'signature',
        'signature_date',
        'signature_time',
        'ip',
        'location_api_result',
        'reply_message',
        'user_reply_message'
    ];

    public function getLocationApiResultAttribute($value)
    {
        return $value != NULL ? json_decode($value) : [];
    }
}
