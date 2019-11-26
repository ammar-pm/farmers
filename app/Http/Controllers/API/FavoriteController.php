<?php

namespace App\Http\Controllers\API;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dataset as DatasetResource;
use Lang;
use Auth;
use App\Dataset;

class FavoriteController extends Controller
{

    public function index()
    {
        $data = [];
        $data['records'] = Auth::user()->favorites()->get();
        $data['title'] = Lang::get('common.favorites');
        return view('favorites.index', $data);
    }


    public function favorite_api($id,$userid)
    {
        $record = Dataset::find($id);
        $data = [];

        //Dd($record->favorites()->get()->count());
        if ($record->favorites()->get()->count()> 0) {
            $record->favorites()->detach();
            //Session::flash('flash_message', Lang::get('common.removedfromfavorites'));
            $data['response'] = [
                'msg_code' => false,
                'msg_text' => Lang::get('common.removedfromfavorites')
            ];
            return $data;
        } else {
            $record->favorites()->attach([$userid]);
            //Session::flash('flash_message', Lang::get('common.addedtofavorites'));
            $data['response'] = [
                'msg_code' => true,
                'msg_text' => Lang::get('common.addedtofavorites')
            ];
            return $data;
        }
    }

}
