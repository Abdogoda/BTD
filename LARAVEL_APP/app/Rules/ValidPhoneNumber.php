<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule{
    public function passes($attribute, $value){
        return preg_match('/^01[0125]\d{8}$/', $value);
    }

    public function message(){
        return 'The :attribute must be a valid phone number starting with 01 then 0,1,2,5 and followed by 8 digits.';
    }
}