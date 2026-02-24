<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Subject;

class TestsSeeder extends Seeder
{
    public function run(): void
    {
        $english = Subject::where('name', 'English')->first();
        $math = Subject::where('name', 'Mathematics')->first();

        Test::create(['title' => 'English Level 1', 'subject_id' => $english->id]);
        Test::create(['title' => 'English Level 2', 'subject_id' => $english->id]);

        Test::create(['title' => 'Math Level 1', 'subject_id' => $math->id]);
        Test::create(['title' => 'Math Level 2', 'subject_id' => $math->id]);
    }
}
