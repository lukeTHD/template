<?php

namespace App\Http\Requests;

use App\Rules\GameRewards;
use App\Rules\GameRewardsConfig;
use App\Rules\GameRewardsTotal;
use Illuminate\Foundation\Http\FormRequest;

class StoreGame extends FormRequest
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
            'number_pick' => 'required|integer|between:1,99',
            'number_max' => 'required|integer|between:1,99',
            'name' => 'required|max:255',
            'description' => 'required',
            'code' => 'required|max:255|unique:games,code',
            'algorithm' => 'required|max:255',
            'price' => 'required|integer',
            'start_time' => 'required',
            'roll_time' => 'required',
            'appear_time' => 'required',
            'status' => 'required|integer',
            'avatar' => 'required',
            'rewards' => ['required',new GameRewards, new GameRewardsTotal, new GameRewardsConfig]
        ];
    }
}
