<?php

namespace Database\Seeders;

use App\Models\HiringStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class HiringStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hiringStatuses = [
            'Initial',
            'First Contact',
            'Interview',
            'Tech Assignment',
            'Rejected',
            'Hired',
        ];
        $hiringStatusesInsertData = [];

        foreach ($hiringStatuses as $hiringStatus) {
            $hiringStatusesInsertData [] = [
                'name' => $hiringStatus,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        HiringStatus::insert($hiringStatusesInsertData);
        Cache::forever('hiring-statuses', HiringStatus::all());
    }
}
