<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex">

    <!-- Sidebar -->
    <div class="w-64 bg-indigo-700 text-white min-h-screen p-5 bg-mint">
        <h2 class="text-2xl font-bold mb-8">Teacher Panel</h2>

        <nav class="space-y-3">
            <a href="{{ route('teacher.dashboard') }}" class="block p-2 rounded">
                Dashboard
            </a>
            <a href="{{ route('teacher.tests.index') }}" class="block p-2 rounded">
                Tests
            </a>
            
            <a href="{{ route('teacher.subjects.index') }}" class="block p-2 rounded">
               Subjects
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block p-2 rounded">
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Content -->
    <div class="flex-1 p-8">
        @yield('content')
    </div>

</div>

</body>
</html>