<?php

namespace App\Http\Controllers\API;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicator;

class IndicatorController extends Controller
{
    public function index()
    {
        $data = [];
        $data['records'] = Indicator::all();
        return $data;
    }

}