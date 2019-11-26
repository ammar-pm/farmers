<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use File;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if($this->hasFile('url')){
            $extension = File::extension($this->url->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                //'file is a valid xls or csv file'
            } else {
                $rules = ['url' => 'mimetypes:csv,xls,xlsx'];
            }
        } else {
            $rules = ['url' => 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'url.mimetypes' => 'The file must be a file of type: csv, xls, xlsx.',
            'url.required' => 'The file field is required.',
        ];
    }

}
