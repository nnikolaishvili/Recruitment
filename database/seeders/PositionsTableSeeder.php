<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Back-end Developer',
            'Front-end Developer',
            'Full-stack Developer',
            'Data Scientist',
            'DevOps / System Administrator',
            'QA Tester',
            'UI / UX Designer',
            'Project Manager',
            'Human Resources',
        ];

        $positionInsertData = [];

        foreach ($positions as $position) {
            $positionInsertData [] = [
                'name' => $position,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Position::insert($positionInsertData);

        Cache::forever('positions', Position::all());
    }
}
