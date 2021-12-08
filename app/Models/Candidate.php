<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'min_salary',
        'max_salary',
        'description',
        'education',
        'current_employer',
        'position_id',
        'seniority_id',
        'hiring_status_id',
        'linkedin_url',
        'cv_url'
    ];

    /**
     * Candidate's position
     *
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Candidate's seniority
     *
     * @return BelongsTo
     */
    public function seniority(): BelongsTo
    {
        return $this->belongsTo(Seniority::class);
    }

    /**
     * Candidate's Hiring Status
     *
     * @return BelongsTo
     */
    public function hiringStatus(): BelongsTo
    {
        return $this->belongsTo(HiringStatus::class);
    }

    /**
     * Candidate's Hiring Status
     *
     * @return BelongsToMany
     */
    public function hiringStatuses(): BelongsToMany
    {
        return $this->belongsToMany(HiringStatus::class)->withPivot('comment')->withTimestamps();
    }

    /**
     * Candidate's skills
     *
     * @return BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->using(CandidateSkill::class);
    }

    /**
     * Get CV full path
     *
     * @return string|null
     */
    public function getCvFullPathAttribute(): ?string
    {
        return $this->cv_url ? config('app.url') . '/' . $this->cv_url : null;
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

    /**
     * Check if candidate became rejected
     *
     * @return bool
     */
    public function isRejected(): bool
    {
        return $this->hiring_status_id == HiringStatus::REJECTED;
    }
}
