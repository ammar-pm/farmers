<?php

namespace App\Http\Controllers\API;
use App;
use App\Menu;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use App\Dataset;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dataset as DatasetResource;
use Illuminate\Database\QueryException;

class JSonFileController extends Controller
{

///////////////////////////////////////////////////// How to call members of this class ////////////////////////////
    /*
         /*$res = TestController::get_json_where_qry($file->file_data,'pop',[['inkey'=>'gov','invalue'=>"Jenin",'intype'=>"string"],
                                                                                                ['inkey'=>'year','invalue'=>"1997",'intype'=>"int"]]);*/
    /*$res = TestController::get_multi_json_where_qry($file->file_data,
        ['pop','gov','year'],
        [['inkey'=>'gov','invalue'=>"Jenin",'intype'=>"string"],
        ['inkey'=>'region','invalue'=>"West Bank",'intype'=>"string"]]);*/


    /*$res = TestController::get_multi_json_where_qry($file->file_data,
    ['gov','illiteracy','unemployment'],
    [['inkey'=>'region','invalue'=>"West Bank",'intype'=>"string"],
    ['inkey'=>'year','invalue'=>"1997",'intype'=>"int"]]);
    */

    //$res = TestController::get_json_keys($file->file_data);
    //$res = TestController::get_json_dis_qry($file->file_data,'region');
//////////////////////////////////////////////////////////////////////////////////////////
    protected $json_view_name = 'json_abdo_view';
    protected $language = 'en';

    public function __construct()
    {
        //// run the down commands from database just for once ///
        /// delimiter //
        /*try{
            DB::statement('create function p2() returns JSON DETERMINISTIC NO SQL return @p2;');
            DB::statement('CREATE FUNCTION rownum() RETURNS int NO SQL NOT DETERMINISTIC begin SET @var := @var + 1; return @var; end;');
            Or execute this from command line in shell
            DELIMITER $$
            CREATE FUNCTION rownum ()
            RETURNS int
            NO SQL NOT DETERMINISTIC
            BEGIN
              SET @var := @var + 1;
              return @var;
            END$$
            DELIMITER ;
        }
        delimiter //
        catch (Exception $e){null;}*/
        DB::statement('set @var:=0;');
    }

///////////////////// get dataset related file_id  abed 2002 //////////////////////////////////////
    public function get_dataset_file_id($id) {
        $f_res = DB::table('dataset_file')->select(DB::raw('file_id'))->where('dataset_id','=',$id)->get()->toArray();
        return !empty($f_res[0]->file_id)?$f_res[0]->file_id:null;
    }

///////////////////// JSON class under Test //////////////////////////////////////
    public function cleannum($string) {
        if (!is_numeric($string)){
            return 0;
        }
        $string = round(floatval($string),2);
        if (isset($string) and $string != ''){
            return $string;
        }else {
            return 0;
        }
    }


    public function setLanguage($string) {
        $this->language = $string;
    }

    public function get_json_first_row_qry2($view_name){
        //DB::enableQueryLog();
        $s = JSonFileController::get_json_vw_str2($view_name);
        $results = DB::table(DB::raw($s))->select(DB::raw('*'))->where('uid', '=', 0)->get();
        $results = json_decode(json_encode($results), true);
        $results = array_map(function ($value){
            return str_replace('"','',$value);
        }, $results[0]);
        $results = array_map(function ($value){
            return (JSonFileController::cleannum($value) == 0) ?$value : JSonFileController::cleannum($value) ;
        }, $results);
        //Dd(DB::getQueryLog());
        return $results;
    } // end get_json_first_row_qry2

    public function get_json_all_row_qry2($file_id){
        $view_name = $file_id.'_vw';
        //DB::enableQueryLog();
        $results = DB::table($view_name)->select(DB::raw('*'))->get();
        $results = json_decode(json_encode($results), true);
        foreach ($results as $key => $valres){
            $results[$key] = array_map(function ($value){
                return str_replace('"','',$value);
            }, $valres);
            $results[$key] = array_map(function ($value){
                return (JSonFileController::cleannum($value) == 0) ?$value : JSonFileController::cleannum($value) ;
            }, $results[$key]);
        }
        return $results;
    } // end get_json_all_row_qry2

