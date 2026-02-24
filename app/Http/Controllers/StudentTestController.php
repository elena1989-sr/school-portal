<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use App\Models\Subject;
use App\Models\StudentAnswer;


class StudentTestController extends Controller
{

    public function subjects()
    {
        $student = auth()->user();

        $subjects = Subject::all();


        $allTests = Test::with('subject', 'questions')->get();

        $pendingTests = [];
        $completedTests = [];

        foreach ($allTests as $test) {
            $answered = StudentAnswer::where('user_id', $student->id)
                ->whereIn('question_id', $test->questions->pluck('id'))
                ->exists();

            if ($answered) {
                $completedTests[] = $test;
            } else {
                $pendingTests[] = $test;
            }
        }

        return view('student.subjects.index', compact('pendingTests', 'completedTests', 'subjects'));
    }


    public function testsBySubject(Subject $subject)
    {
        $tests = Test::where('subject_id', $subject->id)->get();
        return view('student.tests.index', compact('tests', 'subject'));
    }


    public function show($testId)
    {
        $test = Test::with('questions')->findOrFail($testId);
        $student = auth()->user();

        $answered = StudentAnswer::where('user_id', $student->id)
            ->whereIn('question_id', $test->questions->pluck('id'))
            ->exists();

        if ($answered) {
            return redirect()->route('student.subjects')
                ->with('error', 'You have already completed this test.');
        }

        return view('student.tests.show', compact('test'));
    }

    public function submit(Request $request, Test $test)
    {
        $student = auth()->user();
        $exists = StudentAnswer::where('user_id', $student->id)
            ->whereIn('question_id', $test->questions->pluck('id'))
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Test already completed'], 403);
        }

        $answers = $request->answers; // ['question_id' => 'A/B/C/D']
        $results = [];
        $correctCount = 0;

        foreach ($test->questions as $question) {
            $isCorrect = ($answers[$question->id] ?? null) === $question->correct_answer;
            if ($isCorrect) $correctCount++;

            StudentAnswer::create([
                'user_id' => $student->id,
                'question_id' => $question->id,
                'answer' => $answers[$question->id] ?? null,
                'is_correct' => $isCorrect
            ]);

            $results[] = [
                'question' => $question->question,
                'your_answer' => $answers[$question->id] ?? null,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect
            ];
        }

        $total = $test->questions->count();
        $percentage = round(($correctCount / $total) * 100);

        return response()->json([
            'total' => $total,
            'correct' => $correctCount,
            'wrong' => $total - $correctCount,
            'percentage' => $percentage,
            'details' => $results
        ]);
    }
}
