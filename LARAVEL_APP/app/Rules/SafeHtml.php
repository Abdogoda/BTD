<?php

namespace App\Rules;

use Closure;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Contracts\Validation\Rule;

class SafeHtml implements Rule{
    protected $purifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,b,a[href],i,ul,ol,li,br,table,thead,tbody,col,colgroup,tr,td,th,h1,h2,h3,h4,h5,h6'); // Add allowed tags and attributes
        $this->purifier = new HTMLPurifier($config);
    }

    public function passes($attribute, $value)
    {
        $cleaned = $this->purifier->purify($value);
        return $cleaned === $value;
    }

    public function message()
    {
        return 'The :attribute contains disallowed HTML tags or attributes.';
    }
}