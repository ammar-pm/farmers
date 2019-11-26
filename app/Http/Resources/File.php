<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;


class File extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'url'  => $this->url,
            'dformat'      => $this->dformat,
            'type'     => $this->type,
            'created_at'       => $this->created_at->toDateTimeString(),
            'user_name'     => $this->user_name,
            'file_data'      => $this->file_data,
            'file_data_text'         => $this->file_data_text,
            'topics'       => $this->topics
        ];
    }
}