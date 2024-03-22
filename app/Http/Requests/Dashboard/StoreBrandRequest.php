<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_brands');
    }
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => ['required','string','unique:brands',new NotNumbersOnly()],
            'name_en' => ['required','string','unique:brands',new NotNumbersOnly()],
            'meta_keyword_ar' => 'nullable|string|max:255' ,
            'meta_keyword_en' => 'nullable|string|max:255' ,
            'meta_desc_en'    => 'nullable|string|max:255' ,
            'meta_desc_ar'    => 'nullable|string|max:255' ,
            'image'           => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048' ,
            'cover'           => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048' ,
        ];
    }
}
