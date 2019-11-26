<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'title',
        'link',
        'type',
        'location',
        'sort',
        'language'
    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

}