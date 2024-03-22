<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreDelegatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_delegates');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string','min:5','unique:delegates','max:255',new NotNumbersOnly()],
            'phone'     => ['required','numeric','unique:delegates,phone,', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'commission' => 'required|numeric',
            'IBAN' => 'required|string|unique:delegates|unique:delegates,IBAN,',
            'bank_id' => 'required|exists:banks,id',
        ];
    }
}
