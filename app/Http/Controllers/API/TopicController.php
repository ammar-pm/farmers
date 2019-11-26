<?php

namespace App\Http\Controllers\API;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class TopicController extends Controller
{
    public function index()
    {
        $data = [];
        $data['records'] = Post::where('type', 'topics')->orderBy('title')->get();
        return $data;
    }



    public function topicsbylang($lang)
    {
        $data = [];
        $data['records'] = Post::where('type', 'topics')->where('language', $lang)->orderBy('title')->get();
        return $data;
    }



}
