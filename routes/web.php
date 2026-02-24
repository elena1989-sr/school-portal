<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentTestController;
use App\Http\Controllers\StudentResultController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherTestController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\TeacherDashboardController;

// Главна страница
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (за сите auth корисници)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// STUDENT ROUTES

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    Route::get('/subjects', [StudentTestController::class, 'subjects'])->name('subjects');

    Route::get('/subjects/{subject}/tests', [StudentTestController::class, 'testsBySubject'])
        ->name('subject.tests');

    Route::get('/tests/{test}', [StudentTestController::class, 'show'])->name('tests.show');

    Route::post('/tests/{test}/submit', [StudentTestController::class, 'submit'])->name('tests.submit');

    Route::get('/results', [StudentResultController::class, 'index'])->name('results.index');

    Route::get('/results/{test}/pdf', [StudentResultController::class, 'downloadPdf'])->name('results.pdf');
});


// TEACHER ROUTES

Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {

    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

    Route::get('/tests', [TeacherTestController::class, 'index'])->name('tests.index');
    Route::get('/tests/create', [TeacherTestController::class, 'create'])->name('tests.create');
    Route::post('/tests', [TeacherTestController::class, 'store'])->name('tests.store');
    Route::get('/tests/{test}', [TeacherTestController::class, 'show'])->name('tests.show');
    Route::delete('/tests/{test}', [TeacherTestController::class, 'destroy'])->name('tests.destroy');
    Route::get('/tests/filter', [TeacherTestController::class, 'filter'])->name('tests.filter');


    Route::get('/subjects', [TeacherSubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [TeacherSubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [TeacherSubjectController::class, 'store'])->name('subjects.store');
});


require __DIR__ . '/auth.php';
