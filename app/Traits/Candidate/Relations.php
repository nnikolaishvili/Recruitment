<?php

namespace App\Traits\Candidate;

use App\Models\{CandidateSkill, HiringStatus, Position, Seniority, Skill};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

trait Relations
{
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
}
