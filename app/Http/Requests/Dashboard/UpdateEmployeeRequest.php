<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_employees');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $employee = request()->route('employee');
         return [
            'name'     => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'phone'    => ['required','numeric','unique:employees,phone,' . $employee->id,'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'password' => ['nullable','exclude_if:password,null','string','min:8','max:255',new PasswordValidate(),'confirmed'],
            'password_confirmation' => ['nullable','exclude_if:password_confirmation,null','same:password'],
            'email'    => ['required','string','unique:employees,email,' . $employee->id],
            'roles'    => ['required','array','min:1'],
        ];
    }
}
