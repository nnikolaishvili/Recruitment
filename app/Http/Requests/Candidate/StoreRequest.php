<?php

namespace App\Http\Requests\Candidate;

use App\Rules\SalaryValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|email|max:255',
            'min_salary' => ['nullable', 'integer', 'min:0', 'max:2147483647', new SalaryValidation($this->max_salary)],
            'max_salary' => ['nullable', 'integer', 'min:0', 'max:2147483647', new SalaryValidation($this->min_salary)],
            'education' => 'nullable|max:255',
            'description' => 'nullable',
            'current_employer' => 'nullable|max:255',
            'linkedin_url' => 'nullable|url',
            'cv' => 'sometimes|mimes:pdf|max:10240',
            'position_id' => 'required|exists:positions,id',
            'seniority_id' => 'required|exists:seniorities,id',
            'skills' => 'sometimes|array',
            'skills.*' => 'required',
        ];
    }
}
