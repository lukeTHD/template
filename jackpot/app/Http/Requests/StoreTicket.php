<?php

namespace App\Http\Requests;

use App\Rules\SackCheck;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicket extends FormRequest
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
            'tickets' => 'required|array',
            'tickets.*' => 'required|array',
            'game_id' => 'required|exists:games,id'
        ];
    }
}
