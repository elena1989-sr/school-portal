@extends('layouts.student')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6"> My Tests</h1>

    <!-- Pending / Upcoming Tests -->
    <h2 class="text-xl font-semibold mb-4">Pending Tests</h2>
    @if(count($pendingTests))
        <div class="flex flex-wrap gap-4 mb-8">
            @foreach($pendingTests as $test)
                <a href="{{ route('student.tests.show', $test->id) }}"
                   class="flex-1 min-w-[200px] max-w-[250px] p-4 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition relative group"
                   title="Subject: {{ $test->subject->name }} | Questions: {{ $test->questions->count() }}">
                    <h3 class="text-lg font-semibold">{{ $test->title }}</h3>
                    <p class="text-sm mt-1">{{ $test->subject->name }}</p>
                    <p class="text-sm mt-1">{{ $test->questions->count() }} Questions</p>

                    <!-- Tooltip on hover -->
                    <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition">
                        Start this test
                    </span>
                </a>
            @endforeach
        </div>
    @else
        <p class="mb-8 text-gray-500">No pending tests.</p>
    @endif

    <!-- Completed / Past Tests -->
    <h2 class="text-xl font-semibold mb-4">Past Tests</h2>
    @if(count($completedTests))
        <div class="flex flex-wrap gap-4">
            @foreach($completedTests as $test)
                <div class="flex-1 min-w-[200px] max-w-[250px] p-4 bg-gray-300 text-gray-700 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold">{{ $test->title }}</h3>
                    <p class="text-sm mt-1">{{ $test->subject->name }}</p>
                    <p class="text-sm mt-1">{{ $test->questions->count() }} Questions</p>
                    <span class="text-xs mt-2 block text-gray-600">Completed</span>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No completed tests yet.</p>
    @endif

</div>
@endsection