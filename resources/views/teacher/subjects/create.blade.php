@extends('layouts.teacher')

@section('content')
<div class="max-w-xl mx-auto py-10 px-6">

    <h1 class="text-2xl font-bold mb-6">Create New Subject</h1>

    <form method="POST" action="{{ route('teacher.subjects.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium text-gray-700 mb-1">Subject Name</label>
            <input type="text"
                   name="name"
                   class="w-full border rounded-lg p-2"
                   placeholder="Enter subject name">
        </div>

        @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg bg-mint">
            Create Subject
        </button>
    </form>

</div>
@endsection