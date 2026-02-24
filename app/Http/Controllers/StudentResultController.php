<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAnswer;
use App\Models\Test;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentResultController extends Controller
{
    public function index()
    {
        $student = Auth::user();


        $answers = StudentAnswer::with('question.test.subject')
            ->where('user_id', $student->id)
            ->whereHas('question.test')
            ->get();


        $results = $answers->groupBy(function ($item) {
            return $item->question?->test?->id ?? 0;
        })->filter(function ($group, $testId) {

            return $testId !== 0;
        })->map(function ($testAnswers) {
            $test = $testAnswers->first()->question->test;
            $subject = $test->subject;

            $correct = $testAnswers->where('is_correct', true)->count();
            $wrong = $testAnswers->where('is_correct', false)->count();

            return [
                'subject' => $subject->name,
                'test' => $test->title,
                'correct' => $correct,
                'wrong' => $wrong,
            ];
        });

        return view('student.results.index', compact('results'));
    }
    public function downloadPdf($testId)
    {
        $student = auth()->user();
        $test = Test::with('questions')->findOrFail($testId);

        $answers = StudentAnswer::where('user_id', $student->id)
            ->whereIn('question_id', $test->questions->pluck('id'))
            ->get();

        $correct = $answers->where('is_correct', true)->count();
        $total = $test->questions->count();
        $percentage = $total > 0 ? round(($correct / $total) * 100) : 0;

        $pdf = Pdf::loadView('student.results.pdf', compact(
            'student',
            'test',
            'correct',
            'total',
            'percentage'
        ));

        return $pdf->download(
            'test-result-' . $student->name . '-' . date('Y-m-d') . '.pdf'
        );
    }
}
