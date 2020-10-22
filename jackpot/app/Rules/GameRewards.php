<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GameRewards implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $rewards)
    {
        //
        $gameRewards = collect($rewards)->filter(function ($value, $key) {
            return $value['name'] && $value['value_percent'] >= 0;
        })->toArray();
        if(count($gameRewards) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field is required.';
    }
}
