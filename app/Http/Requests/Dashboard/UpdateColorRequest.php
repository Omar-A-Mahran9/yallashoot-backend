<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_colors');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $color = request()->route('color');

        $rules = [
            'name_ar'     => ['required','string','max:255', Rule::unique('colors', 'name_ar')->ignore($color->name_ar,'name_ar')->whereNull('deleted_at'),new NotNumbersOnly()] ,
            'name_en'     => ['required','string','max:255', Rule::unique('colors', 'name_en')->ignore($color->name_en,'name_en')->whereNull('deleted_at'),new NotNumbersOnly()] ,
        ];

        if($this->color_type == 'image')
        {
            $rules['image'] = ['required', 'image','mimes:jpeg,jpg,png,gif,svg','max:4096'];
        }else{
            $rules['hex_code'] = ['required', Rule::unique('colors', 'hex_code')->ignore($color->hex_code,'hex_code')->whereNull('deleted_at')];
        }

        return $rules;
    }
}
