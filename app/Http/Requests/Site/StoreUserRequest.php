<?php

namespace App\Http\Requests\Site;

use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required','string','max:255','unique:vendors,name',new NotNumbersOnly()],
            'phone' => ['required','string','unique:vendors,phone','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'identity_no' => 'required_if:type,individual|nullable|unique:vendors,identity_no|numeric|digits:10',      
            'commercial_registration_no' => 'required_if:type,exhibition,agency|nullable|unique:vendors,commercial_registration_no',
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed',new PasswordValidate()],
            'password_confirmation' => ['required','same:password'],
            'city_id' => 'required|exists:cities,id',
            'type' => 'required',
            'link'=>'nullable',
        ];
    }
}
 