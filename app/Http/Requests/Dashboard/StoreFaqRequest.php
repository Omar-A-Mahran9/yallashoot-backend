<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_faq');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'  => ['required','string','max:255', "unique:faqs",new NotNumbersOnly()] ,
 
            'answer'    =>  ['required','string','max:255', "unique:faqs,question",new NotNumbersOnly()] ,
        ];
    }
}
