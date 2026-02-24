<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Subject;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherTestController extends Controller
{
    public function create()
    {
        $subjects = Subject::all();
        return view('teacher.tests.create', compact('subjects'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'questions.*.question' => 'nullable|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|in:A,B,C,D',
        ]);



        // 1️⃣ Креирај тест
        $test = Test::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'teacher_id' => auth()->id(),
        ]);

        // 2️⃣ Креирај прашања
        foreach ($request->questions as $q) {
            Question::create([
                'test_id' => $test->id,
                'subject_id' => $request->subject_id,
                'question' => $q['question'],
                'option_a' => $q['option_a'],
                'option_b' => $q['option_b'],
                'option_c' => $q['option_c'],
                'option_d' => $q['option_d'],
                'correct_answer' => $q['correct_answer'],
            ]);
            // dd("Validation i test passed i questions created");
        }

        return redirect()->route('teacher.tests.create')
            ->with('success', 'Test created successfully!');
    }
    public function index()
    {
        $teacherId = auth()->id();

        $tests = Test::where('teacher_id', $teacherId)
            ->with(['subject', 'questions'])
            ->orderBy('created_at', 'desc')
            ->get();

        $subjects = Subject::where('teacher_id', $teacherId)->get();

        return view('teacher.tests.index', compact('tests', 'subjects'));
    }
    public function destroy(Test $test)
    {

        if ($test->teacher_id !== auth()->id()) {
            abort(403);
        }

        $test->delete();

        return redirect()
            ->route('teacher.tests.index')
            ->with('success', 'Test deleted successfully.');
    }
    public function show(Test $test)
    {
        if ($test->teacher_id !== auth()->id()) {
            abort(403);
        }

        $test->load('questions'); // load questions for the view

        return view('teacher.tests.show', compact('test'));
    }

    public function filter(Request $request)
    {
        $teacherId = auth()->id();

        $tests = \App\Models\Test::where('teacher_id', $teacherId)
            ->when($request->subject_id, function ($query) use ($request) {
                $query->where('subject_id', $request->subject_id);
            })
            ->with('subject', 'questions')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($tests);
    }
}