    public function get_json_all_row_qry_viz($file_id){
        $view_name = $file_id.'_vw';
        //DB::enableQueryLog();
        $s = JSonFileController::get_json_vw_str2_viz($view_name);
        $results = DB::table(DB::raw($s))->select(DB::raw('*'))->get();
        $results = json_decode(json_encode($results,JSON_UNESCAPED_UNICODE), true);
        foreach ($results as $key => $valres){
            $results[$key] = array_map(function ($value){
                return str_replace('"','',$value);
            }, $valres);
            $results[$key] = array_map(function ($value){
                return (JSonFileController::cleannum($value) == 0) ?$value : JSonFileController::cleannum($value) ;
            }, $results[$key]);
            $results[$key] = array_map(function ($value){
                return JSonFileController::get_matches_as_str($value);
            }, $results[$key]);
        }

        return $results;
    } // end get_json_all_row_qry_viz

    public function get_matches_as_str($val){
        if (is_numeric($val)){
            return $val;
        }
        preg_match_all('/\d+/', $val, $matches, PREG_OFFSET_CAPTURE);
        $matches_num = count($matches[0]);
        if ($matches_num < 2){
            return $val;
        }
        $res =[];
        foreach($matches[0] as $value) {
            $res[] = $value[0];
        }
        $str = implode(' Until ',$res);
        return $str;
    }// end get_matches_as_str

    public function get_json_dis_qry2($view_name,$field_name){
        //DB::enableQueryLog();
        $s = JSonFileController::get_json_vw_str2($view_name);
        $results = DB::table(DB::raw($s))->select($field_name)->distinct()->get();
        $results = array_flatten(json_decode(json_encode($results), true));
        $results = array_map(function ($value){
            return str_replace('"','',$value);
        }, $results);
        //Dd(DB::getQueryLog());
        return $results;
    } // end get_json_dis_qry2

