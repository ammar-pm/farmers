<?php

namespace App\Http\Controllers\API;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use App\Dataset;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dataset as DatasetResource;
use Illuminate\Support\Facades\Auth;
use App;
use App\Http\Resources\File as FileResource;

class FileController extends Controller
{
    public function index()
    {
        return File::orderBy('title')->pluck('id', 'title');
    }

    public function saveVizabiOptions(Request $request){
        $Input = $request->all();
        if(($Input['user_role'] == 'editor' || $Input['user_role'] == 'admin') && $Input['url'] == 'datasets') {
            // save options
            $record = Dataset::find($Input['dataset_id']);
            $options = unserialize($record->options);
            $options['vizabi_model'] = $Input['foptions'];
            $options = serialize($options);
            if($record) {
                $record->options = $options;
                $record->save();
            }
            return '1';
        }else{
            // do nothing
            return '2';
        }

    }

    public function getVizabiOptions(Request $request){
        $Input = $request->all();
        if(($Input['user_role'] == 'editor' || $Input['user_role'] == 'admin') && $Input['url'] == 'datasets') {
            // save options
            $record = Dataset::find($Input['dataset_id']);
            $options = unserialize($record->options);
            if($record) {
                return  $options['vizabi_model'];
            }
            return '1';
        }else{
            // do nothing
            return '2';
        }

    }

    public function bytopic($topic_id)
    {
        return File::with('topics')
            ->join('file_post', 'file_post.file_id', '=', 'files.id')
            ->where('file_post.post_id', $topic_id)
            ->orderBy('title')
            ->pluck('files.id', 'files.title');
    }

    public function chartjs(Request $request)
    {
        $data = [];

        ////////////////
        /// for line graph testing
        /// ////////////
        /*$data['labels'] = [1997,2007,2017];
        $data['dataset'] = [
             [
            'label' => "1_building",
            'fill' => '',
            'pointStyle' => '',
            'pointRadius' => '',
            'lineTension' => 0,
            'spanGaps' => '',
            'data' => [26111.0,47740.0,54901.0]
             ],
             [
                 'label' => "2_building",
                'fill' => '',
                'pointStyle' => '',
                'pointRadius' => '',
                'lineTension' => 0,
                'spanGaps' => '',
                'data' => [16161.0,32677.0,37578.0]
             ]
        ];
        return $data;*/
        ////////////////
        if (isset($request->file_id[0])) {

            $file = File::find($request->file_id[0]['id']);

            $results = Excel::load($file->url, function ($reader) {
            })->toArray();

            // get data for wide format with N-Features
            if ($file->dformat == 1) {
                $results = FileController::getDataWChartJs($file->url);
                if (count($results) == 2) return $results;
            }
            // Abdullrahman elHayek -- I added this code to change format from long to wide.
            if ($file->dformat == 2) { // narrow format
                //$labels = array_keys($results[0]);
                //$results = FileController::long_to_wide($results,$labels[1],$labels[2]);
                $results = FileController::getDataLChartJs($file->url);
                if (count($results) == 2) return $results;
            }
            // end of code**

            $labels = array_keys($results[0]);

            unset($labels[0]);

            $data['labels'] = array_values($labels);

            foreach ($results as $key => $result){
                $color = "#".substr(md5(rand()), 0, 6);
                $data['dataset'][] = [
                    'label' => array_shift($result),
                    'fill' => '',
                    'pointStyle' => '',
                    'pointRadius' => '',
                    'lineTension' => 0,
                    'spanGaps' => '',
                    'backgroundColor' => $color,
                    'hidden' => false,
                    'data' => array_map('intval', array_values(array_map(function($num){return str_replace( ',', '', $num );}, $result)))
                    //'data' => array_values(array_map(function($num){return str_replace( ',', '', $num );}, $result))
                ];
            }

        }

        return $data;
    }

