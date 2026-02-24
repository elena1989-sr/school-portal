@extends('layouts.teacher')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-6">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Create New Test
        </h1>
        <p class="text-gray-500 mt-2">
            Add subject, title and questions below.
        </p>
    </div>

    <!-- Success -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.tests.store') }}" class="space-y-8">
        @csrf

        <!-- Test Info Card -->
        <div class="bg-white shadow-lg rounded-2xl p-6 space-y-6">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Subject
                </label>
                <select name="subject_id"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Test Title
                </label>
                <input type="text" name="title"placeholder="Example: Mathematics Final Test" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        
        @for($i = 0; $i < 3; $i++)
            <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">

                <!-- Question Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">
                        Question {{ $i+1 }}
                    </h2>
                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">
                        Required
                    </span>
                </div>

                <!-- Question Text -->
                <div>
                    <input type="text" name="questions[{{ $i }}][question]" placeholder="Enter your question..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Options Grid -->
                <div class="grid md:grid-cols-2 gap-4">

                    <input type="text"
                           name="questions[{{ $i }}][option_a]"
                           placeholder="Option A"
                           class="border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">

                    <input type="text"
                           name="questions[{{ $i }}][option_b]"
                           placeholder="Option B"
                           class="border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">

                    <input type="text"
                           name="questions[{{ $i }}][option_c]"
                           placeholder="Option C"
                           class="border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">

                    <input type="text"
                           name="questions[{{ $i }}][option_d]"
                           placeholder="Option D"
                           class="border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">

                </div>

                <!-- Correct Answer -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Correct Answer
                    </label>
                    <select name="questions[{{ $i }}][correct_answer]"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-400">
                        <option value="">Select correct answer</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

            </div>
        @endfor

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition duration-200  bg-mint">
                Save Test
            </button>
        </div>

    </form>

</div>

@endsection