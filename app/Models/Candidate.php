<?php

namespace App\Models;

use App\Traits\Candidate\{Attributes, Relations};
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait, Relations, Attributes;

    const ITEMS_PER_PAGE = 10;

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
     * The searchable fields
     *
     * @var string[]
     */
    protected $searchable = [
        'name' => [
            'first_name',
            'last_name'
        ],
        'phone_number',
        'email'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function booted()
    {
        static::creating(function ($candidate) {
            $candidate->hiring_status_id = HiringStatus::INITIAL;
        });
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
