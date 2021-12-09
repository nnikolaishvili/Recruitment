<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait SearchableTrait
{
    /**
     * Scope a query to search with a value
     *
     * @param Builder $query
     * @param string $value
     * @throws Exception
     */
    public function scopeSearch(Builder $query, string $value)
    {
        if (!$this->searchable) {
            throw new Exception('Searchable property is missing from model');
        }

        if (!$value) {
            return;
        }

        array_map(function ($column) use ($query, $value) {
            if (is_array($column)) {
                $value = str_replace(" ", "", trim($value));
                $query->orWhere(DB::raw("CONCAT(" . implode(',', $column) . ")"), 'like', "%$value%");
            } else {
                $query->orWhere($column, 'like', "%$value%");
            }
        }, $this->searchable);
    }
}
