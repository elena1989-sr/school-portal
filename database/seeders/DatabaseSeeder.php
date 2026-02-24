<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            SubjectsSeeder::class,
            TestsSeeder::class,
            \Database\Seeders\QuestionsSeeder::class,
            StudentAnswersSeeder::class,
        ]);
    }
}
