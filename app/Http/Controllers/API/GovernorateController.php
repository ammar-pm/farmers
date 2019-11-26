<?php

namespace App\Http\Controllers\API;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governorate;

class GovernorateController extends Controller
{
    public function index()
    {
        $data = [];
        $data['records'] = Governorate::all();
        return $data;
    }

    public function show($id)
    {
    	$data = [];
    	$data['record'] = Governorate::find($id);
    	// $data['geojson'] = $data['record']->geodata;
    	return $data;
    }


    public function def_governorates($lang)
    {
        $data = [];
        $data['records'] = Governorate::where('language', $lang)
            ->Where(function($query){
                $query->orWhere('title', 'like', '%' . 'All Governorates' . '%')
                    ->orWhere('title', 'like', '%' . 'كافة المحافظات' . '%');
            })
            ->orderBy('title')
            ->get();
        return $data;
    }

}