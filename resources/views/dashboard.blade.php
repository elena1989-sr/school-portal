@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-8">
        Teacher Dashboard
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Create Test -->
        <a href="{{ route('teacher.tests.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-xl shadow-lg transition duration-200">
            <h2 class="text-xl font-semibold mb-2">Create New Test</h2>
            <p>Create a new test with questions and answers.</p>
        </a>

        <!-- My Tests -->
        <a href="#"
           class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-xl shadow-lg transition duration-200">
            <h2 class="text-xl font-semibold mb-2">My Tests</h2>
            <p>View and manage your tests.</p>
        </a>

        <!-- Results -->
        <a href="#"
           class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-xl shadow-lg transition duration-200">
            <h2 class="text-xl font-semibold mb-2">Student Results</h2>
            <p>See how students performed.</p>
        </a>

    </div>

</div>