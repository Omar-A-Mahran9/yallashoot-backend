<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_employees');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'phone'     => ['required','numeric','unique:employees,phone', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'password' => ['required', 'string', 'min:8', 'max:255',new PasswordValidate(), 'confirmed'],
            'password_confirmation' => ['required','same:password'],
            'email'     => ['required','string', "email:rfc,dns",'unique:employees,email,'],
            'roles'     => ['required','array','min:1'],
        ];
    }
}