    public function get_json_dis_qry($file_data,$field_name){
        /*$results = DB::table($view_name)->select($field_name)->distinct()->get();
        $results = array_flatten(json_decode(json_encode($results), true));
        return $results;
        $file_data = '';*/
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

    public function get_json_keys2($view_name) {
        return DB::getSchemaBuilder()->getColumnListing($view_name);
    } // end get_json2_keys

    public function get_sdmx_parents() {
        //DB::enableQueryLog();
        $s = 'sdmax__codes';
        $field_name = 'parent';
        $results = DB::table(DB::raw($s))->select($field_name)->distinct()->get();
        $results = array_flatten(json_decode(json_encode($results), true));
        $results = array_map(function ($value){
            return str_replace('"','',$value);
        }, $results);
        //Dd(DB::getQueryLog());
        return $results;

    } // end get_sdmx_parents

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
            $out_res[$val] = $tmp_res;
            //array_push($out_res,$tmp_res);
        }
        return $out_res;
    } // end get_multi_json_where_qry
    public function create_view_columns($file_data,$view_name = "json_abdo_view"){
        $this->json_view_name = $view_name;
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $output_field = JSonFileController::get_json_keys($file_data);
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_clause = 'select rownum() AS num ';
        foreach ($output_field as $key => $val){
            $select_clause = $select_clause . ' , CAST(JSON_EXTRACT(p2(), CONCAT("$[", x.n, "].'.$val.'")) AS CHAR CHARACTER SET utf8) AS '.$val.' ';
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

        //$where_clause = ' WHERE x.n < JSON_LENGTH(p2()) ' ;
        $where_clause = ' WHERE x.n = 0 and 1!=1' ;

        /*$results = DB::statement('CREATE TEMPORARY TABLE IF NOT EXISTS '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');*/

        /*$results = DB::statement('CREATE OR REPLACE VIEW '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');*/

        $results = DB::statement('CREATE TABLE IF NOT EXISTS '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');

        return $results;
    } // end createview

    public function insert_view_data($file_data,$view_name = "json_abdo_view"){
        $this->json_view_name = $view_name;
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $output_field = JSonFileController::get_json_keys($file_data);

        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_clause = 'select rownum() AS num ';
        foreach ($output_field as $key => $val){
            $select_clause = $select_clause . ' , CAST(JSON_EXTRACT(p2(), CONCAT("$[", x.n, "].'.$val.'")) AS CHAR CHARACTER SET utf8) AS '.$val.' ';
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
        //$where_clause = ' WHERE CAST(JSON_EXTRACT(p2(), CONCAT("$[", x.n, "].uid")) AS CHAR ) between '. $from_uid . ' and '.$to_uid;

        /*$results = DB::statement('CREATE TEMPORARY TABLE IF NOT EXISTS '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');*/

        /*$results = DB::statement('CREATE OR REPLACE VIEW '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');*/
        $results = DB::statement('INSERT INTO  '. $view_name .' ( ' . $select_clause.
            $from_clause .  $where_clause .' )');

        return $results;
    } // end createview

    public function create_view($file_data,$view_name = "json_abdo_view"){
        $this->json_view_name = $view_name;
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $output_field = JSonFileController::get_json_keys($file_data);

        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_clause = 'select rownum() AS num ';
        foreach ($output_field as $key => $val){
            $select_clause = $select_clause . ' , CAST(JSON_EXTRACT(p2(), CONCAT("$[", x.n, "].'.$val.'")) AS CHAR ) AS '.$val.' ';
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

        /*$results = DB::statement('CREATE TEMPORARY TABLE IF NOT EXISTS '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');*/

        /*$results = DB::statement('CREATE OR REPLACE VIEW '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');*/

        $results = DB::statement('CREATE TABLE IF NOT EXISTS '. $view_name .' AS '.'( ' . $select_clause.
            $from_clause .  $where_clause .' )');

        return $results;
    } // end createview

    /// rather than creating a view each time, get the sql statement statment
    public function get_json_vw_str($file_data,$view_name = "json_abdo_view"){
        //$this->json_view_name = $view_name;
        $datain = json_decode($file_data);
        $cnt = count(json_decode($file_data));
        $output_field = JSonFileController::get_json_keys($file_data);

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

        $results = '(' . $select_clause. $from_clause .  $where_clause . ' ) AS ' . $view_name;

        return $results;
    } // end get_json_vw_str

    public function get_json_vw_str2($view_name,$years = []){
        $keys = JSonFileController::get_json_keys2($view_name);
        $lang = $this->language;
        $from_clause = ' from ' . $view_name;
        $where_clause = '';
        $results = '';
        // sdmx codes
        $sdmx_parents = JSonFileController::get_sdmx_parents();
        foreach($sdmx_parents as $key=>$val) {
            if (in_array(strtolower($val), array_values($keys)))
            {
                $my_val = strtolower($val);
                $keys = array_map(function ($value) use ($my_val) {
                    return ($value == $my_val)?'IFNULL('.$my_val.'.description,'. $my_val .') as '. $my_val:$value;
                }, $keys);
                $from_clause = $from_clause. ' left join sdmax__codes as ' . $my_val .' on ' . $my_val .'.parent = ' . '\''.$val.'\'' .' and REPLACE(' . $my_val .', \'"\', \'\') = ' . $my_val. '.code and ' . $my_val . '.language = "' . $lang .'"';
            }
        }
        // end sdmx codes
        if (in_array("year", array_values($keys)) and !empty($years))
        {
            $where_clause = ' where year in ('.implode(',',(!is_numeric($years[0]))? array_map(function($val){ return '\'"'.$val.'"\'';} ,$years):$years).') '; //
        }

        if (in_array("geo", array_values($keys)))
        {
            $keys = array_map(function ($value) {
                return ($value == 'geo')?'IFNULL(governorates.title,geo) as geo':$value;
            }, $keys);
            $select_clause = 'select ' . implode($keys,',');
            $from_clause = $from_clause . ' left join governorates on geo = governorates.geo_code and governorates.language = "' . $lang .'"';
            $from_clause = $from_clause. $where_clause .' ) ';
            $results = $results . '(' . $select_clause. $from_clause .' x';
            //Dd($results);
            return $results;
        }
        else
        {
            $select_clause = 'select ' . implode($keys,',');
            //$from_clause = ' from ' . $view_name;
            $from_clause = $from_clause . $where_clause .' ) ';
            $results = $results.'(' . $select_clause. $from_clause .' x';
            //Dd($results);
            return $results;
        }

    } // end get_json_vw_str2

    public function get_json_vw_str2_viz($view_name){
        $keys = JSonFileController::get_json_keys2($view_name);
        $lang = $this->language;
        $keys = array_filter($keys, function($val,$key) { return $val!=='num' && $val!=='uid';},ARRAY_FILTER_USE_BOTH);
        $from_clause = ' from ' . $view_name;
        $where_clause = '';
        $results = '';
        // sdmx codes
        $sdmx_parents = JSonFileController::get_sdmx_parents();
        foreach($sdmx_parents as $key=>$val) {
            if (in_array(strtolower($val), array_values($keys)))
            {
                $my_val = strtolower($val);
                $keys = array_map(function ($value) use ($my_val) {
                    return ($value == $my_val)?'IFNULL('.$my_val.'.description,'. $my_val .') as '. $my_val:$value;
                }, $keys);
                $from_clause = $from_clause. ' left join sdmax__codes as ' . $my_val .' on ' . $my_val .'.parent = ' . '\''.$val.'\'' .' and REPLACE(' . $my_val .', \'"\', \'\') = ' . $my_val. '.code and ' . $my_val . '.language = "' . $lang .'"';
            }
        }
        // end sdmx codes

        if (in_array("geo", array_values($keys)))
        {
            $keys = array_map(function ($value) {
                return ($value == 'geo')?'IFNULL(governorates.title,geo) as geo':$value;
            }, $keys);
            $select_clause = 'select ' . implode($keys,',');
            $from_clause = $from_clause . ' left join governorates on geo = governorates.geo_code and governorates.language = "' . $lang .'"';
            $from_clause = $from_clause. $where_clause .' ) ';
            $results = $results . '(' . $select_clause. $from_clause .' x';
            //Dd($results);
            return $results;
        }
        else
        {
            $select_clause = 'select ' . implode($keys,',');
            //$from_clause = ' from ' . $view_name;
            $from_clause = $from_clause . $where_clause .' ) ';
            $results = '(' . $select_clause. $from_clause .' x';
            return $results;
        }
        //-------------------- old code -----------------------------------------///
        /*$keys = JSonFileController::get_json_keys2($view_name);
        //$x = Menu::language()->where('location', 'header')->first();
        //$lang =  App::getLocale();
        $lang = $this->language;
        $keys = array_filter($keys, function($val,$key) { return $val!=='num' && $val!=='uid';},ARRAY_FILTER_USE_BOTH);
        if (in_array("geo", array_values($keys)))
        {
            $keys = array_map(function ($value) {
                return ($value == 'geo')?'IFNULL(governorates.title,geo) as geo':$value;
            }, $keys);
            $select_clause = 'select ' . implode($keys,',');
            $from_clause = ' from ' . $view_name . ' left join governorates on geo = governorates.geo_code and governorates.language = "'. $lang.'"';;
            $from_clause = $from_clause .' ) ';
            $results = '(' . $select_clause. $from_clause .' x';
            return $results;
        }
        else
        {
            $select_clause = 'select ' . implode($keys,',');
            $from_clause = ' from ' . $view_name;
            $from_clause = $from_clause .' ) ';
            $results = '(' . $select_clause. $from_clause .' x';
            return $results;
        }*/
     ////--------------------------------------old code -------------------------------
    } // end get_json_vw_str2_viz

    public function drop_view($view_name = 'abed2'){
        if ($view_name == 'abed2'){
            $view_name =  $this->json_view_name;
        }
        try{
            $results = DB::statement('DROP TABLE IF EXISTS ' . $view_name);
        }catch (\Exception $e){}
        return $results;
    } // end drop_view

    public function get_view_name(){
        return $this->json_view_name;
    }//get_view_name

    public function get_json_order_group2_qry($view_name,$file_data,$output_field,$group_field1,$group_field2){
        $results = [];
        $s = JSonFileController::get_json_vw_str2($view_name);
        DB::statement('SET SESSION group_concat_max_len = 1000000;');
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = $group_field1 .',' .$group_field2;
        $voutput_field[] = $group_field1;
        $voutput_field[] = $group_field2;
        foreach ($output_field as $key => $val){
            $select_str = $select_str . ', GROUP_CONCAT(' . $val .') as ' . $val;
            $voutput_field[] = $val;
        }
        try {
            $results = DB::table(DB::raw($s))
                //$results = DB::table(DB::raw($s))
                ->select($view_name)
                ->groupBy($group_field1,$group_field2)
                ->orderBy($group_field1,'asc')
                ->orderBy($group_field2,'asc')
                ->get()->toArray();
        } catch(QueryException $ex){
            null;
        }
        return $results;
    }//get_json_order_group2_qry

    /// work for abed get_json_order_group2_qry
    public function get_json_where_groupN_qry($view_name,$file_data,$output_field,$group_fields,$where_fields,$years_fields=[]){
        //print_r($output_field);
        #Abed200
        $results = [];
        $output_field = array_diff($output_field, $group_fields);
        //print_r($output_field);
        //Dd($group_fields);
        //DB::enableQueryLog();
        //Dd(DB::getQueryLog());
        $s = JSonFileController::get_json_vw_str2($view_name,$years_fields);
        DB::statement('SET SESSION group_concat_max_len = 1000000;');
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = implode($group_fields,',');
        $voutput_field[] = $group_fields;
        foreach ($output_field as $key => $val){
            $select_str = $select_str . ', GROUP_CONCAT(' . $val .') as ' . $val;
            $voutput_field[] = $val;
        }
        try {
            $results = DB::table(DB::raw($s))
                //$results = DB::table($view_name)
                ->select(DB::raw($select_str))
                ->whereRaw($where_fields['where_string'])//, $where_fields['where_fields']
                ->groupBy(DB::raw(implode($group_fields,',')))
                ->orderBy($group_fields[0],'asc')
                ->get()->toArray();
        } catch(QueryException $ex){
            null;
        }
        /*$results = DB::table($this->json_view_name)
            ->select(DB::raw($select_str))
            ->whereRaw($where_fields['where_string'])//, $where_fields['where_fields']
            ->groupBy(DB::raw(implode($group_fields,',')))
            ->orderBy($group_fields[0],'asc')
            ->get()->toArray();*/
        //Dd($results);
        //Dd(DB::getQueryLog());
        return $results;
    }//get_json_where_groupN_qry

    public function get_json_where_groupN2_qry($view_name,$file_data,$output_field,$group_fields,$where_fields,$years_fields=[]){
        //DB::enableQueryLog();
        $results = [];
        $output_field = array_diff($output_field, $group_fields);
        $s = JSonFileController::get_json_vw_str2($view_name,$years_fields);
        DB::statement('SET SESSION group_concat_max_len = 1000000;');
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = implode($group_fields,',');
        $name = ",CONCAT( " . $group_fields[0] ;
        //CONCAT(FIRSTNAME, ',', LASTNAME)
        foreach (array_slice($group_fields,1) as $key => $gval){
            $name = $name .','.'"_"'. ',' . $gval;
        }
        $select_str = $select_str . $name .') as agggname';
        $voutput_field[] = $group_fields;
        foreach ($output_field as $key => $val){
            $select_str = $select_str . ', GROUP_CONCAT(' . $val .') as ' . $val;
            $voutput_field[] = $val;
        }
        $select_str = $select_str . ', GROUP_CONCAT(' . 'year' .') as ' . 'yearagg';
        try {
            $results = DB::table(DB::raw($s))
                //$results = DB::table($view_name)
                ->select(DB::raw($select_str))
                ->whereRaw($where_fields['where_string'])//, $where_fields['where_fields']
                ->groupBy(DB::raw(implode($group_fields,',')))
                ->orderBy('year','asc')
                ->get()->toArray();
        } catch(QueryException $ex){
            null;
        }
        /*$results = DB::table($this->json_view_name)
            ->select(DB::raw($select_str))
            ->whereRaw($where_fields['where_string'])//, $where_fields['where_fields']
            ->groupBy(DB::raw(implode($group_fields,',')))
            ->orderBy('year','asc')
            ->get()->toArray();*/
        //Dd($results);
        //Dd(DB::getQueryLog());
        return $results;
    }//get_json_where_groupN2_qry

    // /// yet to be coded ABED200
    public function extract_fagg_params($fagg) {
        $where_fields = []; // which has all the values in
        $where_string = "(1=1 ";
        $curr_col_name = "";
        $curr_col_idx = 0;
        foreach ($fagg as $key => $val){
            $res = stripos($val,'#');
            if ((isset($res) and $res != 0)) { // found #
                // write code
                $str_arr = explode('#',$val);
                if ($curr_col_name != $str_arr[0]){
                    $curr_col_name = $str_arr[0];
                    $curr_col_idx = 0;
                    $where_fields [] = "'".$str_arr[1]."'";
                    if (gettype($str_arr[1])!='string'){
                        $where_string = $where_string . ") and (" . $str_arr[0] . " = " .$str_arr[1];
                    }else{
                        $where_string = $where_string . ") and (STRCMP(REPLACE(" . $str_arr[0] . ",'\"',''),CONCAT(''," . "'".$str_arr[1]."')) = 0";
                    }

                }else{
                    $where_fields [] = "'".$str_arr[1]."'";
                    if (gettype($str_arr[1])!='string') {
                        $where_string = $where_string . " or " . $str_arr[0] . " = " . $str_arr[1];
                    }else{
                        $where_string = $where_string . " or STRCMP(REPLACE(" . $str_arr[0] . ",'\"',''),CONCAT(''," . "'" . $str_arr[1] . "')) = 0";
                    }
                }
                $curr_col_idx = $key;
            }
        }
        $data['where_fields'] = $where_fields;
        $data['where_string'] = $where_string . ')';
        return $data;
    } // end get_json_keys

    public function get_json_order_group1_qry($file_data,$output_field,$group_field1){
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = $group_field1;
        $voutput_field[] = $group_field1;
        foreach ($output_field as $key => $val){
            $select_str = $select_str . ', GROUP_CONCAT(' . $val .') as ' . $val;
            $voutput_field[] = $val;
        }
        $results = DB::table($this->json_view_name)
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



    public function get_json_num_qry($file_data){
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = 'num';
        $voutput_field = ['num'];
        $results = DB::table($this->json_view_name)
            ->select(DB::raw($select_str))
            ->get()->toArray();
        $out_res = [];
        foreach ($voutput_field as $key => $val) {
            $tmp_res = array_map(function ($value) use ($val) {
                return str_replace('"', '', $value->$val);
            }, $results);
            $out_res[$val] = $tmp_res;
            //array_push($out_res,$tmp_res);
        }
        return $out_res;
    }//get_json_num_qry


    public function get_json_col_qry($file_data,$output_field){
        $s = JSonFileController::get_json_vw_str($file_data,'json_vw');
        DB::statement('set @var:=0;');
        DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = $output_field;
        $voutput_field[] = $output_field;
        $results = DB::table(DB::raw($s))
            ->select(DB::raw($select_str))
            ->get()->toArray();
        $out_res = [];
        foreach ($voutput_field as $key => $val) {
            $tmp_res = array_map(function ($value) use ($val) {
                return str_replace('"', '', $value->$val);
            }, $results);
            $out_res[$val] = $tmp_res;
            //array_push($out_res,$tmp_res);
        }
        return $out_res;
    }//get_json_col_qry

    public function get_json_col_qry2($view_name,$output_field){
        $s = JSonFileController::get_json_vw_str2($view_name);
        //DB::statement('set @var:=0;');
        //DB::statement('select @p2:='.'\''.$file_data.'\''.';');
        $select_str = $output_field;
        $voutput_field[] = $output_field;
        //$results = DB::table($view_name)
        $results = DB::table(DB::raw($s))
            ->select(DB::raw($select_str))
            ->get()->toArray();
        $out_res = [];
        foreach ($voutput_field as $key => $val) {
            $tmp_res = array_map(function ($value) use ($val) {
                return str_replace('"', '', $value->$val);
            }, $results);
            $out_res[$val] = $tmp_res;
            //array_push($out_res,$tmp_res);
        }
        return $out_res;
    }//get_json_col_qry2

    public function update_json_rowold($file_id,$changed_row){
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
    }//update_json_rowold

    public function update_json_row($file_id,$changed_row){
        //DB::enableQueryLog();
        $changed_row = json_decode($changed_row);
        $uid = JSonFileController::cleannum($changed_row->uid);
        $row_id = 0;
        $commits = [];
        foreach ($changed_row as $key => $value) {
            $res = DB::table($file_id.'_vw')
                ->where('uid', $uid)
                ->update([$key => (gettype($value) === 'string') ? '"'.$value.'"' : $value]);
            $commits [$key] = $res;
        }
        //Dd(DB::getQueryLog());
        return $commits;
    }//update_json_row

    public function delete_json_rowold($file_id,$uid){
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
        $filenew = File::find($file_id);
        $filenew_data_text = $filenew->file_data_text;
        return $filenew_data_text;
    }//delete_json_rowold


    public function delete_json_row($file_id,$uid){
        $view_name = $file_id . '_vw';
        $res = DB::table($view_name)->where('uid', '=', JSonFileController::cleannum($uid))->delete();
        $file_data_text = JSonFileController::get_json_all_row_qry2($file_id);
        $filenew_data_text = json_encode($file_data_text);
        return $filenew_data_text;
    }//delete_json_row

    public function get_json_file_data($file_id){
        $file = File::find($file_id);
        $file_data_text = $file->file_data_text;
        return $file_data_text;
    }//get_json_file_data

    public function get_json_aggr_data($file_id){
        //DB::enableQueryLog();
        $file = File::find($file_id);
        $lang = (empty($file->language))?'en':$file->language;
        $this->language = $lang;
        $create_view = JSonFileController::create_view($file->file_data_text,$file_id. '_vw');
        $data = [];
        //$file_data_text = json_decode($file->file_data_text,true);
        $file_data_text = JSonFileController::get_json_first_row_qry2($file_id.'_vw');
        $header = array_map(function ($value){
            return is_numeric($value);
        }, $file_data_text);
        /*$header = array_map(function ($value){
            return gettype($value);
        }, $file_data_text[0]);*/
        $header_dim = array_filter($header, function($x,$key) { return $x!=1 && $key!=='uid';},ARRAY_FILTER_USE_BOTH);
        $keys = array_keys($header_dim);
        $data['options'] = [];
        $data['options_nochildren'] = [];
        foreach($keys as $key => $valup){
            //Dd($keys);
            //$val_uniq_data = JSonFileController::get_json_dis_qry($file->file_data_text,$valup);
            //Dd($val_uniq_data);
            $val_uniq_data = JSonFileController::get_json_dis_qry2($file_id. '_vw',$valup);
            //Dd($val_uniq_data);
            $children = [];
            foreach($val_uniq_data as $key => $val){
                $children [] = ['id'=> $valup .'#'.$val,'label'=>$val];
            }
            $option = [
                'id'=> $valup,
                'label'=> preg_replace("/[^a-zA-Z]/", " ", $valup),
                'children'=>$children
            ];
            $option_nochildren = [
                'id'=> $valup,
                'label'=>preg_replace("/[^a-zA-Z]/", " ", $valup)
            ];
            $data['options'][] = $option; // add new option to the options
            $data['options_nochildren'][] = $option_nochildren; // add new option to the options
        }
        //$drop_view = JSonFileController::drop_view('tmp01_'.$file_id);
        //Dd($data);
        //DB::enableQueryLog();
        //Dd(DB::getQueryLog());
        return $data;
    }//get_json_aggr_data


    public function get_json_dim_data2($file_id){
        $file = File::find($file_id);
        $data = [];
        if (!isset($file->file_data_text)){
            $data['options'] = [];
            return $data;
        }
        $file_data_text = json_decode($file->file_data_text,true);
        $header = array_map(function ($value){
            return gettype($value);
        }, $file_data_text[0]);
        $header_dim = array_filter($header, function($x) { return $x!='string'; });
        $keys = array_keys($header_dim);
        $data['options'] = [];
        /// this code if for DimTreeSelect component
        /*foreach($keys as $key => $val){{
            $option = [
              'id'=> $val,
              'label'=>$val,
              'children'=>[
                  ['id'=> 'X#' . $val,'label'=>$val . ' As X'],
                  ['id'=> 'Y#' . $val,'label'=>$val . ' As Y'],
                  ['id'=> 'Z#' . $val,'label'=>$val . ' As Z']
              ]
            ];
            $data['options'][] = $option; // add new option to the options
        }
    }*/
        // pass the resut directly for DimMselect
        $keys = array_filter($keys, function($x) { return $x!='year' && $x!='uid'; });
        $data['options'] = $keys;
        //Dd($data);
        return $data;
    }//get_json_dim_data

    public function get_json_dim_data($file_id){
        $file = File::find($file_id);
        $lang = (empty($file->language))?'en':$file->language;
        $this->language = $lang;
        $data = [];
        if (!isset($file->file_data_text)){
            $data['options'] = [];
            return $data;
        }

        //$file_data_text = json_decode($file->file_data_text,true);
        $file_data_text = JSonFileController::get_json_first_row_qry2($file_id.'_vw');
        $header = array_map(function ($value){
            return is_numeric($value);
        }, $file_data_text);
        $header_dim = array_filter($header, function($x) { return $x==1; });
        $keys = array_keys($header_dim);
        $data['options'] = [];
        /// this code if for DimTreeSelect component
        /*foreach($keys as $key => $val){{
            $option = [
              'id'=> $val,
              'label'=>$val,
              'children'=>[
                  ['id'=> 'X#' . $val,'label'=>$val . ' As X'],
                  ['id'=> 'Y#' . $val,'label'=>$val . ' As Y'],
                  ['id'=> 'Z#' . $val,'label'=>$val . ' As Z']
              ]
            ];
            $data['options'][] = $option; // add new option to the options
        }
    }*/
        // pass the resut directly for DimMselect
        $keys = array_filter($keys, function($x) { return $x!='year' && $x!='uid' && $x!='num'; });
        $data['options'] = $keys;
        //Dd($data);
        return $data;
    }//get_json_dim_data2

    public function get_json_years_data($file_id){
        $file = File::find($file_id);
        $lang = (empty($file->language))?'en':$file->language;
        $this->language = $lang;
        $data = [];
        if (!isset($file->file_data_text)){
            $data['options'] = [];
            return $data;
        }
        $keys = JSonFileController::get_json_dis_qry2($file_id. '_vw','year');


        if (!is_numeric($keys[0])) {
            $data['options'] = $keys;
        }else{
            $key_mapped = array_map('intval', $keys);
            //$key_mapped = JSonFileController::fill_missing_years($key_mapped);
            sort($key_mapped);
            $data['options'] = $key_mapped;
        }

        return $data;
    }//get_json_years_data


    public function fill_missing_years($key_mapped){
        ////////////////////////////// filling missing gaps /////////////////////////////
        $min = min($key_mapped); // min and max
        $max = max($key_mapped);
        $year_range = range($min, $max); // create complete years
        $missing_years = array_diff($year_range, $key_mapped); // compare both all years to complete range to get the missing
        foreach($missing_years as $y) {
            $key_mapped[] = $y; // push missing year
        }
        /// ///////////////////////// ///////////////////////////////////////////////////
        return $key_mapped;
    }// fill_missing_years

}