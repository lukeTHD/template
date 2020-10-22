<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GameRewardsConfig implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $rewards)
    {
        $flag = true;
//        collect($rewards)->each(function ($value) use (&$flag) {
//            if ((int)$value['share_new'] < 0 || (int)$value['share_company'] < 0 || (int)$value['share_up'] < 0 || (int)$value['share_level_2'] < 0 ) {
//                $flag = false;
//            }
//            $total = (int)$value['share_new'] + (int)$value['share_company'] + (int)$value['share_up'] + (int)$value['share_level_2'];
//            if ($total < 0 || $total > 100) {
//                $flag = false;
//            }
//        });
        return $flag;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute config must to >= 0 <= 100';
    }
}
