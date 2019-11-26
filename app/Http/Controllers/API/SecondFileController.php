<?php

namespace App\Http\Controllers\API;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dataset as DatasetResource;

class SecondFileController extends Controller
{

    protected $geos_locations;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->geos_locations = array(
            ["name" => "Jenin", "key" => "1101", "lat" => "32.4572845", "lon" => "35.2847044"],
            ["name" => "Tubas", "key" => "1105", "lat" => "32.3211033", "lon" => "35.3611982"],
            ["name" => "Tulkarm", "key" => "1110", "lat" => "32.3079653", "lon" => "35.0111189"],
            ["name" => "Qalqilya", "key" => "1120", "lat" => "32.1960324", "lon" => "34.9727582"],
            ["name" => "Nablus", "key" => "1115", "lat" => "32.2243446", "lon" => "35.2301697"],
            ["name" => "Salfit", "key" => "1125", "lat" => "32.0851114", "lon" => "35.1720772"],
            ["name" => "Jericho", "key" => "1235", "lat" => "31.8595075", "lon" => "35.4469982"],
            ["name" => "Ramallah", "key" => "1230", "lat" => "31.9073861", "lon" => "35.1883724"],
            ["name" => "Jerusalem", "key" => "1240", "lat" => "31.7964453", "lon" => "35.1053187"],
            ["name" => "Bethlehem", "key" => "1345", "lat" => "31.7053996", "lon" => "35.1936877"],
            ["name" => "Hebron", "key" => "1350", "lat" => "31.5325865", "lon" => "35.0910712"],
            ["name" => "Khan Younis", "key" => "2470", "lat" => "31.3462181", "lon" => "34.2952438"],
            ["name" => "Deir Al Balah", "key" => "2465", "lat" => "31.4171565", "lon" => "34.3421762"],
            ["name" => "Rafah", "key" => "2475", "lat" => "31.2967975", "lon" => "34.2347272"],
            ["name" => "Gaza", "key" => "2413", "lat" => "31.5017126", "lon" => "34.4580897"],
            ["name" => "North Gaza", "key" => "2455", "lat" => "31.5513065", "lon" => "34.5004672"]
            //,["name" => "Palestine", "key" => "pse", "lat" => "31.7964453", "lon" => "35.1053187"],
            //["name" => "West Bank", "key" => "1", "lat" => "31.7964453", "lon" => "35.1053187"],
            //["name" => "Gaza Strip", "key" => "2", "lat" => "31.5017126", "lon" => "34.4580897"]
        );

