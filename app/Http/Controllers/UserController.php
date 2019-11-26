<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\User;
use App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ResetsPasswords;

    public function index()
    {
        $data = [];
        $data['records'] = User::all();

        return view('users.index', $data);
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

        ////////// validateor
        $niceNames = array(
            'email' => (App::getLocale()=='ar')? 'الايميل' : 'email'
        );
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ]);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            // Session::flash('flash_error', $validator->messages()->first());
            return['flash_error'=> $validator->messages()->first()];
        }
        ////////// end validation

        $record = User::create($input);

        Session::flash('flash_message', Lang::get('common.saved'));
        
        return['flash_message'=> Lang::get('common.updated'), 'created_id'=> $record->id];
    }

    public function edit($id)
    {
        $data = [];
        $data['user'] = User::withTrashed()->find($id);
        $data['records'] = User::all();

        return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        

        $record = User::find($id);
        if(array_key_exists ( 'password' , $input )  && !is_null($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        $record->update($input);

        Session::flash('flash_message', Lang::get('common.updated'));
        return['flash_message'=> Lang::get('common.updated')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('flash_message', Lang::get('common.deleted'));
        return [];
    }

    public function get_trashed_users() {
        $data = [];
        $data['records'] = User::onlyTrashed()->get();
        return $data;
    }


    public function restore_deleted_user($id) {
        $data = [];
        $data['records'] = User::onlyTrashed()->find($id)->restore();
        return $data;
    }


}
