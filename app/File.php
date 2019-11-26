<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Creater;

class File extends Model
{
    use Creater;

    protected $visible = ['id', 'title', 'url', 'dformat','type','created_at','user_name','file_data','file_data_text','topics'];

    protected $fillable = [
        'title',
        'type',
        'url',
        'dformat',
        'file_data',
        'file_data_text',
        'language',
        'created_at'
    ];


    public function datasets()
    {
        return $this->morphedByMany('App\Dataset', 'attachable');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function topics()
    {
        return $this->belongsToMany('App\Post', 'file_post');
    }

    public function toSearchableArray()
    {
        $this->topics;

        return $this->toArray();
    }

}