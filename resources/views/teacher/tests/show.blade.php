@extends('layouts.teacher')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h1 class="text-2xl font-bold">{{ $test->title }}</h1>
        <p class="text-gray-500">Subject: {{ $test->subject->name }}</p>
        <p class="text-gray-500">Created: {{ $test->created_at->format('d.m.Y') }}</p>
    </div>

    <div class="space-y-6">
        @foreach($test->questions as $index => $q)
            <div class="bg-gray-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <h2 class="font-semibold text-gray-800">Q{{ $index + 1 }}: {{ $q->question }}</h2>
                <ul class="list-disc ml-5 mt-2 text-gray-700">
                    <li>A: {{ $q->option_a }}</li>
                    <li>B: {{ $q->option_b }}</li>
                    <li>C: {{ $q->option_c }}</li>
                    <li>D: {{ $q->option_d }}</li>
                </ul>
                <p class="mt-2 font-semibold text-green-700">Correct Answer: {{ $q->correct_answer }}</p>
            </div>
        @endforeach
    </div>

</div>
@endsection