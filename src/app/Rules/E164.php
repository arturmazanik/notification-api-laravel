<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class E164 implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isE164($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be in E.164 phone format';
    }

    /**
     * Format example +15555555555
     * @param  string  $value The phone number to check is it correct format?
     * @return boolean
     */
    protected function isE164($value)
    {
        $conditions = [];
        $conditions[] = strpos($value, "+") === 0;
        $conditions[] = strlen($value) >= 9;
        $conditions[] = strlen($value) <= 16;
        $conditions[] = preg_match("/[^\d+]/i", $value) === 0;
        return (bool) array_product($conditions);
    }
}
