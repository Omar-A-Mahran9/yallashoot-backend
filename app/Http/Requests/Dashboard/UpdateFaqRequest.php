<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_faq');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $faq = request()->route('faq');

        return [
            'question'  => ['required','string','max:255', "unique:faqs,question,$faq->id",new NotNumbersOnly()] ,
            'answer'    => ['required','string',new NotNumbersOnly()] ,
        ];
    }
}
