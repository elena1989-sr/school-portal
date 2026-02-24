<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Panel</title>

 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-mint text-white p-6 shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Student Panel</h2>

        <nav class="space-y-3">
            <a href="{{ route('student.dashboard') }}" class="block p-2 rounded hover:bg-blue-100 text-white">
                Dashboard
            </a>

            <a href="{{ route('student.subjects') }}" class="block p-2 rounded hover:bg-blue-100 text-white">
                My Tests
            </a>

            <a href="{{ route('student.results.index') }}" class="block p-2 rounded hover:bg-blue-100 text-white">
                Results
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block p-2 rounded w-full text-left text-white hover:bg-blue-100">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

@yield('scripts')

</body>
</html>