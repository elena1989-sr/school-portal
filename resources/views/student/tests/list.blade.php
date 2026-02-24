@extends('layouts.student')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Tests for {{ $subject->name }}</h1>

    @if($tests->isEmpty())
        <div class="p-4 bg-yellow-100 rounded">No tests available for this subject.</div>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach($tests as $test)
            <a href="{{ route('student.tests.show', $test->id) }}"
               class="p-4 bg-green-500 text-white rounded hover:bg-green-600">
               {{ $test->title }}
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection