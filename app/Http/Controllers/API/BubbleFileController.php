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

class BubbleFileController extends Controller
{
    protected $JsonController;

    public function __construct()
    {
        $this->JsonController = new JSonFileController();
    }

    public function plotly_bubble(Request $request)
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
            $res = BubbleFileController::get_bubble_payload($id,$file->file_data_text,$scale,$fdim,$fagg,$fbase,$lang,$alertlang,$years_fields);
            return $res;
        }
    }

    public function get_bubble_payload($file_id,$file_data,$scale,$fdim,$fagg,$fbase,$lang,$alertlang,$years_fields)
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
        // get file header
        if(!isset($file_data)){
            $data['msg'] = [
                'msg_code' => 2,
                'msg_text' => Lang::get('common.filenotsaved')
            ];
            return $data;
        }
        $this->JsonController->setLanguage($lang);
        $data = [];
        $scale = ($scale == 0)?1:$scale;
        //$create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
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
        if (isset($fagg)) {
            $fagg_test= $this->JsonController->extract_fagg_params($fagg);
            //Dd($fagg_test);
        }
        $cal_headers = array_values(array_filter($headers, function ($key)  use ($heades_cnt){
            return ($key !== 1 && $key !== 2 && $heades_cnt > 3); // filter over other things
        },ARRAY_FILTER_USE_KEY));
        //$years = $this->JsonController->get_json_dis_qry($file_data,$aggr_headers[0]);
        $create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
        $years = $this->JsonController->get_json_dis_qry2($file_id. '_vw','year');
        //// fill the years according to charttype does not work #abed
        //$years = $this->JsonController->fill_missing_years($years);
        //$years_fields = (empty($years_fields)) ? $years_fields : $this->JsonController->fill_missing_years($years_fields);
        sort($years);


        sort($years_fields);
        $years =  (empty($years_fields))? $years : ((count($years_fields) == 1 && !empty($years_fields))? [end($years_fields),end($years_fields)]:$years_fields);


        //$regions = $this->JsonController->get_json_dis_qry($file_data,$aggr_headers[1]); // has to be deleted
        //$num = $this->JsonController->get_json_num_qry($file_data);
        //$labels = array_slice($cal_headers,1);

        $labels = $cal_headers;

        if (!isset($fdim) && empty($fdim)){
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

            if(empty($labels)) {
                $labels = array_values($data['labels']);
                $cal_headers = $labels;
            }

        }

        //$stdv_x = BubbleFileController::stdv($this->JsonController->get_json_col_qry($file_data,$data['labels']['x']));
        //$stdv_y = BubbleFileController::stdv($this->JsonController->get_json_col_qry($file_data,$data['labels']['y']));
        //$stdv_z = BubbleFileController::stdv($this->JsonController->get_json_col_qry($file_data,$data['labels']['z']));
        $stdv_z = BubbleFileController::stdv($this->JsonController->get_json_col_qry2($file_id. '_vw',$data['labels']['z']));
        if ( $stdv_z < 20){
            $data['msg'] = [
                'msg_code' => 2,
                'msg_text' => 'Data spread out must be >' . 20
            ];
            return $data;
        }

        $xdata = $this->JsonController->get_json_col_qry2($file_id. '_vw',$data['labels']['x']);
        $ydata = $this->JsonController->get_json_col_qry2($file_id. '_vw',$data['labels']['y']);
        //$ydata = json_decode(json_encode($ydata), true); // change the inner StdClass to Array
        //Dd($ydata[$data['labels']['y']]);
        $xmin  = min($xdata[$data['labels']['x']]);
        $xmax  = max($xdata[$data['labels']['x']]);
        $data['range'] = [
            'xmin' => $xmin - (2 * $xmin),
            'xmax' => $xmax + ($xmax/8)
        ];
        $ymin  = min($ydata[$data['labels']['y']]);
        $ymax  = max($ydata[$data['labels']['y']]);
        $data['yrange'] = [
            'ymin' => $ymin - (2 * $ymin),
            'ymax' => $ymax + ($ymax/8)
        ];
        //// build trace payload for the first line
        $year_val = $years[0]; // for the first year only
        //$create_view = $this->JsonController->create_view($file_data,$file_id. '_vw');
        if(isset($fbase) && !empty($fbase)) {
            $totres = $this->JsonController->get_json_where_groupN_qry($file_id. '_vw',$file_data,
                $labels, $aggr_headers, $fagg_test,$years_fields); //null if there is no $fagg_test
        }else{
            if($heades_cnt > 4) {
                $totres = $this->JsonController->get_json_order_group2_qry($file_id. '_vw',$file_data,
                    $labels, $aggr_headers[0], $aggr_headers[1]);
            }else{
                //$labels[] = 'num';
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
        /*if ($data['labels']['x'] == 'num') {
            $totres_val = json_decode(json_encode($totres[0]), true); // change the inner StdClass to Array
            $x_dim_num = unserialize(serialize(explode(',',$totres_val[$data['labels']['x']]))); // deep copy for the result
            $xmax = count($x_dim_num);
            $data['range'] = [
                'xmin' => $xmin - (2 * $xmin),
                'xmax' => $xmax + ($xmax/8)
            ];
            array_walk($x_dim_num, function (&$val, $key) use ($xmax) {
                $val = (BubbleFileController::clean($val) % $xmax == 0)? $xmax :BubbleFileController::clean($val) % $xmax;
            });
        }*/
        foreach($totres as $key=>$totres_val){
            $totres_val = json_decode(json_encode($totres_val), true); // change the inner StdClass to Array
            if ($totres_val[$aggr_headers[0]]  ==  $year_val){
                $size = unserialize(serialize(explode(',',$totres_val[$data['labels']['z']]))); // deep copy for the result
                array_walk($size, function (&$val, $key) use ($scale) {
                    $val = BubbleFileController::clean($val)/$scale;
                });
                //Dd($cal_headers);
                $text = unserialize(serialize(explode(',',$totres_val[$cal_headers[0]]))); // deep copy for the result
                $text_data = explode(',',$totres_val[$data['labels']['z']]);
                $text_property = $data['labels']['z'];
                array_walk($text, function (&$val, $key) use ($text_data,$text_property) {
                    $val = $val. " <br> " . $text_property.":" . $text_data[$key];
                });
                if ($data['labels']['x'] == 'num') {
                    $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                    //$x_dim = $x_dim_num;
                    //$x_dim = unserialize(serialize(explode(',',$totres_val[$data['labels']['x']]))); // deep copy for the result
                    //$xmax = count($x_dim);
                    /*$data['range'] = [
                        'xmin' => $xmin - (2 * $xmin),
                        'xmax' => $xmax + ($xmax/8)
                    ];*/
                    /*array_walk($x_dim, function (&$val, $key) use ($xmax) {
                        $val = (BubbleFileController::clean($val) % $xmax == 0)? $xmax :BubbleFileController::clean($val) % $xmax;
                    });*/
                }else {
                    $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                }
                $data['traces'][] = [
                    'name' =>$totres_val[$aggr_headers[1]],
                    'x' => $x_dim,
                    'y' => explode(',',$totres_val[$data['labels']['y']]),
                    'id' => explode(',',$totres_val[$cal_headers[0]]),
                    'text' => $text,
                    'mode'=> 'markers',
                    'marker'=>[
                        'size'=>$size,
                        'sizemode'=>'area',
                        'sizeref'=>200000
                    ]
                ];
            }
        }
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
                    $size = unserialize(serialize(explode(',',$totres_val[$data['labels']['z']]))); // deep copy for the result
                    //echo 'size before','<br/>';
                    //print_r($size***);
                    //echo '<br/>';
                    array_walk($size, function (&$val, $key) use ($scale) {
                        $val = BubbleFileController::clean($val)/$scale;
                    });
                    //echo 'size after','<br/>';
                    //print_r($size);
                    //echo '<br/>';
                    $text = unserialize(serialize(explode(',',$totres_val[$cal_headers[0]]))); // deep copy for the result
                    $text_data = explode(',',$totres_val[$data['labels']['z']]);
                    $text_property = $data['labels']['z'];
                    array_walk($text, function (&$val, $key) use ($text_data,$text_property) {
                        $val = $val. " <br> " . $text_property.":" . $text_data[$key];
                    });
                    if ($data['labels']['x'] == 'num') {
                        $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                        //$x_dim = $x_dim_num; // deep copy for the result
                        /*$xmax = count($x_dim);
                        array_walk($x_dim, function (&$val, $key) use ($xmax) {
                            $val = (BubbleFileController::clean($val) % $xmax == 0)? $xmax :BubbleFileController::clean($val) % $xmax;
                        });*/
                    }else {
                        $x_dim = explode(',',$totres_val[$data['labels']['x']]);
                    }
                    $frames_data[] = [
                        'id' => $totres_val[$aggr_headers[1]],
                        'text' => $text,
                        'x' => $x_dim,
                        'y' => explode(',',$totres_val[$data['labels']['y']]),
                        'marker'=>[
                            'size'=>$size
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
        //Dd($data['frames']);
        //$drop_view = $this->JsonController->drop_view($file_id. '_bubble_vw');
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

    public function stdv($arr){
        reset($arr);
        $first_key = key($arr);
        $arr = $arr[$first_key];
        $fMean = array_sum($arr) / count($arr);
        return round(sqrt(array_sum(array_map(function ($x) use ($fMean) {
                return pow($x - $fMean, 2);
            }, $arr)) / count($arr)),2);
    }
}