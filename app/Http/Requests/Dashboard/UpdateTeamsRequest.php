<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_team');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $team = request()->route('team');
 
        return [
            'title_ar'    => ['required' , 'string' , 'max:255' , 'unique:teams,title_ar,'.$team->id,new NotNumbersOnly()],
            'title_en'    => ['required' , 'string' , 'max:255' , 'unique:teams,title_en,'.$team->id,new NotNumbersOnly()],
            'country_id'    => ['required'],
            'coach_id'    => ['required'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'main_image'      => 'nullable|mimes:jpeg,png,jpg,webp,svg|max:2048' , 
        ];
    }
}
