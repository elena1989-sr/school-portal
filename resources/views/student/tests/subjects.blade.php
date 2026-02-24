@extends('layouts.student')

@section('content')
<h1 class="text-2xl font-bold mb-4">Subjects</h1>

<ul class="space-y-2">
    @foreach($subjects as $subject)
        <li>
            <a href="{{ route('student.tests.list', $subject) }}" class="text-blue-600 hover:underline">
                {{ $subject->name }}
            </a>
        </li>
    @endforeach
</ul>
@endsection