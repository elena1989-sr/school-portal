<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAnswer;
use App\Models\Test;
use App\Models\Question;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        $answers = \App\Models\StudentAnswer::with('question.test.subject')
            ->where('user_id', $student->id)
            ->whereHas('question.test')
            ->get();

        $results = $answers->groupBy(function ($item) {
            return $item->question->test->id;
        })->map(function ($testAnswers) {
            $test = $testAnswers->first()->question->test;
            $total = $testAnswers->count();
            $correct = $testAnswers->where('is_correct', true)->count();
            $wrong = $total - $correct;
            $percentage = $total > 0 ? round($correct / $total * 100) : 0;

            return [
                'test_title' => $test->title,
                'subject' => $test->subject->name,
                'correct' => $correct,
                'wrong' => $wrong,
                'total' => $total,
                'percentage' => $percentage
            ];
        });

        // dd($results);
        return view('student.dashboard', compact('results'));
    }
}
