<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_tags');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $feature = request()->route('feature');
        return [
             'name_ar'    => ['required' , 'string' ,'unique:features,name_ar,' . $feature->id, 'max:255' ,new NotNumbersOnly()],

             'name_en'    => ['required' , 'string' ,'unique:features,name_en,' . $feature->id, 'max:255' ,new NotNumbersOnly()],
        ];
    }
}
