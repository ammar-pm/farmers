<?php

namespace App\Http\Controllers\API;

use Auth;
use App;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Dataset;
use App\User;
use App\File;
use App\Favorite;
use App\Http\Resources\Dataset as DatasetResource;
use Illuminate\Support\Facades\DB;
use App\Menu;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class DatasetController extends Controller
{

    public function index()
    {
        $data = [];
        $data['records'] = DatasetResource::collection(Dataset::with(['user'])->orderBy('title')->get());
        return $data;
    }

    public function get_sorted_datasets($sort_option,$sort_option_type)
    {
        if ($sort_option == 'user_name'){
            $data = [];
            $data['records'] = DatasetResource::collection(
                Dataset::with('user')->orderBy('id','desc')->get()->sortBy('name'));
            /*$data['records'] = DatasetResource::collection(
                Dataset::with(array('user' => function($query) use($sort_option_type) {
                $query->orderBy('name',$sort_option_type);
            }))->get());*/
        }else{
            $data = [];
            $data['records'] = DatasetResource::collection(Dataset::with(['user'])->orderBy($sort_option, $sort_option_type)->get());
        }
        return $data;
    }

    public function get_searched_datasets(Request $request)
    {
        $input = $request->all();
        //DB::enableQueryLog();
        /// add the username to the datasets fields
        $query = Dataset::with(['user']);
        $subQueryUserNames = 'select name from users where id = datasets.created_by';
        $subQueryUserNames2 = 'select group_concat(title) as topics from posts inner join dataset_post on posts.id = dataset_post.post_id where dataset_post.dataset_id = datasets.id';
        //$query->selectSub($subQueryUserNames, 'user_name');
        $datasets = $query->addSubSelect('topics_abdo', $subQueryUserNames2);
        $datasets = $query->addSubSelect('user_name', $subQueryUserNames);
        $super_datasets = DB::table( DB::raw("({$datasets->toSql()}) as datasets") )
            ->mergeBindings($datasets->getQuery()); // you need to get underlying Query Builder;
        //$super_datasets = Dataset::hydrate($super_datasets->get()->toArray());
        /// end adding the username to the datasets fields
        if (!empty($input['search_text'])){
            if (empty($input['sort_option_lang'])) {
                $data = [];
                $data['records'] = DatasetResource::collection(
                    Dataset::hydrate($super_datasets->where('title', 'like', '%' . $input['search_text'] . '%')
                        ->orWhere('user_name', 'like', '%' . $input['search_text'] . '%')
                        ->orWhere('topics_abdo', 'like', '%' . $input['search_text'] . '%')
                        ->orWhere('id', '=', $input['search_text'] )
                        ->orWhereRaw('DATE_FORMAT(created_at, "%d/%c/%Y")' . ' = '. '\'' . $input['search_text'] . '\'')
                        ->orWhereRaw('DATE_FORMAT(created_at, "%d/%m/%Y")' . ' = '. '\'' . $input['search_text'] . '\'')
                        ->distinct()
                        ->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get()->toArray())
                );
                //Dd(DB::getQueryLog());
                return $data;
            }else{
                $data = [];
                $data['records'] = DatasetResource::collection(
                    Dataset::hydrate($super_datasets->where('title', 'like', '%' . $input['search_text'] . '%')
                        ->where(function ($query) use ($input) {
                            $query->where('language', $input['sort_option_lang']);
                        })->orWhere(function($query) use ($input) {
                            $query->orWhere('user_name', 'like', '%' . $input['search_text'] . '%')
                                ->orWhere('topics_abdo', 'like', '%' . $input['search_text'] . '%')
                                ->orWhere('id', '=', $input['search_text'] )
                                ->orWhereRaw('DATE_FORMAT(created_at, "%d/%c/%Y")' . ' = '. '\'' . $input['search_text'] . '\'')
                                ->orWhereRaw('DATE_FORMAT(created_at, "%d/%m/%Y")' . ' = '. '\'' . $input['search_text'] . '\'');
                        })
                        ->distinct()
                        ->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get()->toArray())
                );
                //Dd(DB::getQueryLog());
                return $data;
            }
        }else{
            if (empty($input['sort_option_lang'])) {
                $data = [];
                $data['records'] = DatasetResource::collection(
                //Dataset::with(['user'])
                    $datasets->distinct()->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get()
                );
                //var_dump(DB::getQueryLog());
                return $data;
            }else{
                $data = [];
                $data['records'] = DatasetResource::collection(
                //Dataset::with(['user'])
                    $datasets->where(function ($query) use ($input) {
                        $query->where('language', $input['sort_option_lang']);
                    })->distinct()->orderBy((empty($input['sort_option'])) ? 'title' : $input['sort_option'], (empty($input['sort_option_type'])) ? 'asc' : $input['sort_option_type'])
                        ->get()
                );
                //var_dump(DB::getQueryLog());
                return $data;
            }
        }
    }


    public function show($id)
    {
        $idv = (int)$id;
        $data = [];
        $record = Dataset::find($idv);
        $data['options'] = unserialize($record->options);
        $data['options'] += array('XColumn' => array());
        //Dd($data['options']);
        //array_push($data['options']['XColumn'],'');
        $data['record'] = Dataset::with(['periods', 'topics', 'governorates', 'indicators', 'files', 'user', 'favorites'])->find($id);
        // $data['favorited'] = $record->favorited($id);

        return $data;
    }

    public function updatePreviewImage(Request $request)
    {
        $file = $request->file('file');
        $dataset_id = $request['dataset_id'];

        $record = Dataset::find($dataset_id);
        // preview
        if ($request->hasFile('file')) {
            $file_name = $file->getClientOriginalName();
            ////////////
            $md5Name = md5_file($file->getRealPath());
            $arr = explode(".", strtolower($file_name));
            $guessExtension = $arr[1]; // get extension from the name
            $file_name = $file->storeAs('preview', $md5Name.'.'.$guessExtension);
            //$file_name = $file;
            ////////////////////////
            $file->move(public_path('preview'), $file_name);
            $record->preview = $file_name;
            $record->save();
        }
    }

    public function get_related_datasets()
    {
        $data = [];
        //$selected_dataset = Dataset::select('id')->where('related_id','!=',0)->get()->toArray();
        $query = Dataset::with(['topics']);
        $subQueryUserNames2 = 'select group_concat(title) as topics from posts inner join dataset_post on posts.id = dataset_post.post_id where dataset_post.dataset_id = datasets.id';
        $datasets = $query->addSubSelect('topics_abdo', $subQueryUserNames2);
        $super_datasets = DB::table( DB::raw("({$datasets->toSql()}) as datasets") )
            ->mergeBindings($datasets->getQuery()); // you need to get underlying Query Builder;
        $data['records'] = Dataset::hydrate($super_datasets ->select('id','title','topics_abdo','language')
                ->where(function($query) {
                    $query->orderby('topics_abdo', 'asc');
                })
                //->whereNotIn('id',array_flatten($selected_dataset))
                ->orderBy('language','asc')
                ->get()->toArray());
        return $data;
    }

    public function check_base64_image($base64) {
        try {
            $img = imagecreatefromstring(base64_decode($base64));
            if (!$img) {
                return false;
            }

            imagepng($img, 'tmp.png');
            $info = getimagesize('tmp.png');

            unlink('tmp.png');

            if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function save(Request $request)
    {
        $input = $request->all();
        //$var_related_id2 = ($input['related_id'] !== "" && !empty($input['related_id'])) ? ((!empty($input['related_id'][0]) && isset($input['related_id'][0]))?'haha':'hoho') : 0;
        $var_related_id = ($input['related_id'] !== "" && !empty($input['related_id'])) ? ((!empty($input['related_id'][0]) && isset($input['related_id'][0]))?$input['related_id'][0]['id']:$input['related_id']['id']) : 0;
        $input['related_id'] =  (empty($var_related_id) ? 0 : $var_related_id);
//Dd($var_related_id2);
        if (!empty($input['id'])) {

            $input['options'] = serialize($request->options);

            $record = Dataset::find($input['id']);

            // preview
            $indx = stripos($input['preview'], 'base64,');
            $rest = substr($input['preview'], $indx+7);
            $base64 = $rest;
            if (DatasetController::check_base64_image($base64)) {
                $png_url = "preview-".time().".png";
                $png_data =  base64_decode($base64);
                Storage::disk('preview')->put($png_url, $png_data);
                $input['preview'] = 'preview/'.$png_url;
                //print 'Image!';
            }
            // Files
            $record->files()->detach();
            if (isset($request->file_id['id']) && !empty($request->file_id['id'])) {
                $record->files()->attach([$request->file_id['id']]);
            }

            // related_id
            if (!empty($request->related_id)) {
                $var_related_id = (!empty($request->related_id[0]) && isset($request->related_id[0]))?$request->related_id[0]['id']:$request->related_id['id'];
                $record->related_id = $var_related_id;
                // mutual update
                $record2 = Dataset::find($var_related_id);
                $input2['related_id'] = $request->id;
                $input2['public'] = $request->public;
                $record2->update($input2);
            }

            // Periods
            $record->periods()->detach();
            if (!empty($request->periods)) {
                $record->periods()->attach(array_column($request->periods, 'id'));
            }

            // Topics
            $record->topics()->detach();
            if (!empty($request->topics)) {
                //Dd($request->topics);
                if (!empty($request->topics['id'])){
                    $record->topics()->attach([$request->topics['id']]);
                }else{
                    $record->topics()->attach(array_column($request->topics, 'id'));
                }
            }

            // Governorates
            $record->governorates()->detach();
            if (!empty($request->governorates)) {
                $record->governorates()->attach(array_column($request->governorates, 'id'));
            }

            // Indicators
            $record->indicators()->detach();
            if (!empty($request->indicators)) {
                $record->indicators()->attach(array_column($request->indicators, 'id'));
            }

            $record->update($input);

        } else {

            $input['library'] = 'chartjs';
            $input['options'] = serialize(
                ['type' => 'line','X' => '','Y' => '','Z' => '','fbasevalue'=>[],'faggvalue'=>[],'vizabi_model'=>[],'height'=>400,'years_field'=>[],'plotly_scale'=>'1','pointStyle'=>'circle','pointRadius'=>'3']
            );

            $record = Dataset::create($input);
        }

        return $record;
    }

    public function destroy($id)
    {
        Dataset::find($id)->delete();
    }

}