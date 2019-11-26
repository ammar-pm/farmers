<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\File;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\Dataset;
use App\Http\Controllers\API\JSonFileController;

class DatasetController extends Controller
{

    public function index()
    {
        return view('datasets.index');
    }

    public function download($id)
    {
        $file = File::find($id);
        $lang = (empty($file->language))?'en':$file->language;
        DatasetController::json_2_csv2($id,$file->url,$lang);
        return response()->download(public_path($file->url));
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