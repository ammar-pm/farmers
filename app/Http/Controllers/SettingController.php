<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Session;
use Lang;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setting;

class SettingController extends Controller
{
    public function index()
    {   
        return view('settings.index');
    }

    public function update(Request $request)
    {

        $settings = array();

        $input = $request->all();

        foreach($input['settings'] as $key => $item){
            $setting = Setting::firstOrNew(['key' => $key]);
            if ($setting->key == 'youtube'){
                $youts_ar = Setting::firstOrNew(['key' => 'home_featured_video_ar']);
                $youts_ar->value = $item;
                $youts_ar->save();
                $youts_en = Setting::firstOrNew(['key' => 'home_featured_video_en']);
                $youts_en->value = $item;
                $youts_en->save();
            }
            $setting->value = $item;
            $setting->save();
        }
        
        Session::flash('flash_message', Lang::get('common.settingsupdated'));

        return redirect()->back();
        
    }

}