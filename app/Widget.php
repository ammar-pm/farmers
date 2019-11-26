<?php

namespace App;

use App;
use Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Widget extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'title',
        'description',
        'template',
        'sort',
        'language'

    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

}
