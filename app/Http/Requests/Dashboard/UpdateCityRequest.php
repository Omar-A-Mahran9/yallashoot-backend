<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_cities');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $city = request()->route('city');

        return [
            'name_ar'    => [ 'required','string','max:255','unique:cities,name_ar,' . $city->id ,new NotNumbersOnly()],
            'name_en'    => [ 'required','string','max:255','unique:cities,name_en,' . $city->id,new NotNumbersOnly() ],
        ];
    }
}
