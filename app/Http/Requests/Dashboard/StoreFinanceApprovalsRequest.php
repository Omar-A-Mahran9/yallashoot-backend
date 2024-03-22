<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreFinanceApprovalsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_finance_approvals');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'approval_date' => 'required|date',
            'approval_amount' => 'required|numeric ',
            'tax_discount' => 'required|numeric ',
            'discount_percent' => 'required|numeric ',
            'discount_amount' => 'required|numeric ',
            'cashback_percent' => 'required|numeric ',
            'cashback_amount' => 'required|numeric ',
            'cashback_amount' => 'required|numeric ',
            'cost' => 'required|numeric ',
            'plate_no_cost' => 'required|numeric ',
            'insurance_cost' => 'required|numeric ',
            'delivery_cost' => 'required|numeric ',
            'commission' => 'nullable|numeric ',
            'profit' => 'required|numeric ',
            'Main_car_cost'=>'required|numeric ',
            'extra_details' => 'nullable|string',
            'delegate_id' => 'required|exists:delegates,id',
        ];
    }
}
