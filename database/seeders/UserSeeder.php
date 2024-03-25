<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        print_r('User creating...'.PHP_EOL);
        User::create([
            'name' => 'Admin',
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Register',
            'login' => 'register',
            'password' => Hash::make('register'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Nurse',
            'login' => 'nurse',
            'password' => Hash::make('nurse'),
            'role_id' => 3
        ]);
    }
}