    public function highchart($id)
    {
        $data = [];

        $file = File::find($id);

        /*
        ////// for testing payload
        else{
             //echo $jsonArray, die();
                $data = [
                        "series" =>[
                            //[
                            ["name" => "pse_villa", "data" =>[1.0,2.5,3.8]],
                            ["name" => "1.0_villa", "data" =>[4.0,5.5,6.8]],
                            ["name" => "2.0_villa", "data" =>[7.0,8.5,9.8]],
                            ["name" => "3.0_villa", "data" =>[10.0,11.5,12.8]],
                            ["name" => "pse_apartment", "data" =>[13.0,14.5,15.8]],
                            ["name" => "1.0_apartment", "data" =>[16.5,17.5,18.8]],
                            ["name" => "2.0_apartment", "data" =>[19.0,20.5,21.8]],
                            ["name" => "3.0_apartment", "data" =>[22.5,23.5,24.8]]
                        ],
                        "categories"=>
                            [
                                [
                                    "name" => "Year", "categories" =>[1997,2007,2017]
                                ]
                            ]
                    ];

            return $data;
        }
        /////////////////////////////
        */
        $readerObj;

        $results = Excel::load($file->url, function($reader) use(&$readerObj) {
            $readerObj = $reader;
        })->get();
        /////
        $idx_col = 0;
        $idx_row = 0;
        foreach( $readerObj->getActiveSheet()->getRowIterator() as $row ){
            foreach( $row->getCellIterator() as $cell ){
                $value = $cell->getCalculatedValue();
                $excelSheetData[$idx_row][$idx_col] = $value;
                $idx_col= $idx_col+1;
            }
            $idx_row = $idx_row+1;
            $idx_col = 0;
        }
        $keys = array_filter($excelSheetData[0], function($x) { return empty($x); });
        ///
        if ($file->dformat == 1) { // wide format
            if ( count($keys) == 0){ // single feature file
                $data = FileController::HighChartWideFormat($id);
                return $data;
            }else{
                $data = FileController::HighChartNWideFormat($file->url);
                return $data;
            }
        }

        if ($results->first()->count() == 4){
            $data = FileController::getDataLHighChartJs($file->url);
            return $data;
        }

        $excelSheetData = [];
        $referenceRow   = [];

        for ( $row = 0; $row <= $results->count()+1; $row++ ){
            for ( $col = 0; $col <= $results->first()->count()+1; $col++ ){
                if (!$readerObj->getActiveSheet()->getCellByColumnAndRow( $col, $row )->isInMergeRange() || $readerObj->getActiveSheet()->getCellByColumnAndRow( $col, $row )->isMergeRangeValueCell()) {
                    $excelSheetData[$row][$col] = $readerObj->getActiveSheet()->getCellByColumnAndRow( $col, $row )->getCalculatedValue();
                    $referenceRow[$col]=$excelSheetData[$row][$col];
                } else {
                    $excelSheetData[$row][$col]=$referenceRow[$col];
                }
            }
        }

        unset($excelSheetData[0]);

        $isThreeDmap = $this->checkChartData($excelSheetData);

        if ($isThreeDmap) {
            $data = $this->threeDmap($excelSheetData);
        } else {
            $data = $this->fourDmap($excelSheetData);
        }
        return $data;
    }
    /*
     * getDataLHighChartJs Programmed by Abed to extract 2 features payload for HighCartJs
     * */
    public function getDataLHighChartJs($file_url)
    {
        /*$file = File::find($file_id);*/
        $readerObj;
        $excelSheetData = [];
        $excelSheet = [];

        $results = Excel::load($file_url, function ($reader) use (&$readerObj) {
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

        $keys = array_values($excelSheetData[0]);
        $data = array_slice($excelSheetData, 1);

        $idx_geokey_arr = array_values(array_unique(array_column($data, 0)));// geo localtions
        $idx_yearkey_arr = array_values(array_unique(array_column($data, 1)));// geo years
        $idx_featurekey_arr = array_values(array_unique(array_column($data, 2)));// feature array
        //Dd($idx_yearkey_arr);
        $newdata["categories"] =
            [
                [
                    "name" => "Year", "categories" =>$idx_yearkey_arr
                ]
            ];
        $newdata["series"] = [];
        foreach ($idx_featurekey_arr as $key => $featureval_idx) {
            foreach($idx_geokey_arr as $key=>$geoval_idx) {
                $tmp = array_filter($data, function ($var) use ($geoval_idx,$featureval_idx) {
                    return ($var[0] == $geoval_idx && $var[2] == $featureval_idx); // filter over years
                });

                //Dd(count($tmp));
                $series = [];
                foreach($tmp as $key=>$val){
                    array_push($series,end($val));
                }
                //Dd($series);
                //Dd(TestController::flatten($tmp[0]));
                $resdata = [];
                $fname = '';
                foreach ($tmp as $key => $val) {
                    for ($i = 0; $i < count($val) - 1; $i += 2) {
                        $fname = (($fname != '') ? $fname . '_' : null) . $val[$i];
                    }
                    //$resdata[]
                    $resdata["name"] = $fname;
                    $resdata["data"] = array_map('intval', $series);
                    //$resdata["data"] = $series;
                    $resdata["visible"] = false;
                    //$resdata[$fname] = $val[count($val) - 1];
                    $fname = '';
                }
                //Dd($resdata);
                array_push($newdata["series"], $resdata);
            }
        }
        $newdata["series"][0]["visible"] = true;
        $newdata["series"][1]["visible"] = true;
        $newdata["series"][2]["visible"] = true;
        return $newdata;
    }

    private function checkChartData($excelSheetData)
    {
        $lastRow = end($excelSheetData);
        return is_null(end($lastRow));
    }

    private function threeDmap($excelSheetData)
    {
        $data = [];

        //$header = array_slice($excelSheetData[1], 2);
        $header = [array_column($excelSheetData, 1)[0]];

        unset($excelSheetData[1]);

        $data['series'] = $this->getSeriesData($excelSheetData);

        foreach ($header as $key => $label) {
            if($label != '') {
                $data['categories'][] = [
                    'name' => $label,
                    'categories' => array_unique(array_column($excelSheetData, 1))
                ];
            }
        }

        //$data['categories'] = array_slice($data['categories'], 0, -1); // for $results->count()+1

        return $data;
    }

    private function getSeriesData($excel)
    {
        $seriesData = [];
        $seriesName = array_unique(array_column($excel, 0));

        foreach ($seriesName as $name) {
            $seriesData[] = [
                'name' => $name,
                'data' => $this->getSeriesNameData($excel, $name)
            ];
        }
        return $seriesData;
    }

    private function getSeriesNameData($excel, $name)
    {
        $nameData = [];
        $categoriesName = array_unique(array_column($excel, 1));

        foreach ($excel as $res) {
            $res = array_slice($res, 0, -1); // for $results->count()+1
            if($res[0] == $name ){
                $nameData[] = array_slice($res, 2);
            }
        }

        //return $this->data_flatten($this->array_chunk_vertical($this->data_flatten($nameData), count($categoriesName)));
        return array_filter($this->data_flatten($this->array_chunk_vertical($this->data_flatten($nameData), count($categoriesName))));
    }

    private function fourDmap($excelSheetData)
    {
        $data = [];

        $header = array_slice(array_filter($excelSheetData[1]), 2); // 1997,2007
        $subHeader = array_slice(array_filter($excelSheetData[1]), 0, -3); // Governorate
        $subHeaderData = array_slice($excelSheetData[2], 2); //Male,Female

        unset($excelSheetData[1]);
        unset($excelSheetData[2]);

        $data['series'] = $this->getFourSeriesData($excelSheetData, $subHeaderData);

        foreach ($header as $key => $label) {
            $data['categories'][] = [
                'name' => $label,
                'categories' => $this->getFourCategoriesData(array_unique(array_column($excelSheetData, 1)), array_unique($subHeaderData))
            ];
        }

        return $data;

    }

    private function getFourSeriesData($excelSheetData, $subHeaderData)
    {
        $seriesData = [];
        $seriesName = array_unique(array_column($excelSheetData, 0));

        foreach ($seriesName as $name) {
            $seriesData[] = [
                'name' => $name,
                'data' => $this->getFourSeriesNameData($excelSheetData, $name, $subHeaderData)
            ];
        }

        return $seriesData;
    }

    private function getFourSeriesNameData($excelSheetData, $name, $subHeaderData)
    {
        $commonColumn = array_count_values($subHeaderData);
        $commonColumnValue = reset($commonColumn);
        $pairColumn = count($subHeaderData) / $commonColumnValue;
        $nameData = [];
        $results = [];

        foreach ($excelSheetData as $key => $data) {
            if($data[0] == $name){
                $nameData[] = array_slice($data, 2);
            }
        }

        $flatData = array_chunk($this->data_flatten($nameData), 2);

        $i = 0;

        foreach ($flatData as $key => $data) {

            if($i == $commonColumnValue){
                $i=0;
            }

            $results[$i][] = $data;

            $i++;
        }

        return $this->data_flatten($results);
    }

    private function getFourCategoriesData($categories, $subHeaderData)
    {
        $catData = [];

        foreach ($categories as $value) {
            $catData[] = [
                'name' => $value,
                'categories' => $subHeaderData
            ];
        }
        return $catData;
    }

    private function data_flatten($array)
    {
        if (!is_array($array)) {
            return FALSE;
        }

        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    private function array_chunk_vertical($data, $columns)
    {
        $n = count($data) ;
        $per_column = floor($n / $columns) ;
        $rest = $n % $columns ;

        $per_columns = [];
        for ( $i = 0 ; $i < $columns ; $i++ ) {
            $per_columns[$i] = $per_column + ($i < $rest ? 1 : 0) ;
        }

        $tabular = [];
        foreach ( $per_columns as $rows ) {
            for ( $i = 0 ; $i < $rows ; $i++ ) {
                $tabular[$i][ ] = array_shift($data) ;
            }
        }

        return $tabular ;
    }

    // change the long format to wide format function.
    public function long_to_wide($data,$att,$stat) {
        $resdata = [];
        $fres = [];
        $keys = array_keys($data[0]);
        $idx = $keys[0];
        $idx_arr = array_unique(array_column($data, $idx));
        $att_arr = array_unique(array_column($data, $att));
        $cnt = 0;
        foreach ($idx_arr as $key => $idx_val){
            $resdata[$idx] = $idx_val;
            foreach ($att_arr as $key => $att_val) {
                $tmp = array_filter($data, function ($var) use ($att, $idx,$att_val,$idx_val) {
                    return ($var[$att] == $att_val and $var[$idx] == $idx_val);
                });
                $tmp = $tmp[$cnt];
                if(isset($tmp[$stat])){
                    $resdata[$att_val] = $tmp[$stat];
                }
                else{
                    $resdata[$att_val] = '';
                };
                $cnt++;
            }
            array_push($fres , $resdata);
        }
        return $fres;
    }
///---- end of long_to_wide function ---
    //////////////////////////////////////
    public function HighChartNWideFormat($file_url){
        /*$file = File::find($file_id);*/
        $readerObj;
        $excelSheetData = [];
        $excelSheet = [];

        $results = Excel::load($file_url, function($reader) use(&$readerObj) {
            $readerObj = $reader;
        })->get();

        //////////////////////////////////// Dump all excel sheet into Array
        $idx_col = 0;
        $idx_row = 0;
        foreach( $readerObj->getActiveSheet()->getRowIterator() as $row ){
            foreach( $row->getCellIterator() as $cell ){
                $value = $cell->getCalculatedValue();
                $excelSheetData[$idx_row][$idx_col] = $value;
                $idx_col= $idx_col+1;
            }
            $idx_row = $idx_row+1;
            $idx_col = 0;
        }
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

        $transposed_excelSheetData = array_map(null, ...$excelSheetData);

        //$keys = array_values(array_slice($transposed_excelSheetData[0], 2));
        //$data = array_slice($excelSheetData, 1);

        $idx_geokey_arr = array_values(array_slice($transposed_excelSheetData[0], 2));// geo localtions
        $idx_yearkey_arr = array_values(array_unique(array_slice($excelSheetData[0],1)));// geo years
        $idx_featurekey_arr = array_values(array_unique(array_slice($excelSheetData[1],1)));// feature array
        //Dd($idx_yearkey_arr);
        $newdata["categories"] =
            [
                [
                    "name" => "Year", "categories" =>$idx_yearkey_arr
                ]
            ];
        $newdata["series"] = [];
        $tmpseries =[];
        foreach($idx_geokey_arr as $geokey=>$geoval_idx) {
            foreach ($idx_featurekey_arr as $key => $featureval_idx) {
                $resdata = [];
                foreach($idx_yearkey_arr as $key=>$yearval_idx) {
                    $tmp = array_filter($transposed_excelSheetData, function ($var) use ($yearval_idx,$featureval_idx) {
                        return ($var[0] == $yearval_idx && $var[1] == $featureval_idx); // filter over years
                    });
                    $cell_val=null;
                    foreach(array_flatten($tmp) as $tmpkey=>$tmpval_idx) {
                        if ($tmpkey == $geokey+2){
                            $cell_val = $tmpval_idx;
                            break;
                        }
                    }
                    array_push($tmpseries,$cell_val);
                }
                $resdata["name"] = $geoval_idx.'_'.$featureval_idx;
                $resdata["data"] = array_map('intval', $tmpseries);
                //$resdata["data"] = $tmpseries;
                $resdata["visible"] = false;
                array_push($newdata["series"],$resdata);
                $tmpseries = [];
            }
        }
        $newdata["series"][0]["visible"] = true;
        $newdata["series"][1]["visible"] = true;
        $newdata["series"][2]["visible"] = true;
        //Dd($newdata);
        return $newdata;


    }
    //////////////////////////////////////

    public function HighChartWideFormat($id) {
        $file = File::find($id);

        $readerObj;

        $results = Excel::load($file->url, function($reader) use(&$readerObj) {
            $readerObj = $reader;
        })->get();

        $data = $results->toArray();

        $keys = array_keys($data[0]);

        foreach ($data as $key => $val){
            $res['series'][] = [
                'name' => $val[$keys[0]],
                'data' => array_slice($val, 1)
            ];
        }

        $res['categories'][] = [
            'name' => 'Year',
            'categories' => array_slice($keys, 1)
        ];


        return $res;
    }

    ///Get data for ChartJS from Long format data file with N-Features
    public function getDataLChartJs($file_url)
    {
        /*$file = File::find($file_id);*/
        $readerObj;
        $excelSheetData = [];
        $excelSheet = [];

        $results = Excel::load($file_url, function ($reader) use (&$readerObj) {
            $readerObj = $reader;
        })->get();

        //////////////////////////////////// Dump all excel sheet into Array
        $idx_col = 0;
        $idx_row = 0;
        foreach( $readerObj->getActiveSheet()->getRowIterator() as $row ){
            foreach( $row->getCellIterator() as $cell ){
                $value = $cell->getCalculatedValue();
                $excelSheetData[$idx_row][$idx_col] = $value;
                $idx_col= $idx_col+1;
            }
            $idx_row = $idx_row+1;
            $idx_col = 0;
        }

        $cnt = count($excelSheetData[0]);
        //////////////////////////////////////////////////////////////////////////////
        /// new code
        if ($cnt == 4){
            $transposed_excelSheetData = array_map(null, ...$excelSheetData);
            $idx_geokey_arr = array_values(array_unique(array_slice($transposed_excelSheetData[0],1)));
            $idx_yearkey_arr = array_values(array_unique(array_slice($transposed_excelSheetData[1],1)));// geo years
            $idx_featurekey_arr = array_values(array_unique(array_slice($transposed_excelSheetData[2],1)));// feature array

            $data['labels'] = $idx_yearkey_arr;
            foreach ($idx_featurekey_arr as $key => $featureval_idx) {
                foreach($idx_geokey_arr as $geokey=>$geoval_idx) {
                    $resdata =[];
                    foreach($idx_yearkey_arr as $key=>$yearval_idx) {
                        $tmp = array_filter($excelSheetData, function ($var) use ($geoval_idx,$yearval_idx,$featureval_idx) {
                            return ($var[0] == $geoval_idx && $var[1] == $yearval_idx && $var[2] == $featureval_idx); // filter over years
                        });
                        if (count($tmp) > 0){
                            $cell_val = end($tmp);
                            $cell_val = end($cell_val);
                            $key_name = $geoval_idx . '_' . $featureval_idx;
                            array_push($resdata, $cell_val);
                        }else {
                            $cell_val = null;
                            $key_name = $geoval_idx . '_' . $featureval_idx;
                            array_push($resdata, $cell_val);
                        }

                    }
                    $color = "#".substr(md5(rand()), 0, 6);
                    $data['dataset'][] =
                        [
                            'label' => $key_name,
                            'fill' => '',
                            'pointStyle' => '',
                            'pointRadius' => '',
                            'lineTension' => 0,
                            'spanGaps' => '',
                            'backgroundColor' => $color,
                            'hidden' => false,
                            'data' =>array_map('intval', $resdata)
                            //'data' => $resdata
                        ];
                }
            }
            return $data;
        }elseif($cnt == 3){
            ///////////// old code //////////////
            $keys = array_values($excelSheetData[0]);
            $data = array_slice($excelSheetData, 1);
            $idx_key_arr = array_values(array_unique(array_column($data, 0)));
            $newdata = [];
            foreach($idx_key_arr as $key=>$val_idx) {
                $tmp = array_filter($data, function ($var) use($val_idx) {
                    return ($var[0] == $val_idx);
                });
                $resdata = [];
                $fname = '';
                foreach ($tmp as $key => $val) {
                    for ($i = 1; $i < count($val) - 1; $i++) {
                        $fname = (($fname != '') ? $fname . '_' : null) . $val[$i];
                    }
                    //$resdata[]
                    $resdata[$keys[0]] = $val[0];
                    $resdata[$fname] = $val[count($val) - 1];
                    $fname = '';
                }
                array_push($newdata, $resdata);
            }
            return $newdata;
        }else {
            $newdata = [
                "msg_code" => 0,
                "msg_text" =>'the system does not support more than two features'
            ];
        }

    }

    ///Get data for ChartJS from Wide format data file with N-Features
    public function getDataWChartJs($file_url){
        /*$file = File::find($file_id);*/
        $readerObj;
        $excelSheetData = [];
        $excelSheet = [];

        $results = Excel::load($file_url, function($reader) use(&$readerObj) {
            $readerObj = $reader;
        })->get();

        //////////////////////////////////// Dump all excel sheet into Array
        $idx_col = 0;
        $idx_row = 0;
        foreach( $readerObj->getActiveSheet()->getRowIterator() as $row ){
            foreach( $row->getCellIterator() as $cell ){
                $value = $cell->getCalculatedValue();
                $excelSheetData[$idx_row][$idx_col] = $value;
                $idx_col= $idx_col+1;
            }
            $idx_row = $idx_row+1;
            $idx_col = 0;
        }
        ////////////////////////////////////// check if its muti-feature file /////////////////////
        $cnt = count($excelSheetData[0]) - count(array_filter($excelSheetData[0]));
        /*
         * if the count is greater than Zero then it is a wide format multi-feature wide format file
         * */
        if ($cnt > 0) {
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
            /// new code
            $transposed_excelSheetData = array_map(null, ...$excelSheetData);
            $idx_geokey_arr = array_values(array_slice($transposed_excelSheetData[0], 2));// geo localtions
            $idx_yearkey_arr = array_values(array_unique(array_slice($excelSheetData[0],1)));// geo years
            $idx_featurekey_arr = array_values(array_unique(array_slice($excelSheetData[1],1)));// feature array

            $data['labels'] = $idx_yearkey_arr;
            foreach ($idx_featurekey_arr as $key => $featureval_idx) {
                foreach($idx_geokey_arr as $geokey=>$geoval_idx) {
                    $resdata =[];
                    foreach($idx_yearkey_arr as $key=>$yearval_idx) {
                        $tmp = array_filter($transposed_excelSheetData, function ($var) use ($yearval_idx,$featureval_idx) {
                            return ($var[0] == $yearval_idx && $var[1] == $featureval_idx); // filter over years
                        });
                        $cell_val=null;
                        foreach(array_flatten($tmp) as $tmpkey=>$tmpval_idx) {
                            if ($tmpkey == $geokey+2){
                                $cell_val = $tmpval_idx;
                                $key_name = $geoval_idx.'_'.$featureval_idx;
                                array_push($resdata, $cell_val);
                                break;
                            }
                        }
                        //echo $cell_val ,'<br>' ,$key_name, '<br>';
                        //array_push($resdata[$key_name],$cell_val);
                    }
                    $color = "#".substr(md5(rand()), 0, 6);
                    $data['dataset'][] =
                        [
                            'label' => $key_name,
                            'fill' => '',
                            'pointStyle' => '',
                            'pointRadius' => '',
                            'lineTension' => 0,
                            'spanGaps' => '',
                            'backgroundColor' => $color,
                            'hidden' => false,
                            'data' => array_map('intval', $resdata)
                            //'data' => $resdata
                        ];
                }
            }
            return $data;

            ///////////////////////////////////////// convert it to json or associative array if wide //////////////////
            //// old code
            /*for($row=2;$row<count($excelSheetData);$row++)
            {
                for($col=0;$col<count($excelSheetData[0]);$col++){
                    $key_name = (isset($excelSheetData[0][$col])?$excelSheetData[0][$col].'_' : null). $excelSheetData[1][$col];
                    $temp[$key_name] = $excelSheetData[$row][$col];
                }
                array_push($excelSheet,$temp);
            }
            return $excelSheet;*/
        } else {
            return $results->toArray();
        }

    }

    public function clean($string , $rep) {
        $string = preg_replace('/[`~!@#$%^&*()_|+\-=?;:",.<>]/', $rep, $string);
        $string = str_replace(' ', $rep, $string); // Replaces all spaces with hyphens.
        $string = str_replace('"', $rep, $string); // Replaces all spaces with hyphens.
        $string = str_replace('\'', $rep, $string); // Replaces all spaces with hyphens.
        return $string;
    }


    public function get_searched_files(Request $request)
    {
        $input = $request->all();
        /// add the username to the datasets fields
        $query = File::with(['user']);

        $subQueryUserNames = 'select name from users where id = files.created_by';
        $subQueryUserNames2 = 'select group_concat(title) as topics from posts inner join file_post on posts.id = file_post.post_id where file_post.file_id = files.id';
        //$query->selectSub($subQueryUserNames, 'user_name');
        $files = $query->addSubSelect('topics_abdo', $subQueryUserNames2);
        $files = $query->addSubSelect('user_name', $subQueryUserNames);
        $super_files = DB::table( DB::raw("({$files->toSql()}) as files") )
            ->mergeBindings($files->getQuery()); // you need to get underlying Query Builder;
        //$super_datasets = Dataset::hydrate($super_datasets->get()->toArray());
        //Dd($super_datasets);
        /// end adding the username to the datasets fields
        if (!empty($input['search_text'])){
            if (empty($input['sort_option_lang'])) {
                $data = [];
                $data['records'] = FileResource::collection(
                    File::hydrate($super_files->where('title', 'like', '%' . FileController::clean($input['search_text'],'%') . '%')
                        ->orWhere('user_name', 'like', '%' . FileController::clean($input['search_text'],'%') . '%')
                        ->orWhere('topics_abdo', 'like', '%' . FileController::clean($input['search_text'],'%') . '%')
                        ->orWhere('id', '=', FileController::clean($input['search_text'],'') )
                        ->orWhereRaw('DATE_FORMAT(created_at, "%d/%c/%Y")' . ' = '. '\'' . FileController::clean($input['search_text'],'') . '\'')
                        ->orWhereRaw('DATE_FORMAT(created_at, "%d/%m/%Y")' . ' = '. '\'' . FileController::clean($input['search_text'],'') . '\'')
                        ->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get()->toArray()));
                return $data;
            }else{
                $data = [];
                $data['records'] =FileResource::collection(
                    File::hydrate($super_files->where('title', 'like', '%' . FileController::clean($input['search_text'],'%') . '%')
                        ->where(function ($query) use ($input) {
                            $query->where('language', $input['sort_option_lang']);
                        })->orWhere(function($query) use ($input) {
                            $query->orWhere('user_name', 'like', '%' . FileController::clean($input['search_text'],'%') . '%')
                                  ->orWhere('topics_abdo', 'like', '%' . FileController::clean($input['search_text'],'%') . '%')
                                  ->orWhere('id', '=', FileController::clean($input['search_text'],'') )
                                  ->orWhereRaw('DATE_FORMAT(created_at, "%d/%c/%Y")' . ' = '. '\'' . FileController::clean($input['search_text'],'') . '\'')
                                  ->orWhereRaw('DATE_FORMAT(created_at, "%d/%m/%Y")' . ' = '. '\'' . FileController::clean($input['search_text'],'') . '\'');
                        })
                        ->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get()->toArray()));
                return $data;
            }
        }else{
            if (empty($input['sort_option_lang'])) {
                $data = [];
                $data['records'] =
                    FileResource::collection(
                    $files->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get());
                return $data;
            }else{
                $data = [];
                $data['records'] =
                    FileResource::collection(
                    $files->where(function ($query) use ($input) {
                        $query->where('language', $input['sort_option_lang']);
                    })->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])->get());
                return $data;
            }
        }
    }

    public function does_file_have_a_dataset($file_id,$lang)
    {
        App::setLocale($lang);
        /// add the username to the datasets fields
        $query = File::join('dataset_file', 'dataset_file.file_id', '=', 'files.id')
            ->where('dataset_file.file_id', $file_id)
            ->pluck('dataset_file.dataset_id')->toArray();
        if (!empty($query))
        {
            return [
                'msg_cod'=>1,
                'msg_text'=>__('common.file_has_dataset')
            ];
        }else {
            return [
                'msg_cod'=>0,
                'msg_text'=>''
            ];
        }
    }//does_file_have_a_dataset
}