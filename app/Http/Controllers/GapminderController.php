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


class GapminderController extends Controller
{

    public function vizbi($id)
    {
        $file = File::find($id);
        $lang = (empty($file->language))?'en':$file->language;
        $data = [];
        if (!isset($file->url)){
            $data['file'] = [];
            $data['msg'] = [
                'msg_code' => 2,
                'file_id' =>$id,
                'msg_text' => Lang::get('common.selectfileerror')
            ];
        }elseif (!file_exists($file->url) and isset($file->file_data_text)){
            GapminderController::json_2_csv2($id,$file->url,$lang);
            $data['file'] = $file->toArray();
            //GapminderController::json_2_csv2($id,$file->url);
            $data['msg'] = [
                'msg_code' => 1,
                'file_id' =>$id,
                'msg_text' => 'file found'
            ];
        }elseif (file_exists($file->url)){
            GapminderController::json_2_csv2($id,$file->url,$lang);
            $data['file'] = $file->toArray();
            $data['msg'] = [
                'msg_code' => 1,
                'file_id' =>$id,
                'msg_text' => 'file found'
            ];
        }else{
            $data['file'] = [];
            $data['msg'] = [
                'msg_code' => 2,
                'file_id' =>$id,
                'msg_text' => Lang::get('common.filenotsaved')
            ];
        }
        return view('datasets.vizbi', $data);
    }

    public function vizbi_line($id)
    {
        $file = File::find($id);
        $lang = (empty($file->language))?'en':$file->language;
        $data = [];
        if (!isset($file->url)){
            $data['file'] = [];
            $data['msg'] = [
                'msg_code' => 2,
                'file_id' =>$id,
                'msg_text' => Lang::get('common.selectfileerror')
            ];
        }elseif (!file_exists($file->url) and isset($file->file_data_text)){
            GapminderController::json_2_csv2($id,$file->url,$lang);
            $data['file'] = $file->toArray();
            //GapminderController::json_2_csv($file->file_data_text,$file->url);
            $data['msg'] = [
                'msg_code' => 1,
                'file_id' =>$id,
                'msg_text' => 'file found'
            ];
        }elseif (file_exists($file->url)){
            GapminderController::json_2_csv2($id,$file->url,$lang);
            $data['file'] = $file->toArray();
            $data['msg'] = [
                'msg_code' => 1,
                'file_id' =>$id,
                'msg_text' => 'file found'
            ];
        }else{
            $data['file'] = [];
            $data['msg'] = [
                'msg_code' => 2,
                'file_id' =>$id,
                'msg_text' => Lang::get('common.filenotsaved')
            ];
        }
        return view('datasets.vizbi_line', $data);
    }

    public function vizbi_bar($id)
    {
        $file = File::find($id);
        $lang = (empty($file->language))?'en':$file->language;
        $data = [];
        if (!isset($file->url)){
            $data['file'] = [];
            $data['msg'] = [
                'msg_code' => 2,
                'file_id' =>$id,
                'msg_text' => Lang::get('common.selectfileerror')
            ];
        }elseif (!file_exists($file->url) and isset($file->file_data_text)){
            GapminderController::json_2_csv2($id,$file->url,$lang);
            $data['file'] = $file->toArray();
            //GapminderController::json_2_csv($file->file_data_text,$file->url);
            $data['msg'] = [
                'msg_code' => 1,
                'file_id' =>$id,
                'msg_text' => 'file found'
            ];
        }elseif (file_exists($file->url)){
            GapminderController::json_2_csv2($id,$file->url,$lang);
            $data['file'] = $file->toArray();
            $data['msg'] = [
                'msg_code' => 1,
                'file_id' =>$id,
                'msg_text' => 'file found'
            ];
        }else{
            $data['file'] = [];
            $data['msg'] = [
                'msg_code' => 2,
                'file_id' =>$id,
                'msg_text' => Lang::get('common.filenotsaved')
            ];
        }

        return view('datasets.vizbi_bar', $data);
    }


    public function json_2_csv($file_data,$file_name)
    {
        $jsonString = $file_data;

        //Decode the JSON and convert it into an associative array.
        $jsonDecoded = json_decode($jsonString, true);

        $jsonDecodedHeader = array_keys($jsonDecoded[0]);
        //Give our CSV file a name.
        $csvFileName = $file_name;

        //Open file pointer.
        $fp = fopen($csvFileName, 'w');

        //Write the header to the CSV file.
        fputcsv($fp, $jsonDecodedHeader);

        //Loop through the associative array.
        foreach($jsonDecoded as $row){
            //Write the row to the CSV file.
            fputcsv($fp, $row);
        }

        //Finally, close the file pointer.
        fclose($fp);

        return $csvFileName;
    }

    public function json_2_csv2($file_id,$file_name,$lang)
    {
        $JsonController = new JSonFileController();
        $JsonController->setLanguage($lang);
        $file_data_text = $JsonController->get_json_all_row_qry_viz($file_id);
        $jsonDecoded = $file_data_text;


        //Decode the JSON and convert it into an associative array.
        //$jsonDecoded = json_decode($jsonString, true);

        $jsonDecodedHeader = array_keys($jsonDecoded[0]);
        //Give our CSV file a name.
        $csvFileName = $file_name;

        //Open file pointer.
        $fp = fopen($csvFileName, 'w');

        //Write the header to the CSV file.
        fputcsv($fp, $jsonDecodedHeader);

        //Loop through the associative array.
        foreach($jsonDecoded as $row){
            //Write the row to the CSV file.
            fputcsv($fp, $row);
        }

        //Finally, close the file pointer.
        fclose($fp);

        return $csvFileName;
    }

}