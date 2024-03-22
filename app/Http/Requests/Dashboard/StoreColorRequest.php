<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_colors');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'name_ar'     => ['required','string','max:255',  Rule::unique('colors', 'name_ar')->whereNull('deleted_at'),new NotNumbersOnly()] ,
            'name_en'     => ['required','string','max:255',  Rule::unique('colors', 'name_en')->whereNull('deleted_at'),new NotNumbersOnly()] ,
 
        ];

        if($this->color_type == 'image')
        {
            $rules['image'] = ['required', 'image','mimes:jpeg,jpg,png,gif,svg','max:4096'];
        }else{
            $rules['hex_code'] = ['required', Rule::unique('colors', 'hex_code')->whereNull('deleted_at')];
        }

        return $rules;
    }
}
