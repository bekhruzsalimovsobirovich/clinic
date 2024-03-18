<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MKBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Call the custom Artisan command to run the SQL file
//        Artisan::call('sql:mkb', [
//            'file' => public_path('mkb_data.sql'),
//        ]);

        $sqlPath = public_path('mkb_data.sql'); // Path to your SQL file
        $sqlContent = File::get($sqlPath);
        $sqlQueries = explode(';', $sqlContent);

        foreach ($sqlQueries as $query) {
            if (!empty(trim($query))) {
                DB::statement($query);
            }
        }
    }
}
