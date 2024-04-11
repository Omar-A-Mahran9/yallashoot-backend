<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_channel');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $channel = request()->route('channel');
         return [
            'title_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('channels')->ignore($channel->id),
                                new NotNumbersOnly()
            ],
            'title_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('channels')->ignore($channel->id),
                new NotNumbersOnly()
            ],
            "commenter_name_ar" => 'required|string|max:255',
            "commenter_name_en" => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'satellites' => ['required','array'],
            'satellites.*.name' => ['required'],
            'satellites.*.frequency' => ['required'],
            'satellites.*.polarization' => ['required'],
            'satellites.*.modulation' => ['required'],
            'satellites.*.correction' => ['required'],
            'satellites.*.encryption' => ['required'],
            'main_image'      => 'nullable|mimes:jpeg,png,jpg,webp,svg|max:2048' ,

        ];
 
    }
}
