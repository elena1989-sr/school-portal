<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\User;

class StudentAnswersSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::whereHas('role', fn($q) => $q->where('name', 'student'))->get();
        $questions = Question::all();

        foreach ($students as $student) {
            foreach ($questions as $question) {
                $options = ['A', 'B', 'C', 'D'];
                $randomAnswer = $options[array_rand($options)];
                $isCorrect = $randomAnswer === $question->correct_answer;

                StudentAnswer::firstOrCreate([
                    'user_id' => $student->id,
                    'question_id' => $question->id,
                    'selected_answer' => $randomAnswer,
                    'is_correct' => $isCorrect
                ]);
            }
        }
    }
}
