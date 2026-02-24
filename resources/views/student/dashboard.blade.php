@extends('layouts.student')

@section('content')
<h1 class="text-3xl font-bold mb-6">Statistics</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($results as $res)
        <div class="p-4 bg-white rounded shadow">
            <h2 class="font-bold text-lg">{{ $res['test_title'] }}</h2>
            <p class="text-gray-500">{{ $res['subject'] }}</p>

            <div class="mt-2">
                <div class="flex justify-between text-sm">
                    <span>Correct</span>
                    <span>{{ $res['correct'] }}/{{ $res['total'] }}</span>
                </div>
                <div class="w-full bg-gray-200 h-4 rounded mt-1">
                    <div class="bg-green-500 h-4 rounded" style="width: {{ $res['percentage'] }}%"></div>
                </div>
                <p class="text-right text-sm text-gray-600 mt-1">{{ $res['percentage'] }}%</p>
            </div>

            <div class="mt-2 flex justify-between text-sm">
                <span>Wrong</span>
                <span>{{ $res['wrong'] }}</span>
            </div>
        </div>
    @endforeach
</div>
@endsection