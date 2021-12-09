<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            'HTML',
            'CSS',
            'Javascript',
            'jQuery',
            'Bootstrap',
            'Tailwind CSS',
            'React',
            'Vue',
            'Angular',
            'PHP',
            'Laravel',
            'Python',
            'Django',
            'Node JS',
            'MySQL',
            'PostgreSQL',
            'SQLite',
            'MongoDB',
        ];
        $skillInsertData = [];

        foreach ($skills as $skill) {
            $skillInsertData [] = [
                'name' => $skill,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Skill::insert($skillInsertData);

        Cache::forever('skills', Skill::all());
    }
}
