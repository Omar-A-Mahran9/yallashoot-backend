<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_careers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_ar'             => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'title_en'             => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'work_type'            => ['required', 'in:full-time,part-time,remotely'],
            // 'address'           => ['required','string','max:255'],
            // 'short_description' => ['required','string'],
            // 'long_description'  => ['required','string'],
            'city_id'           => ['required'],
        ];
    }
}
