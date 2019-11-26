<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;

class HelpController extends Controller
{
    public function index()
    {   
        $data = [];
        $data['title'] = 'Help';

        return view('help.index', $data);
    }

}