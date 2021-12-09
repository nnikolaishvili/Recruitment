<?php

namespace Database\Seeders;

use App\Models\{HiringStatus, Position, Seniority, Skill, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        if (!User::count()) {
            $this->call(UsersTableSeeder::class);
        }

        if (!HiringStatus::count()) {
            $this->call(HiringStatusesTableSeeder::class);
        }

        if (!Seniority::count()) {
            $this->call(SenioritiesTableSeeder::class);
        }

        if (!Position::count()) {
            $this->call(PositionsTableSeeder::class);
        }

        if (!Skill::count()) {
            $this->call(SkillsTableSeeder::class);
        }
    }
}
