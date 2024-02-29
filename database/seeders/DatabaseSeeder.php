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

        Role::create([
            'title' => 'Doctor'
        ]);

         \App\Models\User::create([
             'name' => 'Admin',
             'login' => 'admin',
             'password' => Hash::make('admin'),
             'role_id' => 1
         ]);
    }
}
