<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SalaryValidation implements Rule
{
    const MIN_SALARY = 'min_salary';
    const MAX_SALARY = 'max_salary';

    protected string $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(protected $secondSalary)
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (is_null($this->secondSalary)) {
            return true;
        }

        if ($attribute === self::MIN_SALARY && $value > $this->secondSalary) {
            $this->message = "The min salary must be less than or equal to $this->secondSalary";

            return false;
        }

        if ($attribute === self::MAX_SALARY && $value <= $this->secondSalary) {
            $this->message = "The max salary must be greater than $this->secondSalary";

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
