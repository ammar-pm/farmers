<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'title',
        'description',
        'sort',
        'icon',
        'language',
    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

    public function datasets()
    {
        return $this->belongsToMany('App\Dataset', 'dataset_topic');
    }

}
