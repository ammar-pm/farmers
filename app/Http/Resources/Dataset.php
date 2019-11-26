<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Controllers\API\JSonFileController;


class Dataset extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $JsonController = new JSonFileController();
            // calc periods from database
            $periods_res = [];
            if(isset(unserialize($this->options)['years_field']) && !empty(unserialize($this->options)['years_field']) ){
                $periods_res = unserialize($this->options)['years_field'];
            }elseif (empty($this->files[0]['id'])){
                $periods_res = [];
            }else{
                if (count($JsonController->get_json_years_data($this->files[0]['id'])['options']) <=3){
                    $periods_res = $JsonController->get_json_years_data($this->files[0]['id'])['options'];
                }else{
                    $periods_res = [min($JsonController->get_json_years_data($this->files[0]['id'])['options']) . ' - ' . max($JsonController->get_json_years_data($this->files[0]['id'])['options'])];
                }
            }

            return [
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->description,
            'preview'      => $this->preview,
            'language'     => $this->language,
            'public'       => $this->public,
            'featured'     => $this->featured,
            'library'      => $this->library,
            'options'      => unserialize($this->options),
            'tags'         => $this->tags,
            'periods'      => $periods_res,
            'topics'       => $this->topics,
            'governorates' => $this->governorates,
            'indicators'   => $this->indicators,
            'created_at'   => $this->created_at,
            'files'         => $this->files,
            'user'         => $this->user,
        ];
    }
}