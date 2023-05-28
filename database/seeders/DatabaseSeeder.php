<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Candidate;
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
        User::factory()->create([
            'username' => 'tester',
            'password' => bcrypt('PASSWORD'),
            'last_login' => Carbon::now(),
            'is_active' => 1,
            'role' => 'manager'
        ]);

        User::factory()->create([
            'username' => 'agend',
            'password' => bcrypt('PASSWORD'),
            'last_login' => Carbon::now(),
            'is_active' => 1,
            'role' => 'agent'
        ]);

        User::factory(11)->create();
        Candidate::factory(50)->create();
    }
}
