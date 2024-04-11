<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaygroundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_playground');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $playground = request()->route('playground');

        return [
            'title_ar'    => ['required' , 'string' , 'max:255' , 'unique:playgrounds,title_ar,'.$playground->id,new NotNumbersOnly()],
            'title_en'    => ['required' , 'string' , 'max:255' , 'unique:playgrounds,title_en,'.$playground->id,new NotNumbersOnly()],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'main_image'      => 'nullable|mimes:jpeg,png,jpg,webp,svg|max:2048' ,
        ];
    }
}
