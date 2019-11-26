<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\Creater;


class Period extends Model
{

    use SoftDeletes;
    use Searchable;
    use Creater;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'title',
        'description',
        'sort',
        'language'
    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

}