<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_packages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         $discountPrice = $request['monthly_price_after_discount'] ?? 0;
        return [
             'name_ar'    => ['required' , 'string' , 'max:255' ,' unique:packages',new NotNumbersOnly()],
             'name_en'    => ['required' , 'string' , 'max:255' ,' unique:packages',new NotNumbersOnly()],
            'description_ar'    => 'required | string | unique:packages',
            'description_en'    => 'required | string | unique:packages',
            'monthly_price' => 'required|numeric|gt:' . $discountPrice,
            'annual_price' => 'required|numeric|gt:monthly_price',
            'features' => 'required|array|min:1',
            'features.*' => 'required|exists:features,id',
            'discount_flag' => 'required|numeric',
            'values' => 'required|array|min:1',
            'values.*' => 'required|numeric',
            'monthly_price_after_discount' => [
                'required_if:discount_flag,1',
                'nullable',
                'numeric',
                'not_in:0',
                'lt:annual_price_after_discount',
                'lt:monthly_price',

             ],
         
            'annual_price_after_discount' => [
                'required_if:discount_flag,1',
                'nullable',
                'numeric',
                'gt:monthly_price_after_discount',
                'lt:annual_price',

             ],
            'discount_from_date' => [
                'required_if:discount_flag,1',
                'nullable',
                'date',
                'after_or_equal:' . now()->toDateString(), // Ensure it's not in the past
            ],
            'discount_to_date' => [
                'required_if:discount_flag,1',
                'nullable',
                'date',
                'after_or_equal:discount_from_date', // Ensure it's after discount_from_date
            ],
        ];
    }
}
