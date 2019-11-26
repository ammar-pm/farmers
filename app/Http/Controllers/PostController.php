<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\Post;
use App;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['records'] = Post::all();

        return view('posts.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

        //Dd($input);
        $data = [];
        if($request->hasFile('image')) {
        
            $this->uploadFile($request, $input);

            $input['image'] = $this->file;

        }

        $record = Post::create($input);
    
        Session::flash('flash_message', Lang::get('common.saved'));
        $data['saved_id'] = $record->id;
        return $data;
    }


    public function edit($id)
    {
        if ($id == 0){
            $data = [];
            //$data['record'] = [];
            //$data['records'] = Post::orderBy('title')->get();
            $data['lang_records'] = Post::where('public','=',1)->orderby('type','asc')->orderby('language','asc')->get();
            return $data;
        }
        $data = [];
        $data['record'] = Post::find($id);
        $data['records'] = Post::orderBy('title')->get();
        
        $data['lang_records'] = Post::where('type','=',$data['record']->type)->where('language','!=',$data['record']->language)->get();
        return view('posts.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();

        $record = Post::find($id);

        if($request->hasFile('image')) {
        
            $this->uploadFile($request, $input);

            $input['image'] = $this->file;

        }

        $record->update($input);

        if($request->related_id) {
            $record2 = Post::find($input['related_id']);
            $input2['related_id'] = $id;
            $input2['image'] = $input['image'];
            $record2->update($input2);
        }

        Session::flash('flash_message', Lang::get('common.updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        Session::flash('flash_message', Lang::get('common.deleted'));
        return redirect('posts');
    }

    private function uploadFile($request, $input)
    {
        $file = $request->file('image')->getClientOriginalName();

        $request->file('image')->storeAs('storage/images', $file, 'public');

        $request->file('image')->move(public_path('storage/images'), $file);

        $this->file = $file;

        return $file;
    }

    public function create()
    {
        $data = [];
        $data['lang_records'] = Post::where('public','=',1)->orderby('type','asc')->orderby('language','asc')->get();
        $data['records'] = Post::all();

        return view('posts.add', $data);
    }

}
