<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_channel');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
 
        return [
            'title_ar' => [
                'required',
                'string',
                'max:255',
                'unique:channels,title_ar,',
                new NotNumbersOnly()
            ],
            'title_en' => [
                'required',
                'string',
                'max:255',
                'unique:channels,title_en,' ,
                new NotNumbersOnly()
            ],
            "commenter_name_ar" => 'required|string|max:255',
            "commenter_name_en" => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'satellites' => ['array'],
         
            'main_image'      => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048' ,

    
        ];
}
}