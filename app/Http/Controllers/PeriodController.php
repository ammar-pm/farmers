<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\Period;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['records'] = Period::all();

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

        $record = Period::create($input);

        Session::flash('flash_message', Lang::get('common.saved'));
        
        return back();
    }

    public function edit($id)
    {
        $data = [];
        $data['record'] = Period::find($id);
        $data['records'] = Period::all();

        return view('layouts.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $record = Period::find($id);

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
        Period::find($id)->delete();
        Session::flash('flash_message', Lang::get('common.deleted'));
        return redirect('periods');
    }


}