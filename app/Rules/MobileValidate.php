<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileValidate implements Rule
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
    public function passes($attribute, $value)
    {
        $len=strlen($value);
        if(is_numeric($value))
        {
            if($len==11)
            {
                if($value[0]=="0" && $value[1]=="9")
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else if($len==10)
            {
                if($value[0]=="9")
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره موبایل وارد شده اشتباه میباشد!';
    }
}
