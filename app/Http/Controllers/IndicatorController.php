<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\Indicator;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['records'] = Indicator::all();

        return view('layouts.index', $data);
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

        if($request->hasFile('icon')) {

        $file_name = $request->file('icon')->getClientOriginalName();

        $path = $request->file('icon')->storeAs('icons', $file_name, 'public');

        $input['icon'] = $file_name;

        }

        $record = Indicator::create($input);

        Session::flash('flash_message', Lang::get('common.saved'));
        
        return back();
    }

    public function edit($id)
    {
        $data = [];
        $data['record']  = Indicator::find($id);
        $data['records'] = Indicator::all();

        return view('layouts.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $record = Indicator::find($id);

        if($request->hasFile('icon')) {

        $file_name = $request->file('icon')->getClientOriginalName();

        $path = $request->file('icon')->storeAs('icons', $file_name, 'public');

        $input['icon'] = $file_name;

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
        Indicator::find($id)->delete();
        Session::flash('flash_message', Lang::get('common.updated'));
        return redirect('indicators');
    }


}