<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\FileRequest;
use App\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\API\JSonFileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App;


class FileController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::enableQueryLog();
        $data = [];
        $query = File::with(['topics'])->orderBy('title');
        $subQueryUserNames = 'select name from users where id = files.created_by';
        //$query->selectSub($subQueryUserNames, 'user_name');
        $files = $query->addSubSelect('user_name', $subQueryUserNames);
        $data['records'] = $files->get();
        //Dd(DB::getQueryLog());
        return view('files.index', $data);
    }

    public function store(FileRequest $request)
    {

        //DB::enableQueryLog();
        ////////// validateor
        $niceNames = array(
            'title' => (App::getLocale()=='ar')? 'العنوان' : 'title'
        );
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:files',
            'dformat' => 'required|string|max:50'
        ]);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            Session::flash('flash_error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
        ////////// end validation
        $input = $request->all();
        if (!empty($request->topics)) {
            //Dd( [json_decode($request->topics,true)[0]]);
            if (!empty(json_decode($request->topics,true)[0])){
                $input['topics'] = [json_decode($request->topics,true)[0]];
            }else{
                $input['topics'] = array_column(json_decode($request->topics,true), 'id');
            }
            //$record->topics()->attach(array_column($request->topics, 'id'));
        }
        //Dd($input);
        $out_id = 0;
        if ($request->hasFile('url')) {

            $file_name = $input['url']->getClientOriginalName();

            /*change the file name in order to avoid rednancy*/
            $arr = explode(".", strtolower($file_name));
            $md5Name = $arr[0] . time();
            $guessExtension = $arr[1]; // get extension from the name
            if (strtolower($guessExtension) != 'csv') {
                Session::flash('flash_error', Lang::get('common.filetypeerror'));
                return back();
            }
            $file = $input['url']->storeAs('data', $md5Name.'.'.$guessExtension);
            $file_name = $file;
            /*end change the file name in order to avoid rednancy*/

            $input['url']->move(public_path('data'), $file_name);

            $input['type'] = $input['url']->getClientMimeType();

            $input['url'] = $file_name;

            ///////////// read file and store it in database /////////////////
            $results = Excel::load($input['url'], function ($reader) use (&$readerObj) {
                $readerObj = $reader;
            })->get();
            //////////////////////////////////// Dump all excel sheet into Array
            $idx_col = 0;
            $idx_row = 0;
            foreach ($readerObj->getActiveSheet()->getRowIterator() as $row) {
                foreach ($row->getCellIterator() as $cell) {
                    $value = $cell->getCalculatedValue();
                    $excelSheetData[$idx_row][$idx_col] = $value;
                    $idx_col = $idx_col + 1;
                }
                $idx_row = $idx_row + 1;
                $idx_col = 0;
            }
            /////////////////////////////////////////////////////////////////
            /////////////////////////////// fill the nulls the first line of the header //////////////
            $lvar_set = null;
            foreach ( $excelSheetData[0] as $key => $value ){
                if(isset($value)){
                    $lvar_set = $value;
                    $excelSheetData[0][$key] = $value;
                }
                else {
                    $excelSheetData[0][$key] = $lvar_set;
                }
            }
            //////////////////////////////////////////////////////////////////////////////
            if ($input['dformat'] == 2 ){
                $res = FileController::build_long_dic($excelSheetData)['data'];
                $last_uid = FileController::build_long_dic($excelSheetData)['last_uid'];
                $input['file_data_text'] = json_encode($res);
                $f = File::create($input);
                $out_id = $f->id;
                $f->topics()->detach();
                if (!empty($f->topics)) {
                    //if (!empty(json_decode($request->topics,true)[0])){
                    //    $f->topics()->attach([json_decode($request->topics,true)[0]]);
                    //}else{
                        $f->topics()->attach(array_column(json_decode($request->topics,true), 'id'));
                    //}
                    //$record->topics()->attach(array_column($request->topics, 'id'));
                }
                $f->update($input);
                $arr_data_chunks = array_chunk($res, 300);
                $JsonController = new JSonFileController();
                $create_view = $JsonController->create_view_columns(json_encode($res,JSON_UNESCAPED_UNICODE ),$f->id. '_vw');
                foreach ($arr_data_chunks as $key => $value ){
                    $create_view = $JsonController->insert_view_data(json_encode($value,JSON_UNESCAPED_UNICODE ),$f->id. '_vw');
                }

            }else{
                $input['file_data_text'] = json_encode($excelSheetData);
                $f = File::create($input);
                $out_id = $f->id;
                $f->topics()->detach();
                if (!empty($f->topics)) {
                    $f->topics()->attach(array_column(json_decode($request->topics,true), 'id'));
                    //$record->topics()->attach(array_column($request->topics, 'id'));
                }
                $f->update($input);
            }
        }
        //Dd(DB::getQueryLog());
        Session::flash('flash_message', Lang::get('common.saved'));
        if ($out_id !== 0) {
            return redirect('files/' . $out_id . '/edit');
        }else{
            return back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['record'] = File::with(['topics'])->find($id);
        return view('files.edit', $data);
    }


    public function update(Request $request, $id)
    {


        $input  = $request->all();
        $record = File::find($id);
        /*****/
         if ($input['title'] !== $record->title){
             ////////// validateor
             $niceNames = array(
                 'title' => (App::getLocale()=='ar')? 'العنوان' : 'title'
             );
             $validator = Validator::make($request->all(), [
                 'title' => 'sometimes|required|unique:files'
             ]);
             $validator->setAttributeNames($niceNames);
             if ($validator->fails()) {
                 Session::flash('flash_error', $validator->messages()->first());
                 return redirect()->back()->withInput();
             }
         }
        /****/
        if ($request->hasFile('url')) {

            $file_name = $input['url']->getClientOriginalName();

            /*change the file name in order to avoid rednancy*/
            //$md5Name = $input['url']->getRealPath() . time();
            $arr = explode(".", strtolower($file_name));
            $md5Name = $arr[0] . time();
            $guessExtension = $arr[1]; // get extension from the name
            if (strtolower($guessExtension) != 'csv') {
                Session::flash('flash_error', Lang::get('common.filetypeerror'));
                return back();
            }
            $file = $input['url']->storeAs('data', $md5Name.'.'.$guessExtension);
            $file_name = $file;
            /*end change the file name in order to avoid rednancy*/

            $input['url']->move(public_path('data'), $file_name);

            $input['type'] = $input['url']->getClientMimeType();

            $input['url'] = $file_name;

            ///////////// read file and store it in database /////////////////
            $results = Excel::load($input['url'], function ($reader) use (&$readerObj) {
                $readerObj = $reader;
            })->get();
            //////////////////////////////////// Dump all excel sheet into Array
            $idx_col = 0;
            $idx_row = 0;
            foreach ($readerObj->getActiveSheet()->getRowIterator() as $row) {
                foreach ($row->getCellIterator() as $cell) {
                    $value = $cell->getCalculatedValue();
                    $excelSheetData[$idx_row][$idx_col] = $value;
                    $idx_col = $idx_col + 1;
                }
                $idx_row = $idx_row + 1;
                $idx_col = 0;
            }
            //////////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////// fill the nulls the first line of the header //////////////
            $lvar_set = null;
            foreach ( $excelSheetData[0] as $key => $value ){
                if(isset($value)){
                    $lvar_set = $value;
                    $excelSheetData[0][$key] = $value;
                }
                else {
                    $excelSheetData[0][$key] = $lvar_set;
                }
            }
            //DB::enableQueryLog();
            if ($input['dformat'] == 2 ){
                $res = FileController::build_long_dic($excelSheetData)['data'];
                $JsonController = new JSonFileController();
                $JsonController->drop_view($id. '_vw');
                $arr_data_chunks = array_chunk($res, 300);
                $create_view = $JsonController->create_view_columns(json_encode($res,JSON_UNESCAPED_UNICODE),$id. '_vw');
                foreach ($arr_data_chunks as $key => $value ){
                    $create_view = $JsonController->insert_view_data(json_encode($value,JSON_UNESCAPED_UNICODE ),$id. '_vw');
                }
                $input['file_data_text'] = json_encode($res);
            }else{
                $input['file_data_text'] = json_encode($excelSheetData);
            }
            //Dd(DB::getQueryLog());

        }

        // Topics
        //Dd(count(json_decode($request->topics,true)));
        $record->topics()->detach();
        if (!empty($request->topics)) {
           // if (!empty(json_decode($request->topics,true)[0]['id'])){
             //   $record->topics()->attach([json_decode($request->topics,true)[0]['id']]);
            //}else{
                $record->topics()->attach(array_column(json_decode($request->topics,true), 'id'));
            //}
            //$record->topics()->attach(array_column($request->topics, 'id'));
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
    public function destroy($id,$page)
    {
        $file = File::find($id);
        @unlink(public_path($file->url));
        $file->delete();
        $JsonController = new JSonFileController();
        $create_view = $JsonController->drop_view($id. '_vw');
        Session::flash('flash_message', Lang::get('common.deleted'));
        return redirect('files')->with('page', $page);
    }

    public function build_long_dic($arr){
        $headers = $arr[0];

        $header = array_map(function ($value){
            return gettype($value);
        }, array_slice($arr,1)[0]);
        $header_dim = array_filter($header, function($x) { return $x!='string'; });
        $keys = array_flatten(array_keys($header_dim));

        $data = [];
        $uid = 0;
        foreach (array_slice($arr,1) as $key => $rowOfValues){
            $tmp_data = [];
            foreach ($rowOfValues as $key =>$value){
                if (in_array($key, $keys)) {
                    $value = FileController::cleannum($value);
                }
                else {
                    $value = $value;
                }
                $tmp_data += array(FileController::clean($headers[$key]) => $value );
            }
            $tmp_data += array('uid' => $uid );
            array_push($data,$tmp_data);
            $uid = $uid + 1;
        }
        $totdata['data'] =  $data;
        $totdata['last_uid'] = $uid;
        return $totdata ;
    }

    public function clean($string) {
        $string = strtolower($string);
        $string = trim($string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '_', $string);
        $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '_', $string); // Replaces all spaces with hyphens.
        return FileController::check_col_name($string);

    }

    public function check_col_name($string) {
        if ($string == strtolower('TIME_PERIOD')) {
           return 'year';
        }
        return $string;
    }

    public function cleannum($string) {
        $orginal_str = $string;
        $string = preg_replace('/[`~!@#$%^&*()_|+\-=?;:",.<>]/', '', $string);
        #$string = preg_replace('/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/",'',$string);
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace('"', '', $string); // Replaces all spaces with hyphens.
        if (!is_numeric($string)){
            return 0;
        }
        $string = round(floatval($orginal_str),2);
        if (!empty($string) and $string != '' ){
            return $string;
        }else {
            return 0;
        }
    }

    public function cleachar($string) {
        //$string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
        //$string = str_replace('-', '_', $string); // Replaces all spaces with hyphens.
        /*if(preg_match("/^[0-9]+-[0-9]+$/",$string)){
            $string = str_replace('_', '', $string);
            $string = 's'.$string;
        }else{
            $string = $string;
        }*/
        return $string;
    }

}