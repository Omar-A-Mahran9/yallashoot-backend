<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreBankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_banks');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'    => ['required' , 'string' , 'max:255' , 'unique:banks,name_ar',new NotNumbersOnly()],
            'name_en'    => ['required' , 'string' , 'max:255' , 'unique:banks,name_en',new NotNumbersOnly()],
            'image'      => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048' ,
        ];
    }
}
