<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subject;

class TeacherSubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->get();
        return view('teacher.subjects.index', compact('subjects'));
    }
    public function create()
    {
        return view('teacher.subjects.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Subject::create([
            'name' => $request->name,
            'teacher_id' => auth()->id(),
        ]);

        return redirect()->route('teacher.subjects.index')->with('success', 'Subject created successfully.');
    }
}
