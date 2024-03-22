<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_branches');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'       => ['required' , 'string' ,' unique:branches,name_ar', 'max:255',new NotNumbersOnly()],
            'name_en'       => ['required' , 'string' ,' unique:branches,name_en', 'max:255',new NotNumbersOnly()],
            'address_ar'    => 'required | string | max:255 ',
            'address_en'    => 'required | string | max:255 ',
            'phone'     => ['required','numeric','unique:branches,phone', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'whatsapp'      => ['required','numeric','unique:branches', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'frame'         => 'required | string',
            'status'        => 'required | in:invisible,visible',
            'lat'           => 'required',
            'lng'           => 'required',
            'city_id'       => 'required',
        ];
    }
}
