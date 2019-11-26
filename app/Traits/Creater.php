<?php 

namespace App\Traits;

use Auth;
// use App\Scope\TeamScope;

trait Creater {

    protected static function boot() { 
        parent::boot(); 

        static::creating(function($model)  {
            $model->created_by = Auth::user()->id;
            // $model->team_id = Auth::user()->currentTeam->id;            
        });

		// static::deleting(function($model)  {
  //           $model->deleted_by = Auth::user()->id;
  //           $model->save();
  //       });

  //       static::addGlobalScope(new TeamScope);
    }

}