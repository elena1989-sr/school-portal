@extends('layouts.student')

@section('content')
<h1 class="text-2xl font-bold mb-4">My Results</h1>

@if($results->isEmpty())
    <p>You have not taken any tests yet.</p>
@else
    <table class="table-auto border-collapse border border-gray-300 w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Subject</th>
                <th class="border border-gray-300 px-4 py-2">Test</th>
                <th class="border border-gray-300 px-4 py-2">Correct</th>
                <th class="border border-gray-300 px-4 py-2">Wrong</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $res)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $res['subject'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $res['test'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $res['correct'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $res['wrong'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection