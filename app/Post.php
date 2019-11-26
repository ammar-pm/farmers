<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\Creater;
use App\Scopes\PublicScope;

class Post extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublicScope);
    }

    use SoftDeletes;
    use Searchable;
    use Creater;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;


    protected $fillable = [
        'title',
        'subline',
        'summary',
        'description',
        'language',
        'image',
        'type',
        'public',
        'featured',
        'comments',
        'related_id'
    ];

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

    public function getDateAttribute()
    {
        $date = Carbon::parse($this->created_at);

        return $date->format('M d Y');
    }

    public function datasets()
    {
        return $this->belongsToMany('App\Dataset', 'dataset_post');
    }

    public function files()
    {
        return $this->belongsToMany('App\File', 'file_post');
    }

    public function user() {
        return $this->belongsTo('App\User', 'created_by');
    }
}