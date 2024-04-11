<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeamsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_team');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_ar'    => ['required' , 'string' , 'max:255' , 'unique:teams,title_ar',new NotNumbersOnly()],
            'title_en'    => ['required' , 'string' , 'max:255' , 'unique:teams,title_en',new NotNumbersOnly()],
            'country_id'    => ['required'],
            'coach_id'    => ['required'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'main_image'      => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048' ,        ];
    }
}
