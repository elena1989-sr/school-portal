<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        $tests = Test::where('teacher_id', $teacherId)->with('questions')->get();

        //dd($tests);
        $totalTests = $tests->count();

        $totalQuestions = $tests->sum(function ($test) {
            return $test->questions->count();
        });

        $answers = StudentAnswer::whereHas('question.test', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->get();



        $totalStudents = $answers->pluck('user_id')->unique()->count();

        $correct = $answers->where('is_correct', true)->count();
        $total = $answers->count();

        $averageScore = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

        /* dd(compact(
            'totalTests',
            'totalQuestions',
            'totalStudents',
            'averageScore'
        )); */

        return view('teacher.dashboard', compact(
            'totalTests',
            'totalQuestions',
            'totalStudents',
            'averageScore'
        ));
    }
}
