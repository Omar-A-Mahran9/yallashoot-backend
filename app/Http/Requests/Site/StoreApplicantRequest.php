<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
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
        $id = $this->route('career_id');
        return [
            'name' => ['bail', 'required', 'string', 'min:10', 'max:255'],
            'email' => ['bail', 'required', 'email:rfc,dns', 'max:255'],
            'phone' => ['bail', 'required', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'cv' => ['bail', 'required', 'file'],
            'career_id' => ['bail', 'required', 'exists:careers,id','in:'.$id],
        ];
    }
}
