<?php

namespace App\Http\Requests\Site;

use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string','unique:vendors,phone',new NotNumbersOnly],
            'phone' => ['required','string','unique:vendors,phone','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'identity_no' => 'required_if:user_type,3,2|nullable|unique:users,id_number|numeric|digits:10',
            'commercial_registration_no' => 'required_if:user_type,3,2|nullable|unique:users,commercial_register_namber',
            'password' => ['nullable','exclude_if:password,null','string','min:8','max:255',new PasswordValidate(),'confirmed'],
            'password_confirmation' => ['nullable','exclude_if:password_confirmation,null','same:password'],
            'city_id' => 'required|exists:cities,id',
         ];
    }
}
