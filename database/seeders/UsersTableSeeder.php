<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'HR',
            'email' => 'hr@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123')
        ]);
    }
}
