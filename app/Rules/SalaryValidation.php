<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SalaryValidation implements Rule
{
    const MIN_SALARY = 'min_salary';
    const MAX_SALARY = 'max_salary';

    protected $secondSalary;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($salary)
    {
        $this->secondSalary = $salary;
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
        if ($attribute == self::MIN_SALARY && !is_null($this->secondSalary)) {
            if ($value > $this->secondSalary) {
                $this->message = "The min salary must be less than or equal to $this->secondSalary";

                return false;
            }
        } elseif ($attribute == self::MAX_SALARY && !is_null($this->secondSalary)) {
            if ($value <= $this->secondSalary) {
                $this->message = "The max salary must be greater than $this->secondSalary";

                return false;
            }
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
        return $this->message ?? 'The validation error';
    }
}
