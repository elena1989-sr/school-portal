@extends('layouts.student')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6">Tests for: {{ $subject->name }}</h1>

    @if($tests->isEmpty())
        <div class="bg-yellow-100 p-4 rounded">
            No tests available for this subject.
        </div>
    @else
        <div class="flex gap-4 flex-wrap">
            @foreach($tests as $test)
                <a href="{{ route('student.tests.show', $test->id) }}"
                   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 whitespace-nowrap">
                    {{ $test->title }}
                </a>
            @endforeach
        </div>
    @endif

</div>
@endsection