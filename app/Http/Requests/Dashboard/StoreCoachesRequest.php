<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreCoachesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         return abilities()->contains('create_coaches');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'    => ['required' , 'string' , 'max:255' , 'unique:coaches,name_ar',new NotNumbersOnly()],
            'name_en'    => ['required' , 'string' , 'max:255' , 'unique:coaches,name_en',new NotNumbersOnly()],
            'country_id'    => ['required'],
            'phone'    => ['required'],
            'email'    => ['required'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'birth_date' => 'required|date|before_or_equal:' . Carbon::now()->subYears(16)->toDateString(),
            'main_image'      => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048' ,
        ];
    }
}
