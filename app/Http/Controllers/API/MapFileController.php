<?php

namespace App\Http\Controllers\API;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use App\Governorate;
use Session;
use App\Http\Controllers\API\JSonFileController;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dataset as DatasetResource;
use App;
use Lang;

class MapFileController extends Controller
{
    protected $JsonController;
    protected $geos_locations;

    public function __construct()
    {
        $this->JsonController = new JSonFileController();
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
            ["name" => "North Gaza", "key" => "2455", "lat" => "31.5513065", "lon" => "34.5004672"],
            ["name" => "Unknown", "key" => "0", "lat" => "31.5513065", "lon" => "34.5004672"]
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

    public function plotly_map(Request $request)
    {
        $input = $request->all();
        $fagg = [];
        $fbase = [];
        $id = null;
        $scale = 0;
        $fdim = null;
        $alertlang = 'en';
        $years_fields = [];
        if (!empty($input['lang'])) {
            $alertlang =  $input['lang'];
        }
        if (!empty($input['fbase'])) {
            $fbase =  $input['fbase'];
        }
        if (!empty($input['fagg'])) {
            $fagg =  $input['fagg'];
        }
        if (!empty($input['file_id'])) {
            $id =  $input['file_id'];
        }
        if (!empty($input['scale'])) {
            $scale =  $input['scale'];
        }
        if (!empty($input['fdim'])) {
            $fdim =  $input['fdim'];
        }
        if (!empty($input['years_fields'])) {
            $years_fields =  $input['years_fields'];
        }
        if (isset($id)) {
            $file = File::find($id);
            $lang = (empty($file->language))?'en':$file->language;
            $res = MapFileController::get_map_payload($id,$file->file_data_text,$scale,$fdim,$fagg,$fbase,$lang,$alertlang,$years_fields);
            return $res;
        }
    }

    public function get_map_payload($file_id,$file_data,$scale,$fdim,$fagg,$fbase,$lang,$alertlang,$years_fields)
    {
        // set locality for the user messages
        App::setLocale($alertlang);
        // check for base
        if(empty($fbase)){
            $data['msg'] = [
                'msg_code' => 2,
                'msg_text' => Lang::get('common.colorbyerror')
            ];
            return $data;
        }
        ///////////////////////////////// new map code /////////////////////////////////////////
        if(!isset($file_data)){
            $data['msg'] = [
                'msg_code' => 2,
                'msg_text' => Lang::get('common.filenotsaved')
            ];
            return $data;
        }
        $data = [];
        $scale = ($scale == 0)?1:$scale;
        $this->JsonController->setLanguage($lang);
        //$create_view = $this->JsonController->create_view($file_data,$file_id. '_map_vw');
        $headers = $this->JsonController->get_json_keys($file_data);
        $heades_cnt = count($headers)-1; // excule the uid column
        $fagg_test = null;
        $aggr_headers = array_values(array_filter($headers, function ($key) use ($heades_cnt){
            return ($key === 1 || $key === 2 && $heades_cnt > 3); // filter over years
        },ARRAY_FILTER_USE_KEY));
        //Dd($aggr_headers); work from here
        if (isset($fbase) && !empty($fbase)) {
            $aggr_headers = [];
            $aggr_headers[0] = 'year';
            $aggr_headers = array_unique(array_merge($aggr_headers, $fbase));
        }
        /// check if geo exists
        $geo_arr = array_values(array_filter($headers, function ($val,$key) use ($heades_cnt){
            return (stripos(MapFileController::clean_str($val),MapFileController::clean_str('geo')) === 0 ||
                stripos(MapFileController::clean_str($val),MapFileController::clean_str('gov')) === 0 ); // filter over years
        },ARRAY_FILTER_USE_BOTH));

        if (empty($geo_arr)){
            $data['msg'] = [
                'msg_code' => 2,
                'msg_text' => Lang::get('common.geoerror')
            ];
            return $data;
        }

        if (isset($fagg)) {
            $fagg_test= $this->JsonController->extract_fagg_params($fagg);
        }
        $cal_headers = array_values(array_filter($headers, function ($key)  use ($heades_cnt){
            return ($key !== 1 && $key !== 2 && $heades_cnt > 3); // filter over other things
        },ARRAY_FILTER_USE_KEY));
        //$years = $this->JsonController->get_json_dis_qry($file_data,$aggr_headers[0]);
        $create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
        $years = $this->JsonController->get_json_dis_qry2($file_id. '_vw','year');
        //// fill the years according to charttype
        //$years = $this->JsonController->fill_missing_years($years);
        //$years_fields = (empty($years_fields)) ? $years_fields : $this->JsonController->fill_missing_years($years_fields);
        sort($years);

        sort($years_fields);
        $years =  (empty($years_fields))? $years : ((count($years_fields) == 1 && !empty($years_fields))? [end($years_fields),end($years_fields)]:$years_fields);


        $labels = $cal_headers;


        if (!isset($fdim) && empty($fdim) ){
            if ($heades_cnt < 4 ) {
                $data['msg'] = [
                    'msg_code' => 2,
                    'msg_text' => Lang::get('common.dimerror')
                ];
                return $data;
            }
            if ($heades_cnt == 4 ){
                $data['labels'] = [
                    'x' => $labels[1],
                    'y' => $labels[1],
                    'z' => $labels[1]
                ];
            }elseif($heades_cnt > 4){
                $data['labels'] = [
                    'x' => $labels[1],
                    'y' => $labels[2],
                    'z' => ($heades_cnt == 5)? $labels[2] : $labels[3]
                ];
            }
        }else {
            $data['labels'] = [
                'x' => $fdim['X'],
                'y' => $fdim['Y'],
                'z' => $fdim['Z']
            ];
            //$labels[0] = 'gov';
            if(empty($labels)){
                $labels = array_values($data['labels']);
            }
            //Dd($labels);
        }
        //// build trace payload for the first line
        $year_val = $years[0]; // for the first year only
        //$create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
        if(isset($fbase) && !empty($fbase)) {
            $totres = $this->JsonController->get_json_where_groupN_qry($file_id. '_vw',$file_data,
                $labels, $aggr_headers, $fagg_test); //null if there is no $fagg_test
        }else{
            if($heades_cnt > 4) {
                $totres = $this->JsonController->get_json_order_group2_qry($file_id. '_vw',$file_data,
                    $labels, $aggr_headers[0], $aggr_headers[1]);
            }else{
                $totres = $this->JsonController->get_json_order_group2_qry($file_id. '_vw',$file_data,
                    $labels, $aggr_headers[0], $aggr_headers[1]);
            }
        }
        if (empty($totres)) {
            $data['msg'] = [
                'msg_code' => 2,
                'msg_text' => Lang::get('common.colorbyerror')
            ];
            return $data;
        }
        //////////////////////////////////////////////////////// old bubble code ///////////////
        // get file header
        foreach($totres as $key=>$totres_val){
            $totres_val = json_decode(json_encode($totres_val), true); // change the inner StdClass to Array
            if ($totres_val[$aggr_headers[0]]  ==  $year_val){
                //Dd($totres_val);
                $geo_cord= MapFileController::get_map_coordinations($totres_val[$geo_arr[0]],$lang); // geo has to be fixed for locations
                $values = unserialize(serialize(explode(',',$totres_val[$data['labels']['z']])));
                $array_tot = (array_sum($values) == 0 ? 1 : array_sum($values));
                array_walk($values, function (&$val, $key){
                    $val = MapFileController::clean($val);
                });
                $size = unserialize(serialize($values)); // deep copy for the result
                array_walk($size, function (&$val, $key) use ($scale) {
                    $val = MapFileController::clean($val)/$scale;
                });
                $text = unserialize(serialize($geo_cord['name'])); // deep copy for the result
                $text_data = explode(',',$totres_val[$data['labels']['z']]);
                $text_property = $data['labels']['z'];
                array_walk($text, function (&$val, $key) use ($text_data,$text_property) {
                    $val = $val. " <br> " . $text_property.":" . $text_data[$key];
                });
                if ($data['labels']['x'] == 'num') {
                    $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                }else {
                    $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                }
                /// adjust the traces
                /// color of the marker that shows on the map
                $colors = unserialize(serialize($values)); // deep copy for the result
                array_walk($colors, function (&$val, $key) use ($array_tot) {
                    $val = round(($val / $array_tot) * 100, 1);
                });
                $data['traces'][] = [
                    'type' => 'scattermapbox',
                    'name' => $totres_val[$aggr_headers[1]],
                    'visible' => true,
                    'locationmode' => 'Israel',
                    'lat' => $geo_cord['lat'],
                    'lon' => $geo_cord['lon'],
                    'hoverinfo' => 'text',
                    'text' => $text,
                    'marker' => [
                        'size' => $size,
                        //'color' => $colors,
                        //'cmin' => 0,
                        //'cmax' => 100,
                        //'colorscale' => $this->trace_colours[rand(0, 16)],
                        'line' => [
                            'color' => 'black',
                            'width' => 2
                        ],
                        'sizemode' => 'area'
                    ]
                ];
            }
        }
        /// save point
        ///// build the slider steps sliderSteps
        foreach($years as $key=>$year_val){
            $data['sliderSteps'][] = [
                'method' => 'animate',
                'label' => $year_val,
                'args'=>[
                    [$year_val],
                    [
                        'mode' => 'immediate',
                        'transition' => ['duration'=>300],
                        'frame' => ['duration'=>300,'redraw'=>false]
                    ]
                ]
            ];
        }
        /////
        ///         /// build the frames
        foreach($years as $key=>$year_val){
            $frames_data = [];
            foreach($totres as $key=>$totres_val){
                $totres_val = json_decode(json_encode($totres_val), true); // change the inner StdClass to Array
                if ($totres_val[$aggr_headers[0]]  ==  $year_val){
                    $geo_cord= MapFileController::get_map_coordinations($totres_val[$geo_arr[0]],$lang); // geo has to be fixed for locations
                    //Dd($geo_cord);
                    $values = unserialize(serialize(explode(',',$totres_val[$data['labels']['z']])));
                    $array_tot = (array_sum($values) == 0 ? 1 : array_sum($values));
                    array_walk($values, function (&$val, $key){
                        $val = MapFileController::clean($val);
                    });
                    $size = unserialize(serialize($values)); // deep copy for the result
                    //echo 'size before','<br/>';
                    //print_r($size);
                    //echo '<br/>';
                    array_walk($size, function (&$val, $key) use ($scale) {
                        $val = MapFileController::clean($val)/$scale;
                    });

                    $text = unserialize(serialize($geo_cord['name'])); // deep copy for the result
                    $text_data = explode(',',$totres_val[$data['labels']['z']]);
                    $text_property = $data['labels']['z'];
                    array_walk($text, function (&$val, $key) use ($text_data,$text_property) {
                        $val = $val. " <br> " . $text_property.":" . $text_data[$key];
                    });

                    if ($data['labels']['x'] == 'num') {
                        $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                    }else {
                        $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                    }

                    $colors = unserialize(serialize($values)); // deep copy for the result
                    array_walk($colors, function (&$val, $key) use ($array_tot) {
                        $val = round(($val / $array_tot) * 100, 1);
                    });

                    $frames_data[] = [
                        'type' => 'scattermapbox',
                        'id' => $totres_val[$aggr_headers[1]],
                        'name' => $totres_val[$aggr_headers[1]],
                        'visible' => true,
                        'locationmode' => 'Israel',
                        'lat' => $geo_cord['lat'],
                        'lon' => $geo_cord['lon'],
                        'hoverinfo' => 'text',
                        'text' => $text,
                        'marker' => [
                            'size' => $size,
                            //'color' => $colors,
                            'cmin' => 0,
                            'cmax' => 100,
                            //'colorscale' => $this->trace_colours[rand(0, 16)],
                            'line' => [
                                'color' => 'black',
                                'width' => 2
                            ],
                            'sizemode' => 'area'
                        ]
                    ];
                }
            }
            $data['frames'][] = [
                'name' => $year_val,
                'data' => $frames_data
            ];
        }
        $data['msg'] = [
            'msg_code' => 1,
            'msg_text' => 'request served succesfully'
        ];
        $data['style_load'] = [
            'style' => ($lang == 'en')?'mapbox://styles/pmaoque/cjvnmbu4v03c51dp9ztq1vfnw':'mapbox://styles/pmaoque/cjvnm9c5w01o71cptm2xe655j', // mapbox://styles/pmaoque/cjvnm9c5w01o71cptm2xe655j basic is the default
            'accesstoken'=> 'pk.eyJ1IjoicG1hb3F1ZSIsImEiOiJjanZpMHNnNGowMHlvM3lxbHA3ZWdodzlyIn0.6m3CU9tWBXh1Jt7xMRYxOw'
        ];
        //Dd($data['frames']);
        //$drop_view = $this->JsonController->drop_view($file_id. '_map_vw');
        return $data;
    }

    public function clean($string) {
        $string = round(floatval($string),2);

        /* $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
         $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.

         $string = strtolower($string);

         $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

         //echo '$string =' . $string, '<br/>';*/

        if (isset($string) and $string != ''){
            return $string;
        }else {
            return 0;
        }

        //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function clean_str($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace('"', '', $string); // Replaces all spaces with hyphens.

        $string = strtolower($string);

        //$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        //echo '$string =' . $string, '<br/>';

        if (isset($string) and $string != ''){
            return $string;
        }else {
            return 0;
        }

        //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function stdv($arr){
        reset($arr);
        $first_key = key($arr);
        $arr = $arr[$first_key];
        $fMean = array_sum($arr) / count($arr);
        return round(sqrt(array_sum(array_map(function ($x) use ($fMean) {
                return pow($x - $fMean, 2);
            }, $arr)) / count($arr)),2);
    }


    public function get_map_coordinations($geo_val,$lang){
        $geo_arr = unserialize(serialize(explode(',',$geo_val))); // deep copy for the result
        $res = [];
        $reslon = '';
        $reslat = '';
        $resname = '';
        $govs = Governorate::where('language','=',$lang)
            ->get(['governorates.title AS name', 'governorates.geo_code AS key','governorates.latitude AS lat', 'governorates.longitude AS lon'])
            ->toArray();
        foreach ($geo_arr as $geokey => $geovalue) {
            foreach ($govs as $key => $value) {
                $resstr = stripos(MapFileController::clean_str($geovalue),MapFileController::clean_str($value['name']));
                //print('key =' . $value['key'] .' $geovalue =' . MapFileController::clean_str($geovalue) . ' name ='.MapFileController::clean_str($value['name']).' $resstr =' . $resstr);
                //print ('<br/>');
                //die();
                if ($value['key'] == $geovalue
                    or (isset($resstr) and $resstr === 0)) {
                    $reslon = $value['lon'];
                    $reslat = $value['lat'];
                    $resname = $value['name'];
                }
            }
            if (isset($reslat) && isset($reslon)){
                $res['lon'][] = $reslon;
                $res['lat'][] = $reslat;
                $res['name'][] = $geovalue;
            }else{
                $res['lon'][] = $this->geos_locations[16].lon;
                $res['lat'][] = $this->geos_locations[16].lat;
                $res['name'][] = 'unknown';
            }
        }
        return $res;
    }//get_map_coordinations
}