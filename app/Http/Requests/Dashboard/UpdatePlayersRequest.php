<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_players');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $player = request()->route('player');
         return [
            'name_ar'    => ['required' , 'string' , 'max:255' , 'unique:players,name_ar,'.$player->id,new NotNumbersOnly()],
            'name_en'    => ['required' , 'string' , 'max:255' , 'unique:players,name_en,'.$player->id,new NotNumbersOnly()],
            'country_id'    => ['required'],
            'team_id'    => ['required'],
            'player_no'    => ['required','numeric'],
            'phone'    =>  ['required','numeric'],
            'email'    => ['required'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'birth_date' => 'required|date|before_or_equal:' . Carbon::now()->subYears(16)->toDateString(),
            'main_image'      => 'nullable|mimes:jpeg,png,jpg,webp,svg|max:2048' ,
        ];
    }
}