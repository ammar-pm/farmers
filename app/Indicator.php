<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Creater;

class Indicator extends Model
{

    use SoftDeletes;
    use Creater;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'title',
        'value',
        'icon',
        'prefix',
        'suffix',
        'separator',
        'decimals',
        'language',
        'sort',
    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

    public function datasets()
    {
        return $this->belongsToMany('App\Dataset', 'dataset_indicator');
    }

}
