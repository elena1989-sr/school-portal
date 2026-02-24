<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $studentRole = Role::where('name', 'student')->first();
        $teacherRole = Role::where('name', 'teacher')->first();

        // Students
        User::create([
            'name' => 'Elena Petrova',
            'email' => 'elena@example.com',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id
        ]);

        User::create([
            'name' => 'Marko Iliev',
            'email' => 'marko@example.com',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id
        ]);

        // Teacher
        User::create([
            'name' => 'Ana Stojanovska',
            'email' => 'ana@example.com',
            'password' => Hash::make('password'),
            'role_id' => $teacherRole->id
        ]);
    }
}
