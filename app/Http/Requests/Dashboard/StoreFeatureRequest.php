<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_features');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name_ar'    => 'required | string | max:255 | unique:features|regex:/[\u0600-\u06FF]+/',
            'name_ar'    => ['required' , 'string' ,'unique:features', 'max:255' ,new NotNumbersOnly()],
            'name_en'    => ['required' , 'string' ,'unique:features', 'max:255' ,new NotNumbersOnly()],
        ];
    }
}
