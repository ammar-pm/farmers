<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use App\Dataset;
use App\File;
use Illuminate\Pagination\Paginator;
use App\Indicator;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * * * *** 2016
     * @return \Illuminate\Http\Response
     */
    protected $geos_locations;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->geos_locations = array(
            ["name" => "Jenin", "key" => "pse", "lat" => "32.4572845", "lon" => "35.2847044"],
            ["name" => "Tubas", "key" => "1", "lat" => "32.3211033", "lon" => "35.3611982"],
            ["name" => "Tulkarm", "key" => "2", "lat" => "32.3079653", "lon" => "35.0111189"],
            ["name" => "Qalqiliya", "key" => "1101", "lat" => "32.1960324", "lon" => "34.9727582"],
            ["name" => "Nablus", "key" => "1105", "lat" => "32.2243446", "lon" => "35.2301697"],
            ["name" => "Salfit", "key" => "1110", "lat" => "32.0851114", "lon" => "35.1720772"],
            ["name" => "Jericho", "key" => "1120", "lat" => "31.8595075", "lon" => "35.4469982"],
            ["name" => "Ramallah", "key" => "1115", "lat" => "31.9073861", "lon" => "35.1883724"],
            ["name" => "Jerusalem", "key" => "1230", "lat" => "31.7964453", "lon" => "35.1053187"],
            ["name" => "Bethlehem", "key" => "1240", "lat" => "31.7053996", "lon" => "35.1936877"],
            ["name" => "Hebron", "key" => "1235", "lat" => "31.5325865", "lon" => "35.0910712"],
            ["name" => "Khan Yunis", "key" => "1345", "lat" => "31.3462181", "lon" => "34.2952438"],
            ["name" => "Deir Al Balah", "key" => "1350", "lat" => "31.4171565", "lon" => "34.3421762"],
            ["name" => "Rafah", "key" => "2455", "lat" => "31.2967975", "lon" => "34.2347272"],
            ["name" => "Gaza", "key" => "2413", "lat" => "31.5017126", "lon" => "34.4580897"],
            ["name" => "North Gaza", "key" => "2465", "lat" => "31.5513065", "lon" => "34.5004672"],
            ["name" => "Unkown", "key" => "2470", "lat" => "31.5513065", "lon" => "34.5004672"],
            ["name" => "Unkown", "key" => "2475", "lat" => "31.5513065", "lon" => "34.5004672"],
            ["name" => "Unkown", "key" => "1125", "lat" => "31.5513065", "lon" => "34.5004672"]
        );

        $this->trace_colours = ['Blackbody',
            'Bluered',
            'Blues',
            'Earth',
            'Electric',
            'Greens',
            'Greys',
            'Hot',
            'Jet',
            'Picnic',
            'Portland',
            'Rainbow',
            'RdBu',
            'Reds',
            'Viridis',
            'YlGnBu',
            'YlOrRd'];
    }
    public function vizabi_bubble($id)
    {
        $data = [];
        $file = File::find($id);
        return view('test.index', compact('file'));
    }

    public function json_2_csv($file_data,$file_name)
    {
        $jsonString = $file_data;

        //Decode the JSON and convert it into an associative array.
        $jsonDecoded = json_decode($jsonString, true);

        $jsonDecodedHeader = array_keys($jsonDecoded[0]);
        //Give our CSV file a name.
        $csvFileName = 'data/' . $file_name;

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

    public function index()
    {
        $data = [];
        $file_id = 146; // AHS_DF Long local dformat = 2
        //$file_id = 157; // dformat = 2
        //-------------- For Testing
        $file_id = 154; // AHS_DF Wide local wide
        $file_id = 155; // AHS_DF Wide N local wide
        $file_id = 156; // AHS_DF long 1 local wide
        $file_id = 165; // AHS_DF long n local wide
        //$file_id = 155; // AHS_DF Narrow local wide
        //$file_id = 154; // AHS_DF Narrow local wide
        //****$file_id = 156; // AHS_DF Narrow local wide
        //$file_id = 151; // AHS_DF Wide
        //$id = 69; //AHS_DS3
        //$id = 59; // international
        //$data['records'] = TestController::show_dataset($id);
        //$data['records'] = TestController::highchart($file_id);
        //$data['records'] = TestController::chartjs($file_id);

       // $data['records'] = TestController::plotly_bubble($file_id);
       // Dd($data['records']);
        //$data['records'] = TestController::getDataLChartJs($file_id);
        //$data['records'] = TestController::getDataWChartJs($file_id,'W');
        //$data['records'] = TestController::show($id);
        //Dd($data['records']);
        //print_r('<br/>');
        //$data['myrecords'] = TestController::HighChartWideFormat($file_id);
        //Dd($data['myrecords']);
        //die();

        //$res = TestController::delete_json_row(170,0);
        //Dd($res);

        //$res = TestController::update_json_row(170,'{"geo2":"geo val2","year":"year val","average_household_size":"500","uid":1}');
        //Dd($res);
        //$res = TestController::update_all_datasets();
        return view('test.index', ['msg' => 'done']);
    }

    public function update_all_datasets(){
        $res = Dataset::where('updated_at', '!=' , '2019-5-29')->get();
        foreach ( $res as $record) {
            $record->updated_at =  date('Y-m-d');
            $record->save();
        }

        return ['msg' => 'done'];
    }

    public function update_json_row($file_id,$changed_row){
        $file = File::find($file_id);
        $file_data_text = json_decode($file->file_data_text,true);
        $changed_row = json_decode($changed_row);
        $row_id = 0;
        foreach ($file_data_text as $key => $value) {
            if ($value['uid'] == $changed_row->uid) {
                foreach ($changed_row as $key => $val) {
                    $file_data_text[$row_id][$key] = $val;
                }
                $file_data_text = json_encode($file_data_text);
                $update_str = 'update files set file_data_text =' .'\''.$file_data_text.'\''. ' where id='.$file_id;
                //Dd($update_str);
                DB::statement($update_str);
            }
            $row_id = $row_id +1;
        }
        return 1;
    }//update_json_row

    public function delete_json_row($file_id,$uid){
        $file = File::find($file_id);
        $file_data_text = json_decode($file->file_data_text,true);
        $row_id = 0;
        foreach ($file_data_text as $key => $value) {
            if ($value['uid'] == $uid) {
                unset($file_data_text[$row_id]);
                $file_data_text = array_values($file_data_text);
                $file_data_text = json_encode($file_data_text);
                $update_str = 'update files set file_data_text =' .'\''.$file_data_text.'\''. ' where id='.$file_id;
                DB::statement($update_str);
            }
            $row_id = $row_id +1;
        }
        return 1;
    }//delete_json_row

///////////////////////// added to get cartisan product of all inputs
    function myEach(&$arr)
    {
        $key = key($arr);
        $result = ($key === null) ? false : [$key, current($arr), 'key' => $key, 'value' => current($arr)];
        next($arr);
        return $result;
    }

    function cartesian($input)
    {
        $result = array();

        while (list($key, $values) = TestController::myEach($input)) {
            // If a sub-array is empty, it doesn't affect the cartesian product
            if (empty($values)) {
                continue;
            }

            // Seeding the product array with the values from the first sub-array
            if (empty($result)) {
                foreach ($values as $value) {
                    $result[] = array($key => $value);
                }
            } else {
                // Second and subsequent input sub-arrays work like this:
                //   1. In each existing array inside $product, add an item with
                //      key == $key and value == first item in input sub-array
                //   2. Then, for each remaining item in current input sub-array,
                //      add a copy of each existing array inside $product with
                //      key == $key and value == first item of input sub-array

                // Store all items to be added to $product here; adding them
                // inside the foreach will result in an infinite loop
                $append = array();

                foreach ($result as &$product) {
                    // Do step 1 above. array_shift is not the most efficient, but
                    // it allows us to iterate over the rest of the items with a
                    // simple foreach, making the code short and easy to read.
                    $product[$key] = array_shift($values);

                    // $product is by reference (that's why the key we added above
                    // will appear in the end result), so make a copy of it here
                    $copy = $product;

                    // Do step 2 above.
                    foreach ($values as $item) {
                        $copy[$key] = $item;
                        $append[] = $copy;
                    }

                    // Undo the side effecst of array_shift
                    array_unshift($values, $product[$key]);
                }

                // Out of the foreach, we can add to $results now
                $result = array_merge($result, $append);
            }
        }

        return $result;
    }

    ///////////////////////////////////////////////////////////////////////////////////
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
                    "name" => "Year", "categories" => $idx_yearkey_arr
                ]
            ];
        $newdata["series"] = [];
        foreach ($idx_featurekey_arr as $key => $featureval_idx) {
            foreach ($idx_geokey_arr as $key => $geoval_idx) {
                $tmp = array_filter($data, function ($var) use ($geoval_idx, $featureval_idx) {
                    return ($var[0] == $geoval_idx && $var[2] == $featureval_idx); // filter over years
                });

                //Dd(count($tmp));
                $series = [];
                foreach ($tmp as $key => $val) {
                    array_push($series, end($val));
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
                    $resdata["data"] = $series;
                    //$resdata[$fname] = $val[count($val) - 1];
                    $fname = '';
                }
                //Dd($resdata);
                array_push($newdata["series"], $resdata);
            }

        }

        return $newdata;
    }

    //////////////////////////////////////
    public function HighChartNWideFormat($file_url)
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
        /////////////////////////////// fill the nulls the first line of the header //////////////
        $lvar_set = null;
        foreach ($excelSheetData[0] as $key => $value) {
            if (isset($value)) {
                $lvar_set = $value;
                $excelSheetData[0][$key] = $value;
            } else {
                $excelSheetData[0][$key] = $lvar_set;
            }
        }

        $transposed_excelSheetData = array_map(null, ...$excelSheetData);

        //$keys = array_values(array_slice($transposed_excelSheetData[0], 2));
        //$data = array_slice($excelSheetData, 1);

        $idx_geokey_arr = array_values(array_slice($transposed_excelSheetData[0], 2));// geo localtions
        $idx_yearkey_arr = array_values(array_unique(array_slice($excelSheetData[0], 1)));// geo years
        $idx_featurekey_arr = array_values(array_unique(array_slice($excelSheetData[1], 1)));// feature array
        //Dd($idx_yearkey_arr);
        $newdata["categories"] =
            [
                [
                    "name" => "Year", "categories" => $idx_yearkey_arr
                ]
            ];
        $newdata["series"] = [];
        $tmpseries = [];
        foreach ($idx_geokey_arr as $geokey => $geoval_idx) {
            foreach ($idx_featurekey_arr as $key => $featureval_idx) {
                $resdata = [];
                foreach ($idx_yearkey_arr as $key => $yearval_idx) {
                    $tmp = array_filter($transposed_excelSheetData, function ($var) use ($yearval_idx, $featureval_idx) {
                        return ($var[0] == $yearval_idx && $var[1] == $featureval_idx); // filter over years
                    });
                    $cell_val = null;
                    foreach (array_flatten($tmp) as $tmpkey => $tmpval_idx) {
                        if ($tmpkey == $geokey + 2) {
                            $cell_val = $tmpval_idx;
                            break;
                        }
                    }
                    array_push($tmpseries, $cell_val);
                }
                $resdata["name"] = $geoval_idx . '_' . $featureval_idx;
                $resdata["data"] = $tmpseries;
                $resdata["visible"] = false;
                array_push($newdata["series"], $resdata);
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

    function flatten(array $array)
    {
        $return = array();
        array_walk_recursive($array, function ($a) use (&$return) {
            $return[] = $a;
        });
        return $return;
    }

    ////////////////////////////////// end added to get cartisan product of all inputs

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
        $idx_key_arr = array_values(array_unique(array_column($data, 0)));
        $newdata = [];
        foreach ($idx_key_arr as $key => $val_idx) {
            $tmp = array_filter($data, function ($var) use ($val_idx) {
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
    }

    ///Get data for ChartJS from Wide format data file with N-Features
    public function getDataWChartJs($file_url)
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
        ////////////////////////////////////// check if its muti-feature file /////////////////////
        $cnt = count($excelSheetData[0]) - count(array_filter($excelSheetData[0]));
        /*
         * if the count is greater than Zero then it is a wide format multi-feature wide format file
         * */
        if ($cnt > 0) {
            /////////////////////////////// fill the nulls the first line of the header //////////////
            $lvar_set = null;
            foreach ($excelSheetData[0] as $key => $value) {
                if (isset($value)) {
                    $lvar_set = $value;
                    $excelSheetData[0][$key] = $value;
                } else {
                    $excelSheetData[0][$key] = $lvar_set;
                }
            }
            //////////////////////////////////////////////////////////////////////////////
            $transposed_excelSheetData = array_map(null, ...$excelSheetData);
            $idx_geokey_arr = array_values(array_slice($transposed_excelSheetData[0], 2));// geo localtions
            $idx_yearkey_arr = array_values(array_unique(array_slice($excelSheetData[0], 1)));// geo years
            $idx_featurekey_arr = array_values(array_unique(array_slice($excelSheetData[1], 1)));// feature array

            $totresdata = [];
            foreach ($idx_yearkey_arr as $key => $yearval_idx) {
                $resdata = [];
                $resdata['Year'] = $yearval_idx;
                foreach ($idx_featurekey_arr as $key => $featureval_idx) {
                    foreach ($idx_geokey_arr as $geokey => $geoval_idx) {
                        $tmp = array_filter($transposed_excelSheetData, function ($var) use ($yearval_idx, $featureval_idx) {
                            return ($var[0] == $yearval_idx && $var[1] == $featureval_idx); // filter over years
                        });
                        $cell_val = null;
                        foreach (array_flatten($tmp) as $tmpkey => $tmpval_idx) {
                            if ($tmpkey == $geokey + 2) {
                                $cell_val = $tmpval_idx;
                                $key_name = $geoval_idx . '_' . $featureval_idx;
                                $resdata[$key_name] = $cell_val;
                                break;
                            }
                        }
                        //echo $cell_val ,'<br>' ,$key_name, '<br>';
                        //array_push($resdata[$key_name],$cell_val);
                    }
                }
                array_push($totresdata, $resdata);
            }
            return $totresdata;
            ///////////////////////////////////////// convert it to json or associative array if wide //////////////////
            for ($row = 2; $row < count($excelSheetData); $row++) {
                for ($col = 0; $col < count($excelSheetData[0]); $col++) {
                    $key_name = (isset($excelSheetData[0][$col]) ? $excelSheetData[0][$col] . '_' : null) . $excelSheetData[1][$col];
                    $temp[$key_name] = $excelSheetData[$row][$col];
                }
                array_push($excelSheet, $temp);
            }
            return $excelSheet;
        } else {
            return $results->toArray();
        }

    }

    public function chartjs($file_id)
    {
        $data = [];

        if (isset($file_id)) {

            $file = File::find($file_id);

            $worksheet = Excel::load($file->url, function ($reader) {
            });

            $results = $worksheet->toArray();

            //convert it to json
            // get data for wide format with N-Features
            $file = File::find($file_id);
            if ($file->dformat == 1) {
                $results = TestController::getDataWChartJs($file->url);
            }
            // Abdullrahman elHayek -- I added this code to change format from long to wide.
            if ($file->dformat == 2) { // narrow format
                $labels = array_keys($results[0]);
                $results = TestController::long_to_wide($results, $labels[1], $labels[2]);
                //$results = TestController::getDataLChartJs($file->url);
            }
            // end of code**

            //Dd($results);

            $labels = array_keys($results[0]);


            unset($labels[0]);

            $data['labels'] = array_values($labels);

            foreach ($results as $key => $result) {
                $color = "#" . substr(md5(rand()), 0, 6);
                $data['dataset'][] = [
                    'label' => array_shift($result),
                    'fill' => '',
                    'pointStyle' => '',
                    'pointRadius' => '',
                    'lineTension' => 0,
                    'spanGaps' => '',
                    'backgroundColor' => $color,
                    'data' => array_values(array_map(function ($num) {
                        return str_replace(',', '', $num);
                    }, $result))
                ];
            }

        }

        return $data;
    }


    public function show_dataset($id)
    {
        $data = [];
        $record = Dataset::find($id);
        $data['options'] = unserialize($record->options);
        $data['record'] = Dataset::with(['periods', 'topics', 'governorates', 'indicators', 'files', 'user', 'favorites'])->find($id);
        // $data['favorited'] = $record->favorited($id);

        return $data;
    }


    public function highchart($id)
    {
        $data = [];

        $file = File::find($id);

        $readerObj;

        $results = Excel::load($file->url, function ($reader) use (&$readerObj) {
            $readerObj = $reader;
        })->get();

        if ($file->dformat == 1) { // wide format
            if ($results->first()->count() == 4) {
                $data = TestController::HighChartNWideFormat($file->url);
                return $data;
            } else {
                $data = TestController::HighChartWideFormat($id);
                return $data;
            }

        }
        if ($results->first()->count() == 4) {
            $data = TestController::getDataLHighChartJs($file->url);
            return $data;
        }


        $excelSheetData = [];
        $referenceRow = [];

        for ($row = 0; $row <= $results->count() + 1; $row++) {
            for ($col = 0; $col <= $results->first()->count() + 1; $col++) {
                if (!$readerObj->getActiveSheet()->getCellByColumnAndRow($col, $row)->isInMergeRange() || $readerObj->getActiveSheet()->getCellByColumnAndRow($col, $row)->isMergeRangeValueCell()) {
                    $excelSheetData[$row][$col] = $readerObj->getActiveSheet()->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                    $referenceRow[$col] = $excelSheetData[$row][$col];
                } else {
                    $excelSheetData[$row][$col] = $referenceRow[$col];
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

    private function threeDmap($excelSheetData)
    {
        $data = [];

        //$header = array_slice($excelSheetData[1], 2);
        $header = [array_column($excelSheetData, 1)[0]];
        //$header = array_filter(array_slice($excelSheetData[1], 2));

        unset($excelSheetData[1]);

        $data['series'] = $this->getSeriesData($excelSheetData);

        foreach ($header as $key => $label) {

            if ($label != '') {
                $data['categories'][] = [
                    'name' => $label,
                    'categories' => array_unique(array_column($excelSheetData, 1))
                ];
            }
        }

        //print_r($data);
        //$data['categories'] = array_slice($data['categories'], 0, -1); // for $results->count()+1

        return $data;
    }


    private function checkChartData($excelSheetData)
    {
        $lastRow = end($excelSheetData);
        return is_null(end($lastRow));
    }

    private function getSeriesData($excel)
    {
        $seriesData = [];
        $seriesName = array_unique(array_column($excel, 0));

        //Dd($seriesName) and die();

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
            if ($res[0] == $name) {
                $nameData[] = array_slice($res, 2);
            }
        }

        return array_filter($this->data_flatten($this->array_chunk_vertical($this->data_flatten($nameData), count($categoriesName))));
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
        $n = count($data);
        $per_column = floor($n / $columns);
        $rest = $n % $columns;

        $per_columns = [];
        for ($i = 0; $i < $columns; $i++) {
            $per_columns[$i] = $per_column + ($i < $rest ? 1 : 0);
        }

        $tabular = [];
        foreach ($per_columns as $rows) {
            for ($i = 0; $i < $rows; $i++) {
                $tabular[$i][] = array_shift($data);
            }
        }

        return $tabular;
    }

    ///////////////////////////////

    public function long_to_wide($data, $att, $stat)
    {
        $resdata = [];
        $fres = [];
        $keys = array_keys($data[0]);
        $idx = $keys[0];
        $idx_arr = array_unique(array_column($data, $idx));
        $att_arr = array_unique(array_column($data, $att));
        $cnt = 0;
        foreach ($idx_arr as $key => $idx_val) {
            $resdata[$idx] = $idx_val;
            foreach ($att_arr as $key => $att_val) {
                $tmp = array_filter($data, function ($var) use ($att, $idx, $att_val, $idx_val) {
                    return ($var[$att] == $att_val and $var[$idx] == $idx_val);
                });
                $tmp = $tmp[$cnt];
                if (isset($tmp[$stat])) {
                    $resdata[$att_val] = $tmp[$stat];
                } else {
                    $resdata[$att_val] = '';
                };
                $cnt++;
            }
            array_push($fres, $resdata);
        }
        return $fres;
    }

    public function HighChartWideFormat($id)
    {
        $file = File::find($id);

        $readerObj;

        $results = Excel::load($file->url, function ($reader) use (&$readerObj) {
            $readerObj = $reader;
        })->get();

        $data = $results->toArray();

        $keys = array_keys($data[0]);

        foreach ($data as $key => $val) {
            $res['series'][] = [
                'name' => $val[$keys[0]],
                'data' => array_slice($val, 1)
            ];
        }


        $res['categories'][] = [
            'name' => 'Years',
            'categories' => array_slice($keys, 1)
        ];


        return $res;
    }

    public function show($id)
    {
        $data = [];
        $record = Dataset::find($id);
        $data['options'] = unserialize($record->options);
        $data['record'] = Dataset::with(['periods', 'topics', 'governorates', 'indicators', 'files', 'user', 'favorites'])->find($id);
        // $data['favorited'] = $record->favorited($id);

        return $data;
    }

/////////////////////////////////////////////////////////////////////////////

    public function plotly_wide_map($id)
    {
        $scale = 100;
        $readerObj;
        $excelSheetData = [];
        $excelSheet = [];

        if (isset($id)) {
            $file = File::find($id);
            $results = Excel::load($file->url, function ($reader) use (&$readerObj) {
                $readerObj = $reader;
            })->get();
        }
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
        ////////////////////////////////////// check if its muti-feature file /////////////////////
        $cnt = count($excelSheetData[0]) - count(array_filter($excelSheetData[0]));
        /*
         * if the count is greater than Zero then it is a wide format multi-feature wide format file
         * */
        if ($cnt > 0) {
            $data['labels_years'] = array_values(array_filter($excelSheetData[0])); // remove nulls
            /////////////////////////////// fill the nulls the first line of the header //////////////
            $lvar_set = null;
            foreach ($excelSheetData[0] as $key => $value) {
                if (isset($value)) {
                    $lvar_set = $value;
                    $excelSheetData[0][$key] = $value;
                } else {
                    $excelSheetData[0][$key] = $lvar_set;
                }
            }
            $transposed_excelSheetData = array_map(null, ...$excelSheetData);
            $lon = [];
            $lat = [];
            foreach ($transposed_excelSheetData[0] as $key => $result) {
                $tmp_lon = '';
                $tmp_lat = '';
                foreach ($this->geos_locations as $key => $value) {
                    if ($value['key'] == $result
                        or stripos($value['name'], $result) === TRUE) {
                        $tmp_lon = $value['lon'];
                        $tmp_lat = $value['lat'];
                    }
                }
                if ($tmp_lon != '') {
                    array_push($lon, $tmp_lon);
                    array_push($lat, $tmp_lat);
                } else {
                    array_push($lon, null);
                    array_push($lat, null);
                }
            }

            foreach (array_slice($transposed_excelSheetData, 1) as $key => $result) {
                $color = "#" . substr(md5(rand()), 0, 6);
                $array_tot = array_sum(array_slice($result, 2));
                $current_lable = $result[0];
                ////////// get related arrays
                /// text that shows on the map
                $text = unserialize(serialize($result)); // deep copy for the result
                array_walk($text, function (&$val, $key) use ($transposed_excelSheetData) {
                    $val = ($key == 0 or $key == 1) ? $val : $transposed_excelSheetData[0][$key] . " <br>:" . $val;
                });
                /// Size of the marker that shows on the map
                $size = unserialize(serialize($result)); // deep copy for the result
                array_walk($size, function (&$val, $key) use ($scale) {
                    $val = ($key == 0 or $key == 1) ? null : $val / $scale;
                });
                /// color of the marker that shows on the map
                $colors = unserialize(serialize($result)); // deep copy for the result
                array_walk($colors, function (&$val, $key) use ($array_tot) {
                    $val = ($key == 0 or $key == 1) ? null : round(($val / $array_tot) * 100, 1);
                });

                $data['traces'][] = [
                    'type' => 'scattermapbox',
                    'name' => $result[1],
                    'locationmode' => 'Israel',
                    'lat' => array_slice($lat, 2),
                    'lon' => array_slice($lon, 2),
                    'hoverinfo' => 'text',
                    'text' => array_slice($text, 2),
                    'marker' => [
                        'size' => array_slice($size, 2),
                        'color' => array_slice($colors, 2),
                        'cmin' => 0,
                        'cmax' => 100,
                        'colorscale' => 'Blues',
                        'colorbar' => [
                            'title' => 'Per Total := ' . $array_tot,
                            'ticksuffix' => '%',
                            'showticksuffix' => 'last'
                        ],
                        'line' => [
                            'color' => 'black',
                            'width' => 2
                        ],
                        'sizemode' => 'area'
                    ]
                ];
            }

            foreach ($data['labels_years'] as $key => $result) {
                $data['steps'][] = [
                    'label' => $result,
                    'method' => 'restyle',
                    'args' => ['visible', array_map(function ($val) use ($result) {
                        return ($val == $result) ? True : false;
                    }, array_slice($excelSheetData[0], 1))]
                ];
            }
            return $data;
        } else {
            $results = $results->toArray();
            //Dd($this->geos_locations);
            $labels = array_keys($results[0]);
            // unseting the first column name which is the geo in order to get the data columns
            unset($labels[0]);
            $data['labels'] = array_values($labels);
            /// switch columns to rows
            $transposed_results = array_map(null, ...$results);
            $lon = [];
            $lat = [];
            foreach ($transposed_results[0] as $key => $result) {
                $tmp_lon = '';
                $tmp_lat = '';
                foreach ($this->geos_locations as $key => $value) {
                    if ($value['key'] == $result
                        or stripos($value['name'], $result) === TRUE) {
                        $tmp_lon = $value['lon'];
                        $tmp_lat = $value['lat'];
                    }
                }
                if ($tmp_lon != '') {
                    array_push($lon, $tmp_lon);
                    array_push($lat, $tmp_lat);
                } else {
                    array_push($lon, null);
                    array_push($lat, null);
                }
            }

            foreach (array_slice($transposed_results, 1) as $key => $result) {
                $color = "#" . substr(md5(rand()), 0, 6);
                $array_tot = array_sum($result);
                $current_lable = $data['labels'][$key];
                ////////// get related arrays
                /// text that shows on the map
                $text = unserialize(serialize($result)); // deep copy for the result
                array_walk($text, function (&$val, $key) use ($transposed_results) {
                    $val = $transposed_results[0][$key] . " <br>:" . $val;
                });
                /// Size of the marker that shows on the map
                $size = unserialize(serialize($result)); // deep copy for the result
                array_walk($size, function (&$val, $key) use ($scale) {
                    $val = $val / $scale;
                });
                /// color of the marker that shows on the map
                $colors = unserialize(serialize($result)); // deep copy for the result
                array_walk($colors, function (&$val, $key) use ($array_tot) {
                    $val = round(($val / $array_tot) * 100, 1);
                });

                $data['traces'][] = [
                    'type' => 'scattermapbox',
                    'name' => $file->title,
                    'locationmode' => 'Israel',
                    'lat' => $lat,
                    'lon' => $lon,
                    'hoverinfo' => 'text',
                    'text' => $text,
                    'marker' => [
                        'size' => $size,
                        'color' => $colors,
                        'cmin' => 0,
                        'cmax' => 100,
                        'colorscale' => 'Blues',
                        'colorbar' => [
                            'title' => 'Per Total := ' . $array_tot,
                            'ticksuffix' => '%',
                            'showticksuffix' => 'last'
                        ],
                        'line' => [
                            'color' => 'black',
                            'width' => 2
                        ],
                        'sizemode' => 'area'
                    ]
                ];
                $data['steps'][] = [
                    'label' => $data['labels'][$key],
                    'method' => 'restyle',
                    'args' => ['visible', array_map(function ($val) use ($current_lable) {
                        return ($val == $current_lable) ? True : false;
                    }, $data['labels'])]
                ];
            }
            return $data;
        }
    }

    /////////////////////////////////////////////////////////////////////////////

    public function plotly_long_map($id, $scale)
    {
        //$id = 156; // AHS_DF long 1 local wide
        $id = 158; // AHS_DF long n local wide
        $file = File::find($id);
        $readerObj;
        $excelSheetData = [];
        $excelSheet = [];

        $results = Excel::load($file->url, function ($reader) use (&$readerObj) {
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
        // get keys
        $keys = array_values($excelSheetData[0]);
        $data_row = array_slice($excelSheetData, 1);

        $idx_geokey_arr = array_values(array_unique(array_column($data_row, 0)));// geo localtions
        $idx_yearkey_arr = array_values(array_unique(array_column($data_row, 1)));// geo years
        $idx_featurekey_arr = array_values(array_unique(array_column($data_row, 2)));// feature array
        $data['labels_years'] = array_values($idx_yearkey_arr);
        $transposed_data_row = array_map(null, ...$data_row);
        //Dd($transposed_data_row);
        if (count($data_row[0]) == 3) {
            foreach ($idx_yearkey_arr as $key => $yearkey_idx) {
                $tmp = array_filter($data_row, function ($var) use ($yearkey_idx) {
                    return ($var[1] == $yearkey_idx); // filter over years
                });
                $tmp = array_values($tmp);
                $lon = [];
                $lat = [];
                $values = [];
                $text = [];
                $size = [];
                foreach ($tmp as $key => $tmp_value) {
                    ////// build long and lat arrays ////////////////////////
                    $tmp_lon = '';
                    $tmp_lat = '';
                    foreach ($this->geos_locations as $key => $value) {
                        $res = stripos($tmp_value[0], $value['name']);
                        if ($value['key'] == $tmp_value[0]
                            or $res === true) {
                            //echo '<br/>';
                            //echo 'res = '. $res . ' is the result of stripos between '. $tmp_value[0]. ' and ' .$value['name'];
                            //echo '<br/>';
                            //echo 'While this  = '. $value['key'] . ' is compare to '. $tmp_value[0];
                            //echo '<br/>';
                            $tmp_lon = $value['lon'];
                            $tmp_lat = $value['lat'];
                            array_push($lon, $tmp_lon);
                            array_push($lat, $tmp_lat);
                            //echo 'tmp_lon  has been pushed  = '. $tmp_lon . '  and also  $tmp_lat '. $tmp_lat;
                            //echo '<br/>';
                        }
                    }
                    if ($tmp_lon == '') {
                        array_push($lon, null);
                        array_push($lat, null);
                    }
                    ///// end building lat long
                    array_push($values, end($tmp_value)); // get the value
                    array_push($text, $tmp_value[0] . " <br>:" . end($tmp_value));
                }
                $array_tot = array_sum($values);
                $current_lable = $tmp_value[1];
                /// Size of the marker that shows on the map
                $size = unserialize(serialize($values)); // deep copy for the result
                array_walk($size, function (&$val, $key) use ($scale) {
                    $val = $val / $scale;
                });
                /// color of the marker that shows on the map
                $colors = unserialize(serialize($values)); // deep copy for the result
                array_walk($colors, function (&$val, $key) use ($array_tot) {
                    $val = round(($val / $array_tot) * 100, 1);
                });

                $data['traces'][] = [
                    'type' => 'scattermapbox',
                    'name' => (count($tmp_value) == 3) ? $tmp_value[1] : ((count($tmp_value) == 4) ? $tmp_value[1] . ' ' . $tmp_value[2] : $tmp_value[1]),
                    'visible' => true,
                    'locationmode' => 'Israel',
                    'lat' => $lat,
                    'lon' => $lon,
                    'hoverinfo' => 'text',
                    'text' => $text,
                    'marker' => [
                        'size' => $size,
                        'color' => $colors,
                        'cmin' => 0,
                        'cmax' => 100,
                        'colorscale' => $this->trace_colours[rand(0, 16)],
                        /*'colorbar' => [
                            'title' => 'Per Total := ' . $array_tot,
                            'ticksuffix' => '%',
                            'showticksuffix' => 'last'
                        ],*/
                        'line' => [
                            'color' => 'black',
                            'width' => 2
                        ],
                        'sizemode' => 'area'
                    ]
                ];
                $data['steps'][] = [
                    'label' => $yearkey_idx,
                    'method' => 'restyle',
                    'args' => ['visible', array_map(function ($val) use ($current_lable) {
                        return ($val == $current_lable) ? True : false;
                    }, $data['labels_years'])]
                ];
            }
            Dd($data);
            return $data;
        } else {
            /// the base will be the year and the indicator together
            $years_abed = [];
            foreach ($idx_yearkey_arr as $key => $yearkey_idx) {
                foreach ($idx_featurekey_arr as $key => $featurekey_idx) {
                    $tmp = array_values(array_filter($data_row, function ($var) use ($yearkey_idx, $featurekey_idx) {
                        return ($var[1] == $yearkey_idx && $var[2] == $featurekey_idx); // filter over years
                    }));
                    $lon = [];
                    $lat = [];
                    $values = [];
                    $text = [];
                    $size = [];
                    foreach ($tmp as $key => $tmp_value) {
                        ////// build long and lat arrays ////////////////////////
                        $tmp_lon = '';
                        $tmp_lat = '';
                        foreach ($this->geos_locations as $key => $value) {
                            $res = stripos($tmp_value[0], $value['name']);
                            if ($value['key'] == $tmp_value[0]
                                or $res === true) {
                                //echo '<br/>';
                                //echo 'res = '. $res . ' is the result of stripos between '. $tmp_value[0]. ' and ' .$value['name'];
                                //echo '<br/>';
                                //echo 'While this  = '. $value['key'] . ' is compare to '. $tmp_value[0];
                                //echo '<br/>';
                                $tmp_lon = $value['lon'];
                                $tmp_lat = $value['lat'];
                                array_push($lon, $tmp_lon);
                                array_push($lat, $tmp_lat);
                                //echo 'tmp_lon  has been pushed  = '. $tmp_lon . '  and also  $tmp_lat '. $tmp_lat;
                                //echo '<br/>';
                            }
                        }
                        if ($tmp_lon == '') {
                            array_push($lon, null);
                            array_push($lat, null);
                        }
                        ///// end building lat long
                        array_push($values, end($tmp_value)); // get the value
                        array_push($text, $tmp_value[0] . " <br>:" . end($tmp_value));
                    }
                    /////
                    $array_tot = array_sum($values);
                    $current_lable = $tmp_value[1];
                    /// Size of the marker that shows on the map
                    $size = unserialize(serialize($values)); // deep copy for the result
                    array_walk($size, function (&$val, $key) use ($scale) {
                        $val = $val / $scale;
                    });
                    /// color of the marker that shows on the map
                    $colors = unserialize(serialize($values)); // deep copy for the result
                    array_walk($colors, function (&$val, $key) use ($array_tot) {
                        $val = round(($val / $array_tot) * 100, 1);
                    });
                    // here abed left
                    array_push($years_abed, $tmp_value[1]);
                    $data['traces'][] = [
                        'type' => 'scattermapbox',
                        'name' => (count($tmp_value) == 3) ? $tmp_value[1] : ((count($tmp_value) == 4) ? $tmp_value[1] . ' ' . $tmp_value[2] : $tmp_value[1]),
                        'visible' => true,
                        'locationmode' => 'Israel',
                        'lat' => $lat,
                        'lon' => $lon,
                        'hoverinfo' => 'text',
                        'text' => $text,
                        'marker' => [
                            'size' => $size,
                            'color' => $colors,
                            'cmin' => 0,
                            'cmax' => 100,
                            'colorscale' => $this->trace_colours[rand(0, 16)],
                            /*'colorbar' => [
                                'title' => 'Per Total := ' . $array_tot,
                                'ticksuffix' => '%',
                                'showticksuffix' => 'last'
                            ],*/
                            'line' => [
                                'color' => 'black',
                                'width' => 2
                            ],
                            'sizemode' => 'area'
                        ]
                    ];
                }
            }
            /////
            foreach ($idx_yearkey_arr as $key => $yearkey_idx) {
                $data['steps'][] = [
                    'label' => $yearkey_idx,
                    'method' => 'restyle',
                    'args' => ['visible', array_map(function ($val) use ($yearkey_idx) {
                        return ($val == $yearkey_idx) ? True : false;
                    }, $years_abed)]
                ];
            }
            Dd($data['steps']);
            return $data;
        }
    } /// end plotly_long_map


    public function plotly_bubble($id)
    {
        if (isset($id)) {
            $file = File::find($id);
            /*$res = TestController::get_json_where_qry($file->file_data,'pop',[['inkey'=>'gov','invalue'=>"Jenin",'intype'=>"string"],
                                                                                            ['inkey'=>'year','invalue'=>"1997",'intype'=>"int"]]);*/
            /*$res = TestController::get_multi_json_where_qry($file->file_data,
                ['pop','gov','year'],
                [['inkey'=>'gov','invalue'=>"Jenin",'intype'=>"string"],
                ['inkey'=>'region','invalue'=>"West Bank",'intype'=>"string"]]);*/


            /*$res = TestController::get_multi_json_where_qry($file->file_data,
                ['gov','illiteracy','unemployment'],
                [['inkey'=>'region','invalue'=>"West Bank",'intype'=>gettype("West Bank")],
                    ['inkey'=>'year','invalue'=>1997,'intype'=>gettype(1997)]]);*/


            //$res = TestController::get_json_keys($file->file_data);
            //$res = TestController::get_json_dis_qry($file->file_data,'region');
            //$res = TestController::create_view($file->file_data);
            $res = TestController::get_json_order_group2_qry($file->file_data,
                                                            ['pop','gov'],
                                                            'year','region');
            /*$res = TestController::get_json_order_group1_qry($file->file_data,
                ['pop','gov'],
                'year');*/

            Dd($res);
        }
    }
///////////////////// JSON class under Test //////////////////////////////////////
    public function get_json_dis_qry($file_data,$field_name){
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $from_clause = 'from ( ';
        foreach ($datain as $key => $val){
            $from_clause = $from_clause .'SELECT '. $key .' AS n';
            if ($cnt-1 != $key){
                $from_clause = $from_clause . ' UNION ';
            };
        }
        $from_clause = $from_clause .' ) x';
        $results = DB::select('select distinct JSON_EXTRACT(:s_file_data, CONCAT("$[", x.n, "].'.$field_name.'")) AS '.$field_name.' ' .
            $from_clause .
            ' WHERE x.n < JSON_LENGTH(:w_file_data)',
            ['s_file_data' => $file_data,'w_file_data' => $file_data]);
        //$results = DB::select('select * from files where id = :id', ['id' => 165]);
        $results = array_map(function ($value) use ($field_name) {
            return str_replace('"','',$value->$field_name);
        }, $results);
        return $results;
    } // end get_json_dis_qry

    public function get_json_keys($file_data) {
        $datain = json_decode($file_data);
        $results = [];
        foreach ($datain[0] as $key => $val){
            array_push($results, $key);
        }
        return $results;
    } // end get_json_keys

    public function get_json_where_qry($file_data,$output_field,$where_fields){
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $from_clause = 'from ( ';
        foreach ($datain as $key => $val){
            $from_clause = $from_clause .'SELECT '. $key .' AS n';
            if ($cnt-1 != $key){
                $from_clause = $from_clause . ' UNION ';
            };
        }
        $from_clause = $from_clause .' ) x';

        $mapp =['s_file_data' => $file_data,'w_file_data' => $file_data];
        $where_clause = ' WHERE x.n < JSON_LENGTH(:w_file_data) ' ;
        foreach($where_fields as $key => $val_data){
                if($val_data['intype'] == 'string'){
                    $where_clause = $where_clause . ' and ' . ' JSON_EXTRACT(:w_file_data_' . $val_data['inkey'] . ', CONCAT("$[", x.n, "].' . $val_data['inkey'] . '")) = "' . $val_data['invalue'] . '" ';
                }else{
                    $where_clause = $where_clause . ' and ' . ' JSON_EXTRACT(:w_file_data_' . $val_data['inkey'] . ', CONCAT("$[", x.n, "].' . $val_data['inkey'] . '")) = ' . $val_data['invalue'] . ' ';
                }
                $mapp['w_file_data_' . $val_data['inkey']] = $file_data;
        }
        //Dd($mapp);
        //Dd(DB::getQueryLog());
        $results = DB::select('select JSON_EXTRACT(:s_file_data, CONCAT("$[", x.n, "].'.$output_field.'")) AS '.$output_field.' ' .
            $from_clause .  $where_clause,
            $mapp);
        $results = array_map(function ($value) use ($output_field) {
            return str_replace('"','',$value->$output_field);
        }, $results);

        return $results;
    } // end get_json_group_qry

    public function get_multi_json_where_qry($file_data,$output_field,$where_fields){
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $mapp =['w_file_data' => $file_data];

        DB::statement('set @rownum:=0;');
        $select_clause = 'select @rownum:=(@rownum+1) AS num ';
        foreach ($output_field as $key => $val){
            $select_clause = $select_clause . ' , JSON_EXTRACT(:s_file_data_' . $key . ', CONCAT("$[", x.n, "].'.$val.'")) AS '.$val.' ';
            $mapp['s_file_data_' . $key] = $file_data;

        }
        $from_clause = 'from ( ';
        foreach ($datain as $key => $val){
            $from_clause = $from_clause .'SELECT '. $key .' AS n';
            if ($cnt-1 != $key){
                $from_clause = $from_clause . ' UNION ';
            };
        }
        $from_clause = $from_clause .' ) x';

        $where_clause = ' WHERE x.n < JSON_LENGTH(:w_file_data) ' ;
        foreach($where_fields as $key => $val_data){
            if($val_data['intype'] == 'string'){
                $where_clause = $where_clause . ' and ' . ' JSON_EXTRACT(:w_file_data_' . $val_data['inkey'] . ', CONCAT("$[", x.n, "].' . $val_data['inkey'] . '")) = "' . $val_data['invalue'] . '" ';
            }else{
                $where_clause = $where_clause . ' and ' . ' JSON_EXTRACT(:w_file_data_' . $val_data['inkey'] . ', CONCAT("$[", x.n, "].' . $val_data['inkey'] . '")) = ' . $val_data['invalue'] . ' ';
            }
            $mapp['w_file_data_' . $val_data['inkey']] = $file_data;
        }
        //Dd($mapp);
        //Dd(DB::getQueryLog());
        $results = DB::select( $select_clause.
            $from_clause .  $where_clause,
            $mapp);
        $out_res = [];
        foreach ($output_field as $key => $val) {
            $tmp_res = array_map(function ($value) use ($val) {
                return str_replace('"', '', $value->$val);
            }, $results);
            array_push($out_res,$tmp_res);
        }
        return $out_res;
    } // end get_multi_json_where_qry





    public function create_view($file_data){
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $output_field = TestController::get_json_keys($file_data);

        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_clause = 'select rownum() AS num ';
        foreach ($output_field as $key => $val){
            $select_clause = $select_clause . ' , JSON_EXTRACT(p2(), CONCAT("$[", x.n, "].'.$val.'")) AS '.$val.' ';
            $mapp['s_file_data_' . $key] = $file_data;

        }
        $from_clause = 'from ( ';
        foreach ($datain as $key => $val){
            $from_clause = $from_clause .'SELECT '. $key .' AS n';
            if ($cnt-1 != $key){
                $from_clause = $from_clause . ' UNION ';
            };
        }
        $from_clause = $from_clause .' ) x';

        $where_clause = ' WHERE x.n < JSON_LENGTH(p2()) ' ;

        $results = DB::statement('CREATE OR REPLACE VIEW json_view AS ' . $select_clause.
            $from_clause .  $where_clause);

        return $results;
    } // end createview



    public function get_json_order_group2_qry($file_data,$output_field,$group_field1,$group_field2){
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = $group_field1 .',' .$group_field2;
        $voutput_field[] = $group_field1;
        $voutput_field[] = $group_field2;
        foreach ($output_field as $key => $val){
            $select_str = $select_str . ', GROUP_CONCAT(' . $val .') as ' . $val;
            $voutput_field[] = $val;
        }
        $results = DB::table('json_abdo_view')
            ->select(DB::raw($select_str))
            ->groupBy($group_field1,$group_field2)
            ->orderBy($group_field1,'asc')
            ->orderBy($group_field2,'asc')
            ->get()->toArray();
        /*$out_res = [];
        foreach ($voutput_field as $key => $val) {
            $tmp_res = array_map(function ($value) use ($val) {
                return str_replace('"', '', $value->$val);
            }, $results);
            $out_res[$val] = $tmp_res;
            //array_push($out_res,$tmp_res);
        }*/
        return $results;
    }//get_json_order_group2_qry


    public function get_json_order_group1_qry($file_data,$output_field,$group_field1){
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = $group_field1;
        $voutput_field[] = $group_field1;
        foreach ($output_field as $key => $val){
            $select_str = $select_str . ', GROUP_CONCAT(' . $val .') as ' . $val;
            $voutput_field[] = $val;
        }
        $results = DB::table('json_abdo_view')
            ->select(DB::raw($select_str))
            ->groupBy($group_field1)
            ->orderBy($group_field1,'asc')
            ->get()->toArray();
        /*$out_res = [];
        foreach ($voutput_field as $key => $val) {
            $tmp_res = array_map(function ($value) use ($val) {
                return str_replace('"', '', $value->$val);
            }, $results);
            $out_res[$val] = $tmp_res;
            //array_push($out_res,$tmp_res);
        }
        return $out_res;*/
        return $results;
    }//get_json_order_group1_qry




}
