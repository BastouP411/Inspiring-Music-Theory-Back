<?php

namespace Database\Seeders;

use App\Models\AchievementChapters;
use App\Models\AchievementMGQ;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        CoursesRepresentationSeeder::run();

        School::factory()
            ->has(User::factory()->count(4))
            ->count(10)
            ->create();

        DB::table('users')->insert([
            'name' => 'Super',
            'lastname' => 'Admin',
            'email' => 'admin@admin.fr',
            'password' => Hash::make('adminadmin'),
            'school_id' => 1,
            'type' => 2,
        ]);
    }
}
