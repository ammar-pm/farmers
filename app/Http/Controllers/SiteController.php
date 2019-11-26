<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App;
use App\Post;
use App\Dataset;
use App\Menu;
use App\Widget;
use App\Favorite;
use App\Indicator;
use Lang;
use Illuminate\Support\Facades\URL;

class SiteController extends Controller
{

    public function index()
    {
        $data = [];
        $data['stories'] = Post::language()->where('type', 'stories')->where('featured', 1)->latest()->limit(3)->get();
        $data['news'] = Post::language()->where('type', 'news')->where('featured', 1)->latest()->limit(4)->get();
        $data['topics'] = Post::language()->where('type', 'topics')->get();
        $data['indicators'] = Indicator::language()->orderBy('sort')->get();
        $data['datasets'] = Dataset::language()->where('featured', 1)->limit(4)->get();

        return view('home.index', $data);
    }

    /*public function library($ds_id = null)
    {
        $data = [];
        $drelated_ds = isset($ds_id) ? Dataset::find($ds_id)->related_id : null;
        $data['ds_id'] = $drelated_ds;
        $data['title'] = Lang::get('common.library');
        return view('library.index', $data);
    }*/

    public function library_topic($id)
    {
        $data = [];
        $data['record'] = Post::with('datasets')->language()->findOrFail($id);
        $data['title'] = $data['record']->title;
        return view('library.index', $data);
    }

    public function stories()
    {
        $data = [];
        $data['records'] = Post::language()->where('type', 'stories')->latest()->paginate(10);
        $data['title'] = Lang::get('common.stories');
        return view('stories.index', $data);
    }

    public function story($id)
    {
        $data = [];
        $data['record'] = Post::language()->findOrFail($id);
        $data['title'] = $data['record']->title;
        $data['relateds'] = Post::language()->limit(3)->get();
        return view('stories.details', $data);
    }

    public function news()
    {
        $data = [];
        $data['records'] = Post::language()->where('type', 'news')->latest()->get();
        $data['title'] = Lang::get('common.news');

        return view('news.index', $data);
    }

    public function article($id)
    {
        $data = [];
        $data['record'] = Post::language()->findOrFail($id);
        $data['title'] = $data['record']->title;
        $data['relateds'] = Post::language()->limit(3)->get();
        return view('news.details', $data);
    }


    public function pages($id)
    {
        $data = [];
        $data['record'] = Post::language()->findOrFail($id);
        $data['title'] = $data['record']->title;
        return view('pages.details', $data);
    }

    public function topics()
    {
        $data = [];
        $data['records'] = Post::language()->where('type', 'topics')->get();
        $data['title'] = Lang::get('common.topics');
        return view('topics.index', $data);
    }

    public function topic($id = null , $ds_id = null )
    {
          //index library
          if ( !isset($id) && !isset($ds_id)){
              $data = [];
              $data['ds_id'] = '';
              $data['title'] = Lang::get('common.library');
              return view('library.index', $data);
          }


        //index library
        if ( $id == 0 && $ds_id == 0){
            $data = [];
            $data['ds_id'] = '';
            $data['title'] = Lang::get('common.library');
            return view('library.index', $data);
        }

        // view chosen dataset/miror from the library
        if ( $id == 0 && $ds_id != 0){
            $data = [];
            $data['ds_id'] = '';
            // check for requested topic
            $res = Dataset::language()->find($ds_id);
            if(!empty($res)){
                $data['title'] = Lang::get('common.library');
                $data['ds_id'] = $ds_id;
                return view('library.index', $data);
            }
            // check for mirror topic
            $res = Dataset::find($ds_id);
            $data['title'] = Lang::get('common.library');
            $data['ds_id'] = $res->related_id;
            return redirect()->route('library_topic',['id'=>0,'ds_id'=>$res->related_id]);
        }

          ///////////////////////////////////////////////////////////
          //index topics
         if ( isset($id) && !isset($ds_id)){
            $data = [];
            $data['ds_id'] = '';
            $data['record'] = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->language()->find($id);
            if (isset($data['record']->title)){
                $data['title'] = $data['record']->title;
                return view('topics.details', $data);
            }else{
                return redirect()->route('library_topic');
            }
         }
        // view chosen topic or miror topic
        if ( $id != 0 && $ds_id == 0){
            $data = [];
            $data['ds_id'] = '';
            // check for requested topic
            $data['record'] = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->language()->find($id);
            if(!empty($data['record'])){
                $data['title'] = $data['record']->title;
                return view('topics.details', $data);
            }
            // check for mirror topic
            $drelated_id = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->find($id)->related_id;

            $data['record'] = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->language()->find($drelated_id);

            if(!empty($data['record'])){
                $data['title'] = $data['record']->title;
                return redirect()->route('library_topic',['id'=>$drelated_id,'ds_id'=>0]);
            }

            $data['title'] = Lang::get('common.library');
            $data['ds_id'] = $ds_id;
            return redirect()->route('library_topic',['id'=>0,'ds_id'=>0]);



        }

        // view chosen dataset/topic or miror dataset/topic
        if ( $id != 0 && $ds_id != 0){
            $data = [];
            $data['ds_id'] = '';
            // check for requested dataset/topic
            $data['record'] = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->language()->find($id);
            $ds = Dataset::language()->find($ds_id);
            if(!empty($data['record']) && !empty($ds)){
                $data['title'] = $data['record']->title;
                $data['ds_id'] = $ds->id;
                return view('topics.details', $data);
            }

            // check for mirror dataset/topic
            $drelated_id = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->find($id)->related_id;
            $drelated_ds = Dataset::find($ds_id)->related_id;

            $data['record'] = Post::with(['datasets' => function($q)  {
                // Query the name field in status table
                $q->where('public', '=', '1'); // '=' is optional
            }])->language()->find($drelated_id);

            if(!empty($data['record'])){
                $data['title'] = $data['record']->title;
                return redirect()->route('library_topic',['id'=>$drelated_id,'ds_id'=>$drelated_ds]);
            }

            return redirect()->route('library_topic',['id'=>0,'ds_id'=>0]);

        }

    }

    public function about() {
        return view('home.about');
    }

    public function faq() {
        return view('home.faq');
    }

    public function contact_us() {
        return view('home.contact_us');
    }
}