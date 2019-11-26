<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\Governorate;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['records'] = Governorate::all();

        return view('governorates.index', $data);
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


        if($request->hasFile('geojson')) {
        
            $this->uploadFile($request, $input);

            $input['geojson'] = $this->file;

        }

        $record = Governorate::create($input);

        Session::flash('flash_message', Lang::get('common.saved'));
        
        $data['id'] = $record->id;
        return $data;
    }

    public function show($id)
    {
        $data = [];
        $data['record'] = Governorate::language()->findOrFail($id);
        $data['title'] = $data['record']->title;
        
        return view('governorates.show', $data);

    }

    public function create()
    {
        $data = [];
        $data['records'] = Governorate::all();
        return view('governorates.add', $data);
    }

    public function edit($id)
    {
        $data = [];
        $data['record'] = Governorate::find($id);
        $data['records'] = Governorate::all();

        return view('governorates.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $record = Governorate::find($id);

        if($request->hasFile('geojson')) {
        
            $this->uploadFile($request, $input);

            $input['geojson'] = $this->file;

        }

        $record->update($input);

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
        Governorate::find($id)->delete();
        Session::flash('flash_message', Lang::get('common.deleted'));
        return redirect('governorates');
    }

    private function uploadFile($request, $input)
    {
        $file = $request->file('geojson')->getClientOriginalName();

        $request->file('geojson')->storeAs('geojsons', $file, 'public');

        $this->file = $file;

        return $file;
    }


}