<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SpecialPassword extends Password implements Rule
{
    /**
     * If the password requires at least one letter.
     *
     * @var bool
     */
    protected $letters = true;
}
