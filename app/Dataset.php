<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
// use App\Traits\Creater;
use Auth;
use Lang;
use App\User;
use App\Favorite;
use App\Scopes\PublicScope;
use App\Http\Controllers\API\JSonFileController;
use Illuminate\Support\Facades\URL;

class Dataset extends Model
{

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new PublicScope);
    // }

    use SoftDeletes;
    use Searchable;
    // use Creater;

    protected $dates = ['deleted_at'];
    public static $autoIndex = true;

    protected $fillable = [
        'title',
        'description',
        'preview',
        'public',
        'featured',
        'language',
        'library',
        'options',
        'topicid',
        'tags',
        'created_by',
        'related_id'
    ];


    public function scopeWithUserName($query)
    {
        $query->addSubSelect('user_name', User::select('name')
            ->whereColumn('id', 'datasets.created_at')
            ->latest()
        );
    }

    public function scopeLanguage($query)
    {
        return $query->where('language', App::getLocale());
    }

    public function getTagsAttribute($value)
    {
        return $value != NULL ? json_decode($value) : [];
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function setTopicidAttribute($value)
    {
        $this->attributes['topicid'] = json_encode($value);
    }

    public function getTopicidAttribute($value)
    {
        return $value != NULL ? json_decode($value) : [];
    }

    public function files()
    {
        return $this->belongsToMany('App\File', 'dataset_file');
    }

    public function periods()
    {
        return $this->belongsToMany('App\Period', 'dataset_period');
    }

    public function topics()
    {
        return $this->belongsToMany('App\Post', 'dataset_post');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Governorate', 'dataset_governorate');
    }

    public function indicators()
    {
        return $this->belongsToMany('App\Indicator');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites');
    }


    public function toSearchableArray()
    {
        $JsonController = new JSonFileController();
        // calc periods from database
        $periods_res = [];
        if(isset(unserialize($this->options)['years_field']) && !empty(unserialize($this->options)['years_field']) ){
            $periods_res = unserialize($this->options)['years_field'];
        }elseif (empty($JsonController->get_dataset_file_id($this->id))){
            $periods_res = [];
        }else{
            if (count($JsonController->get_json_years_data($JsonController->get_dataset_file_id($this->id))['options']) <=3){
                $periods_res = $JsonController->get_json_years_data($JsonController->get_dataset_file_id($this->id))['options'];
            }else{
                $periods_res = [min($JsonController->get_json_years_data($JsonController->get_dataset_file_id($this->id))['options']) . ' - ' . max($JsonController->get_json_years_data($JsonController->get_dataset_file_id($this->id))['options'])];
            }
        }
        $this->periods = $periods_res;
        $this->topics;
        $this->governorates;
        $this->indicators;
        $this->public = $this->public ? 'Public' : null;
        $this->featured = $this->featured ? 'Featured' : null;
        $this->options = unserialize($this->options);
        $this->ip = \Request::ip();
        $this->url = URL::current();
        $this->url_base = str_replace("https://","",str_replace("http://","",URL::to('/')));
        $this->user;

        return $this->toArray();
    }

}
