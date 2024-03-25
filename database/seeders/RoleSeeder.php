<?php

namespace Database\Seeders;

use App\Domain\Roles\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        print_r('Role creating...!'.PHP_EOL);
        $roles = ['Doctor', 'Register', 'Nurse'];
        for ($i = 0; $i < count($roles); $i++) {
            Role::create([
                'title' => $roles[$i]
            ]);
        }
    }
}
