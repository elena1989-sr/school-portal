@extends('layouts.teacher')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"> Tests</h1>
        <a href="{{ route('teacher.tests.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
            + Create New Test
        </a>
    </div>

  
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    
    <div class="border-b mb-6">
        <nav class="flex space-x-6">
            <button class="tab-btn text-blue-600 font-semibold" data-tab="all">
                All Tests
            </button>
           <!-- <button class="tab-btn text-gray-500" data-tab="filter">
                Filter by Subject
            </button> -->
        </nav>
    </div>

   
    <div id="all" class="tab-content">

        @if($tests->isEmpty())
            <div class="bg-yellow-100 p-4 rounded">
                You haven't created any tests yet.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-left divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-sm font-medium text-gray-500">Subject</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-500">Title</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-500">Questions</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-500">Created</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($tests as $test)
                            <tr>
                                <td class="px-6 py-4">{{ $test->subject->name }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $test->title }}</td>
                                <td class="px-6 py-4">{{ $test->questions->count() }}</td>
                                <td class="px-6 py-4">{{ $test->created_at->format('d.m.Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('teacher.tests.show', $test->id) }}"
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                        View
                                    </a>

                                    <form method="POST" action="{{ route('teacher.tests.destroy', $test->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this test?')"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

    <!-- ================= FILTER TAB ================= -->
    <div id="filter" class="tab-content hidden">

        <div class="mb-4">
            <select id="subjectFilter" class="border p-2 rounded w-64">
                <option value="">All Subjects</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-left divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Subject</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Title</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Questions</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Created</th>
                    </tr>
                </thead>
                <tbody id="filteredTable"></tbody>
            </table>
        </div>

    </div>

</div>


<script>
// TAB SWITCH
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', function () {

        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-blue-600','font-semibold');
            btn.classList.add('text-gray-500');
        });

        document.getElementById(this.dataset.tab).classList.remove('hidden');
        this.classList.add('text-blue-600','font-semibold');
    });
});


// AJAX FILTER
document.getElementById('subjectFilter').addEventListener('change', function() {

    let subjectId = this.value;

    fetch("{{ route('teacher.tests.filter') }}?subject_id=" + subjectId)
        .then(res => res.json())
        .then(data => {
            let table = document.getElementById('filteredTable');
            table.innerHTML = '';

            if(data.length === 0){
                table.innerHTML = `<tr><td colspan="4" class="px-6 py-4 text-center">No tests found.</td></tr>`;
                return;
            }

            data.forEach(test => {
                table.innerHTML += `
                    <tr>
                        <td>${test.subject.name}</td>
                        <td>${test.title}</td>
                        <td>${test.questions.length}</td>
                        <td>${new Date(test.created_at).toLocaleDateString()}</td>
                    </tr>
                `;
            });
        })
        .catch(err => console.error(err));
});
</script>

@endsection