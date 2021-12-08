<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HiringStatus extends Model
{
    use HasFactory;

    const INITIAL = 1;
    const REJECTED = 5;

    const ITEMS_PER_PAGE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Hiring status candidates
     *
     * @return BelongsToMany
     */
    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(Candidate::class)->withPivot('comment')->withTimestamps();
    }
}
