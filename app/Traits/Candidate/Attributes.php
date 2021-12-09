<?php

namespace App\Traits\Candidate;

trait Attributes
{
    /**
     * Get CV full path
     *
     * @return string|null
     */
    public function getCvFullPathAttribute(): ?string
    {
        return $this->cv_url ? url($this->cv_url) : null;
    }

    /**
     * Get candidate's full name
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * Get CV file name
     *
     * @return string|null
     */
    public function getCvNameAttribute(): ?string
    {
        return $this->cv_url ? basename($this->cv_url) : null;
    }

    /**
     * Get current employer
     *
     * @param $value
     * @return string
     */
    public function getCurrentEmployerAttribute($value): string
    {
        return $value ?: 'unemployed';
    }

    /**
     * Get description
     *
     * @param $value
     * @return string
     */
    public function getDescriptionAttribute($value): string
    {
        return $value ?: 'No description';
    }

    /**
     * Get salary range
     *
     * @return string
     */
    public function getSalaryRangeAttribute(): string
    {
        if (!$this->min_salary && !$this->max_salary) {
            return 'No salary range';
        }

        return ($this->min_salary ?? 0) . ' - ' . ($this->max_salary ?? '∞');
    }
}
