@extends('layouts.teacher')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Subjects</h1>
        <a href="{{ route('teacher.subjects.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg bg-mint">
            + Create Subject
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr class="border-t">
                        <td class="px-6 py-3">{{ $subject->name }}</td>
                        <td class="px-6 py-3">{{ $subject->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection