@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center flex flex-col justify-center items-center"
     style="background-image: url('{{ asset('images/school.jpeg') }}');">

    <div class="rounded-lg text-center">
        <h1 class="text-4xl font-bold text-white mb-4">
            Welcome to School Portal
        </h1>

        <h2 class="text-gray-200 mb-6">
            Please login or register to continue
        </h2>

        <div class="flex space-x-4 justify-center">
            <a href="{{ route('login') }}"
               class="px-6 py-2 bg-blue-600 text-white rounded transition btn-login">
               Login
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-2 bg-green-600 text-white rounded transition btn-register">
               Register
            </a>
        </div>
    </div>

</div>
@endsection