<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Test;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $englishTest1 = Test::where('title', 'English Level 1')->first();
        $englishTest2 = Test::where('title', 'English Level 2')->first();
        $mathTest1 = Test::where('title', 'Math Level 1')->first();
        $mathTest2 = Test::where('title', 'Math Level 2')->first();

        // -------------------
        // English Level 1
        // -------------------
        $questionsEnglish1 = [
            [
                'question' => 'What is the capital of France?',
                'options' => ['Paris', 'London', 'Berlin', 'Rome'],
                'correct' => 'A'
            ],
            [
                'question' => 'Which word is a noun?',
                'options' => ['Run', 'Apple', 'Quickly', 'Blue'],
                'correct' => 'B'
            ],
            [
                'question' => 'What is the opposite of "hot"?',
                'options' => ['Warm', 'Cold', 'Hotter', 'Cool'],
                'correct' => 'B'
            ],
            [
                'question' => 'Which is a verb?',
                'options' => ['Jump', 'Red', 'Apple', 'Tall'],
                'correct' => 'A'
            ],
            [
                'question' => 'Choose the correct spelling:',
                'options' => ['Recieve', 'Receive', 'Recive', 'Receve'],
                'correct' => 'B'
            ]
        ];

        foreach ($questionsEnglish1 as $q) {
            Question::create([
                'question' => $q['question'],
                'option_a' => $q['options'][0],
                'option_b' => $q['options'][1],
                'option_c' => $q['options'][2],
                'option_d' => $q['options'][3],
                'correct_answer' => $q['correct'],
                'test_id' => $englishTest1->id
            ]);
        }

        // -------------------
        // English Level 2
        // -------------------
        $questionsEnglish2 = [
            [
                'question' => 'Select the synonym for "happy":',
                'options' => ['Sad', 'Joyful', 'Angry', 'Tired'],
                'correct' => 'B'
            ],
            [
                'question' => 'Choose the correct article: ___ apple',
                'options' => ['A', 'An', 'The', 'No article'],
                'correct' => 'B'
            ],
            [
                'question' => 'Which is a preposition?',
                'options' => ['Under', 'Run', 'Quickly', 'Blue'],
                'correct' => 'A'
            ],
            [
                'question' => 'Select the past tense of "go":',
                'options' => ['Went', 'Go', 'Goes', 'Gone'],
                'correct' => 'A'
            ],
            [
                'question' => 'Choose the antonym of "strong":',
                'options' => ['Weak', 'Powerful', 'Tough', 'Firm'],
                'correct' => 'A'
            ]
        ];

        foreach ($questionsEnglish2 as $q) {
            Question::create([
                'question' => $q['question'],
                'option_a' => $q['options'][0],
                'option_b' => $q['options'][1],
                'option_c' => $q['options'][2],
                'option_d' => $q['options'][3],
                'correct_answer' => $q['correct'],
                'test_id' => $englishTest2->id
            ]);
        }

        // -------------------
        // Math Level 1
        // -------------------
        $questionsMath1 = [
            [
                'question' => 'Which number is even?',
                'options' => ['3', '7', '8', '5'],
                'correct' => 'C'
            ],
            [
                'question' => 'What is 5 + 7?',
                'options' => ['11', '12', '13', '10'],
                'correct' => 'B'
            ],
            [
                'question' => 'What is 9 - 4?',
                'options' => ['6', '5', '4', '7'],
                'correct' => 'B'
            ],
            [
                'question' => 'Which is a prime number?',
                'options' => ['4', '9', '7', '8'],
                'correct' => 'C'
            ],
            [
                'question' => 'What is 6 × 3?',
                'options' => ['18', '16', '20', '15'],
                'correct' => 'A'
            ]
        ];

        foreach ($questionsMath1 as $q) {
            Question::create([
                'question' => $q['question'],
                'option_a' => $q['options'][0],
                'option_b' => $q['options'][1],
                'option_c' => $q['options'][2],
                'option_d' => $q['options'][3],
                'correct_answer' => $q['correct'],
                'test_id' => $mathTest1->id
            ]);
        }

        // -------------------
        // Math Level 2
        // -------------------
        $questionsMath2 = [
            [
                'question' => 'What is 12 ÷ 4?',
                'options' => ['2', '3', '4', '5'],
                'correct' => 'B'
            ],
            [
                'question' => 'Which number is a square number?',
                'options' => ['2', '8', '9', '10'],
                'correct' => 'C'
            ],
            [
                'question' => 'What is 15 + 10?',
                'options' => ['20', '25', '30', '22'],
                'correct' => 'B'
            ],
            [
                'question' => 'What is 7 × 6?',
                'options' => ['42', '36', '48', '40'],
                'correct' => 'A'
            ],
            [
                'question' => 'What is 20 - 13?',
                'options' => ['6', '7', '8', '9'],
                'correct' => 'B'
            ]
        ];

        foreach ($questionsMath2 as $q) {
            Question::create([
                'question' => $q['question'],
                'option_a' => $q['options'][0],
                'option_b' => $q['options'][1],
                'option_c' => $q['options'][2],
                'option_d' => $q['options'][3],
                'correct_answer' => $q['correct'],
                'test_id' => $mathTest2->id
            ]);
        }
    }
}
