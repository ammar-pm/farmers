<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\Creater;


class Governorate extends Model
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
        'language',
        'geojson',
        'latitude',
        'longitude',
        'geo_code'
    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

    public function getGeoDataAttribute()
    {
        $url = env('APP_URL')."/storage/geojsons/$this->geojson";
        return json_decode(file_get_contents($url), true);
    }

    public function datasets()
    {
        return $this->belongsToMany('App\Dataset');
    }

}