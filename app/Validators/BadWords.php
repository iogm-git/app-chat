<?php

namespace App\Validators;

class BadWords
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $badWords = ['shit', 'fuck'];

        foreach ($badWords as $badWord) {
            if (stripos($value, $badWord) !== false) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The message contains inappropriate language.';
    }
}