        $this->trace_colours =['Blackbody',
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

    public function plotly_map($id,$scale)
    {
        if (isset($id)) {
            $file = File::find($id);
            if ($file->dformat == 1) {
                $results = SecondFileController::plotly_wide_map($id,$scale);
                return $results;
            }
            // Abdullrahman elHayek -- I added this code to change format from long to wide.
            if ($file->dformat == 2) { // narrow format
                $results = SecondFileController::plotly_long_map($id, $scale);
                return $results;
            }
        }
    }


    public function plotly_wide_map($id,$scale)
    {
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
            $data['labels_indicators'] = array_values(array_filter($excelSheetData[1]));
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
            $data['labels_geos'] = array_values(array_filter($transposed_excelSheetData[0]));
            $lon = [];
            $lat = [];
            $newtrans = [];
            foreach ($transposed_excelSheetData[0] as $key => $result) {
                $tmp_lon ='';
                $tmp_lat ='';
                $tmptrans = [];
                foreach ($this->geos_locations as $geokey => $value) {
                    $res = stripos(SecondFileController::clean($result),SecondFileController::clean($value['name']));
                    //dd($res);
                    if ($value['key'] == $result
                        or (isset($res) and $res === 0)) {
                        $tmp_lon =$value['lon'];
                        $tmp_lat =$value['lat'];
                        array_push($lon, $tmp_lon);
                        array_push($lat, $tmp_lat);
                        foreach ($transposed_excelSheetData as $crosscheckkey => $crosscheckresult) {
                            $tmptrans[] = $transposed_excelSheetData[$crosscheckkey][$key];
                        }
                        //Dd($tmptrans);
                        array_push($newtrans, $tmptrans);
                    }
                }
            }
            $transposed_excelSheetData = array_map(null, ...$newtrans); //15
            $loopedtransposed_excelSheetData = array_values(array_slice($transposed_excelSheetData, 1));
             //Dd($transposed_excelSheetData);
            $headIndicator = array_slice($excelSheetData[1],1);
            $headyear= array_slice($excelSheetData[0],1);
            //Dd($headyear);
            //Dd(SecondFileController::clean('-'));
            foreach ($loopedtransposed_excelSheetData as $key => $result) {
                $color = "#" . substr(md5(rand()), 0, 6);
                $array_tot = (array_sum($result) == 0 ? 1 : array_sum($result));
                array_walk($result, function (&$val, $key){
                    $val = SecondFileController::clean($val);
                });
                //$current_lable = $transposed_excelSheetData[0][$key];
                ////////// get related arrays
                /// text that shows on the map
                //$result = array_slice($result,2);
                $text = unserialize(serialize($result)); // deep copy for the result
                //$text = array_slice($text,2);
                $s_transposed_excelSheetData = $transposed_excelSheetData[0];
                array_walk($text, function (&$val, $key) use ($s_transposed_excelSheetData) {
                    $val = $s_transposed_excelSheetData[$key] . " <br>:" . $val;
                });
                //Dd($text);
                //$text = array_values(array_filter($text));
                /// Size of the marker that shows on the map
                $size = unserialize(serialize($result)); // deep copy for the result
                array_walk($size, function (&$val, $key) use ($scale) {
                    $val = SecondFileController::clean($val)/$scale;
                });

                /// color of the marker that shows on the map
                $colors = unserialize(serialize($result)); // deep copy for the result
                array_walk($colors, function (&$val, $key) use ($array_tot) {
                    $val = round((SecondFileController::clean($val) / $array_tot) * 100, 1);
                });
                //Dd($size);


                $data['traces'][] = [
                    'type' => 'scattermapbox',
                    'name' => $headyear[$key].' '.$headIndicator[$key],
                    'visible'=>false,
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
                        'colorscale' => $this->trace_colours[rand(0,16)],
                        /*'colorbar' => [
                            //'title' => 'Per Total := ' . $array_tot,
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
            //Dd(array_slice($excelSheetData[0],1));

            foreach ( $data['labels_years'] as $key => $result) {
                $data['steps'][] = [
                    'label' => $result,
                    'method' => 'restyle',
                    'args' => ['visible', array_map(function ($val) use ($result) {
                        return ($val == $result) ? True : false;
                    }, array_slice($excelSheetData[0],1))]
                ];
            }

            $current_lable = $data['labels_years'][0];
            foreach ($data['traces'] as $key => $result) {
                $res = stripos('X.'.$result['name'],'.'.$current_lable);
                //echo '<br/>','res = ' . $res . 'is the result of string matche between '. (string)$result['name'].' and '.(string)$current_lable,'<br/>';
                if ($res == 1){
                    $data['traces'][$key]['visible'] = true;
                }
            }
            return $data;
        } else {
            $results = $results->toArray();
            //Dd($this->geos_locations);
            $labels = array_keys($results[0]);
            // unseting the first column name which is the geo in order to get the data columns
            unset($labels[0]);
            $data['labels_years'] = array_values($labels);
            /// switch columns to rows
            $transposed_results = array_map(null, ...$results);
            $data['labels_geos'] = array_values(array_filter($transposed_results[0]));
            $lon = [];
            $lat = [];
            foreach ($transposed_results[0] as $key => $result) {
                $tmp_lon ='';
                $tmp_lat ='';
                foreach ($this->geos_locations as $key => $value) {
                    $res = stripos(SecondFileController::clean($result),SecondFileController::clean($value['name']));
                    //dd($res);
                    if ($value['key'] == $result
                        or (isset($res) and $res === 0)) {
                        //echo 'res = '. $res . ' is the result of stripos between '. $result. ' and ' .$value['name'];
                        //echo '<br/>';
                        //echo 'While this  = '. $value['key'] . ' is compare to '. $result;
                        //echo '<br/>';
                        $tmp_lon =$value['lon'];
                        $tmp_lat =$value['lat'];
                        array_push($lon, $tmp_lon);
                        array_push($lat, $tmp_lat);

                        //echo 'Lat value  = '. $tmp_lat . '  while lon value '. $tmp_lon;
                        //echo '<br/>';
                    }
                    /*else if ((isset($res) and $res === 0)
                         or SecondFileController::clean($value['name']) == SecondFileController::clean($result)
                         ){
                        echo 'res = '. $res . ' is the result of stripos between '. $result. ' and ' .$value['name'];
                        echo '<br/>';
                        echo 'lon = '. $value['lon'];
                        echo '<br/>';
                        echo 'lat = '. $value['lat'];
                        echo '<br/>';
                        $tmp_lon =$value['lon'];
                        $tmp_lat =$value['lat'];
                        array_push($lon, $tmp_lon);
                        array_push($lat, $tmp_lat);
                    }*/
                }
                //Dd($lon);
                /*if ($tmp_lon == '') {
                    array_push($lon, null);
                    array_push($lat, null);
                }*/
            }
            /*echo 'done building lan lot';
            echo '<br/>';
            Dd($lon);*/

            foreach (array_slice($transposed_results, 1) as $key => $result) {
                $color = "#" . substr(md5(rand()), 0, 6);
                $array_tot = (array_sum($result) == 0 ? 1 : array_sum($result));
                array_walk($result, function (&$val, $key){
                    $val = SecondFileController::clean($val);
                });
                $current_lable = $data['labels_years'][$key];
                ////////// get related arrays
                /// text that shows on the map
                /// Abed
                $text = unserialize(serialize($result)); // deep copy for the result
                array_walk($text, function (&$val, $key) use ($transposed_results) {
                    $val = ($transposed_results[0][$key] != '1' and $transposed_results[0][$key] != '2' and $transposed_results[0][$key] != 'pse')?$transposed_results[0][$key] . " <br>:" . $val:null;
                });
                $text = array_values(array_filter($text));
                //Dd($transposed_results);
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
                    'name' => $current_lable,
                    'visible'=>true,
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
                        'colorscale' => $this->trace_colours[rand(0,16)],
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
                    'label' => $data['labels_years'][$key],
                    'method' => 'restyle',
                    'args' => ['visible', array_map(function ($val) use ($current_lable) {
                        return ($val == $current_lable) ? True : false;
                    }, $data['labels_years'])]
                ];
            }

            $current_lable = $data['labels_years'][0];
            foreach ($data['traces'] as $key => $result) {
                if ( $current_lable != $result['name']){
                    $data['traces'][$key]['visible'] = false;
                }
            }
            return $data;
        }
    }

    /////////////////////////////////////////////////////////////////////////////

    public function plotly_long_map($id, $scale)
    {
        //$id = 156; // AHS_DF long 1 local wide
        //$id = 158; // AHS_DF long n local wide
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
        $data['labels_geos'] = $idx_geokey_arr;
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
                        $res = stripos(SecondFileController::clean($tmp_value[0]),SecondFileController::clean($value['name']));
                        //dd($res);
                        if ($value['key'] == $tmp_value[0]
                            or (isset($res) and $res === 0)) {
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
                    /*if ($tmp_lon == '') {
                        array_push($lon, null);
                        array_push($lat, null);
                    }*/
                    if ($tmp_value[0] != '1' and $tmp_value[0] != '2' and $tmp_value[0] != 'pse'){
                        ///// end building lat long
                        array_push($values, end($tmp_value)); // get the value
                        array_push($text, $tmp_value[0] . " <br>:" . end($tmp_value));
                    }
                }
                $array_tot = (array_sum($values) == 0 ? 1 : array_sum($values));
                array_walk($values, function (&$val, $key){
                    $val = SecondFileController::clean($val);
                });
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
            //abed
            $current_lable = $data['labels_years'][0];
            foreach ($data['traces'] as $key => $result) {
                if ( $current_lable != $result['name']){
                    $data['traces'][$key]['visible'] = false;
                }
            }
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
                            $res = stripos(SecondFileController::clean($tmp_value[0]),SecondFileController::clean($value['name']));
                            //dd($res);
                            if ($value['key'] == $tmp_value[0]
                                or (isset($res) and $res === 0)) {
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
                        /*if ($tmp_lon == '') {
                            array_push($lon, null);
                            array_push($lat, null);
                        }*/
                        ///// end building lat long
                        if ($tmp_value[0] != '1' and $tmp_value[0] != '2' and $tmp_value[0] != 'pse'){
                            ///// end building lat long
                            array_push($values, end($tmp_value)); // get the value
                            array_push($text, $tmp_value[0] . " <br>:" . end($tmp_value));
                        }
                    }
                    /////
                    $array_tot = (array_sum($values) == 0 ? 1 : array_sum($values));
                    array_walk($values, function (&$val, $key){
                        $val = SecondFileController::clean($val);
                    });
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
            //abed
            $current_lable = $idx_yearkey_arr[0];
            foreach ($data['traces'] as $key => $result) {
                if ( $current_lable != $result['name']){
                    $data['traces'][$key]['visible'] = false;
                }
            }
            return $data;
        }
    } /// end plotly_long_map
    ///
    ///
    public function clean($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.

        $string = strtolower($string);

        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        //echo '$string =' . $string, '<br/>';

        if (isset($string) and $string != ''){
            return $string;
        }else {
            return 0;
        }

        //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}