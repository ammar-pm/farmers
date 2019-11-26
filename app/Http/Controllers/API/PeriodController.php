<?php

namespace App\Http\Controllers\API;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Period;

class PeriodController extends Controller
{
    public function index()
    {
        $data = [];
        $data['records'] = Period::all();
        return $data;
    }

}