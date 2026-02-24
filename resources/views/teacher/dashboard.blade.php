@extends('layouts.teacher')

@section('content')
<h1 class="text-3xl font-bold mb-6">Welcome {{ auth()->user()->name}} 👩‍🏫</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm">Total Tests</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">
            {{ $totalTests }}
        </p>
    </div>


    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm">Total Questions</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">
            {{ $totalQuestions }}
        </p>
    </div>

   
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm">Total Students</h3>
        <p class="text-3xl font-bold text-purple-600 mt-2">
            {{ $totalStudents }}
        </p>
    </div>

    
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm">Average Success</h3>
        <p class="text-3xl font-bold text-red-600 mt-2">
            {{ $averageScore }}%
        </p>
    </div>
@endsection