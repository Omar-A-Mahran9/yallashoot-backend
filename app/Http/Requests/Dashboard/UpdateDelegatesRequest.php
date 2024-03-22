<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDelegatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_delegates');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $delegate = request()->route('delegate');

        return [
            'name' => ['required','string','min:5','unique:delegates,name,'.$delegate->id,'max:255',new NotNumbersOnly()],
            'phone'    => ['required','numeric','unique:delegates,phone,' . $delegate->id,'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'commission' => 'required|numeric',
            'IBAN' => 'required|string|max:255|unique:delegates,IBAN,'.$delegate->id,
            'bank_id' => 'required|exists:banks,id',
        ];
    }
}
