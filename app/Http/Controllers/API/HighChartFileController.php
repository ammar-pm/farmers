<?php

namespace App\Http\Controllers\API;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use Session;
use App\Http\Controllers\API\JSonFileController;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dataset as DatasetResource;
use App;
use Lang;

class HighChartFileController extends Controller
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

    public function highchart(Request $request)
    {
        $input = $request->all();
        $fagg = [];
        $fbase = [];
        $id = null;
        $scale = 0;
        $fdim = null;
        $charttype = '';
        $alertlang = 'en';
        $years_fields = [];
        if (!empty($input['lang'])) {
            $alertlang =  $input['lang'];
        }
        if (!empty($input['charttype'])) {
            $charttype =  $input['charttype'];
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
            $res = HighChartFileController::get_highchart_payload($id,$file->file_data_text,null,$fdim,$fagg,$fbase,$charttype,$lang,$alertlang,$years_fields);
            return $res;
        }
    }

    public function get_highchart_payload($file_id,$file_data,$scale,$fdim,$fagg,$fbase,$charttype,$lang,$alertlang,$years_fields)
    {
        // set locality for the user messages
        App::setLocale($alertlang);
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
        //$create_view = $this->JsonController->create_view($file_data,$file_id. '_highchart_vw');
        $this->JsonController->setLanguage($lang);
        $headers = $this->JsonController->get_json_keys($file_data);
        $heades_cnt = count($headers)-1; // excule the uid column
        $fagg_test = null;
        $aggr_headers = array_values(array_filter($headers, function ($value,$key) use ($heades_cnt){
            return ($value === 'year'); // filter over years
        },ARRAY_FILTER_USE_BOTH));
        ///////////////// get all cat headers for base catgeorization
        $file = File::find($file_id);
        $file_data_text = $this->JsonController->get_json_first_row_qry2($file_id.'_vw');
        $header = array_map(function ($value){
            return is_numeric($value);
        }, $file_data_text);
        $header_dim = array_filter($header, function($x,$key) { return $x!=1 && $key!=='uid';},ARRAY_FILTER_USE_BOTH);
        $all_aggr_headers = array_keys($header_dim);
        /////////////////////////////////////////////////////////////////////////////////////
        //Dd($all_aggr_headers); //work from here
        if (isset($fbase) && !empty($fbase)) {
            $aggr_headers = $fbase;
            $aggr_diff = array_diff($all_aggr_headers,$aggr_headers);
            $aggr_headers = $all_aggr_headers;
            ///Dd($aggr_diff);
            /// My idea is find the missing element by which the base should be aggregated
        }else{
            $aggr_headers = $all_aggr_headers;
        }
        //if (isset($fagg)) {
        $fagg_test= $this->JsonController->extract_fagg_params($fagg);
        //}
        $cal_headers = array_values(array_filter($headers, function ($value,$key)  use ($heades_cnt){
            return ( $value !== 'year'  && $value !== 'uid'); // filter over other things && $heades_cnt > 3
        },ARRAY_FILTER_USE_BOTH));
        //$years = $this->JsonController->get_json_dis_qry($file_data,'year');
        $create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
        $years = $this->JsonController->get_json_dis_qry2($file_id. '_vw','year');
        //// fill the years according to charttype
        $years = ($charttype != 'line') ? $years : $this->JsonController->fill_missing_years($years);
        $years_fields = (empty($years_fields)) ? $years_fields : (( $charttype != 'line' ) ? $years_fields : $this->JsonController->fill_missing_years($years_fields));
        ///////
        sort($years);
        sort($years_fields);
        $years =  (empty($years_fields))?$years : $years_fields;
        //Dd($years);

        //Dd($years);

        $labels = $cal_headers;

        if (!isset($fdim) && empty($fdim)){
                $data['msg'] = [
                    'msg_code' => 2,
                    'msg_text' => Lang::get('common.xdimerror')
                ];
                return $data;
        }

        if (!isset($fdim)){
            if ($heades_cnt <= 4 ){
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
                $labels = array_values($fdim);
            }
            //Dd($labels);
        }
        //// build trace payload for the first line
        //if(isset($fbase) && !empty($fbase)) {
        //$create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
        $totres = $this->JsonController->get_json_where_groupN2_qry($file_id. '_vw',$file_data,
            $labels, $aggr_headers, $fagg_test,$years_fields); //null if there is no $fagg_test
        /*}else{
            $aggr_headers = [$labels[0]];
            $labels = [$labels[1]];
            $totres = $this->JsonController->get_json_where_groupN2_qry($file_data,
                $labels, $aggr_headers,$fagg_test); //null if there is no $fagg_test
            //$data["totres"] = [$aggr_headers,$labels,$totres];
        }*/
        //return $data;
        ////////////////////////////// new highchart code
        $data["categories"] =
            [
                [
                    "name" => "Year", "categories" =>$years
                ]
            ];
        $data["series"] = [];
        //////////////////////////////////////////////////////// old bubble code ///////////////
        // get file header
        $series_data = [];
        foreach($totres as $key=>$totres_val){
            $totres_val = json_decode(json_encode($totres_val), true); // change the inner StdClass to Array
            ///101abed2
            //$totres_val['agggname'] = substr($totres_val['agggname'],0,strpos($totres_val['agggname'],"_"));
            $values = unserialize(serialize(explode(',',$totres_val[$data['labels']['x']])));
            $yearsaggr = unserialize(serialize(explode(',',$totres_val['yearagg'])));
            //101abed
            $saved_years = $years;
            if (!is_numeric($yearsaggr[0])){
                $saved_years = array_map(function($val) { return '"'.$val.'"'; }, $saved_years );
            }
            array_walk($saved_years, function(&$val, $key) use ($values,$yearsaggr) {
                $val = (in_array($val, $yearsaggr))?floatval($values[array_search($val, $yearsaggr)]):null;
            });
            $values = $saved_years;

            // custome legend
            $label_agggname = explode('_',$totres_val['agggname']);
            array_walk($fagg, function(&$val, $key){
                $val = explode('#',$val)[0];
            });
            $fagg = array_unique($fagg);
            array_walk($label_agggname, function(&$val, $key) use ($aggr_headers,$fagg) {
                $val = (($aggr_headers[$key] == 'region')?null:$val);
                //$val = (array_search($aggr_headers[$key],$fagg) === false)? $val : null;
            });
            $label_agggname = implode(array_filter($label_agggname),"_");
            //custome tooltip
            $tmp_agggname = explode('_',$totres_val['agggname']);
            array_walk($tmp_agggname, function(&$val, $key) use ($aggr_headers) {
                $val = $aggr_headers[$key].':'.$val;
            });
            $tmp_agggname = implode($tmp_agggname,"$$");



            $series_data = [
                'name' => ' '.$label_agggname.' ',
                'toolname' => ' '.$tmp_agggname.' ',
                'data' => $values,//array_map('floatval', $values),
                'visible'=>true,
                'connectNulls'=>true
            ];
            $data["series"][] =  $series_data;
        }
        //$data["series"][0]["visible"] = true;
        //$data["series"][1]["visible"] = true;
        //$data["series"][2]["visible"] = true;

        $data['msg'] = [
            'msg_code' => 1,
            'msg_text' => 'request served succesfully'
        ];
        //Dd($data['frames']);
        //$drop_view = $this->JsonController->drop_view($file_id. '_highchart_vw');
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

    public function stdv($arr){
        reset($arr);
        $first_key = key($arr);
        $arr = $arr[$first_key];
        $fMean = array_sum($arr) / count($arr);
        return round(sqrt(array_sum(array_map(function ($x) use ($fMean) {
                return pow($x - $fMean, 2);
            }, $arr)) / count($arr)),2);
    }


    public function get_map_coordinations($geo_val){
        $geo_arr = unserialize(serialize(explode(',',$geo_val))); // deep copy for the result
        $res = [];
        $reslon = '';
        $reslat = '';
        $resname = '';
        foreach ($geo_arr as $geokey => $geovalue) {
            foreach ($this->geos_locations as $key => $value) {
                $resstr = stripos(MapFileController::clean_str($geovalue),MapFileController::clean_str($value['name']));
                //print('key =' . $value['key'] .' $geovalue =' . MapFileController::clean_str($geovalue) . ' name ='.MapFileController::clean_str($value['name']).' $resstr =' . $resstr);
                //print ('<br/>');
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