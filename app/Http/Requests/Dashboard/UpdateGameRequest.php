<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\GameStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_games');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team_one_id' => 'required|exists:teams,id',
            'team_two_id' => 'required|exists:teams,id',
            'league_id' => 'required|exists:leagues,id',
            'playground_id' => 'required|exists:playgrounds,id',
            'country_id' => 'required|exists:countries,id',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i,after:start_time',
            'status' => ['required', Rule::in(GameStatus::values())],
            'channel_ids' => [
                'required',
                'array',
            ],
        ];
    }
}
