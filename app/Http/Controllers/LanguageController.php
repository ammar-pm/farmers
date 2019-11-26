<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Auth;
use Session;
use App\Http\Controllers\API\DatasetController;
use Illuminate\Support\Facades\URL;

class LanguageController extends Controller
{
    public function index($language,$soruce,$ds_id)
    {



        if(Auth::check()) {
            Auth::user()->fill(['language' => $language])->save();
            App::setLocale($language);
            Session::put('locale', $language);
        } else {
            App::setLocale($language);
            Session::put('locale', $language);
        }

        $url_arr = explode('/', URL::previous());
        if( sizeof($url_arr) <= 4 && $soruce == 0 && $ds_id == 0) {
            return redirect()->back();
        }

        if ($ds_id != 0 || $soruce != 0) {
            //Dd('haha');
            return redirect()->route('library_topic',['id'=>$soruce,'ds_id'=>$ds_id]);
        }
        if ($ds_id == 0 || $soruce == 0) {
            //Dd('haha');
            return redirect()->route('library_topic',['id'=>$soruce,'ds_id'=>$ds_id]);
        }
        return redirect()->back();
    }


}