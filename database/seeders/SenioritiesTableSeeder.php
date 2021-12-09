<?php

namespace Database\Seeders;

use App\Models\Seniority;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SenioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seniorities = [
            'Intern',
            'Junior',
            'Middle',
            'Senior',
            'Lead',
        ];
        $senioritiesInsertData = [];

        foreach ($seniorities as $seniority) {
            $senioritiesInsertData [] = [
                'name' => $seniority,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Seniority::insert($senioritiesInsertData);

        Cache::forever('seniorities', Seniority::all());
    }
}
