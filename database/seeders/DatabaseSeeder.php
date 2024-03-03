<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Domain\Roles\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $roles = ['Doctor', 'Register', 'Nurse'];
        for ($i = 0; $i < count($roles); $i++) {
            Role::create([
                'title' => $roles[$i]
            ]);
        }

        \App\Models\User::create([
            'name' => 'Admin',
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);
        \App\Models\User::create([
            'name' => 'Register',
            'login' => 'register',
            'password' => Hash::make('register'),
            'role_id' => 2
        ]);
        \App\Models\User::create([
            'name' => 'Nurse',
            'login' => 'nurse',
            'password' => Hash::make('nurse'),
            'role_id' => 3
        ]);
    }
}
