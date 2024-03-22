<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
        $tag = request()->route('tag');

        return [
            'name_ar'     => ['required','string','max:255', "unique:tags,name_ar,$tag->id",new NotNumbersOnly()] ,
            'name_en'     => ['required','string','max:255', "unique:tags,name_en,$tag->id",new NotNumbersOnly()] ,
            'bg_color'    => ['nullable','string','max:255'] ,
        ];
    }
}
