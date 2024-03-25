<?php

namespace Database\Seeders;

use App\Domain\MKB\Models\MKB;
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

        MKB::truncate();
        $csvData = fopen(public_path('mkb10.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                MKB::create([
                    'name' => $data['1'],
                    'code' => $data['2'],
                    'parent_id' => $data['3'],
                    'parent_code' => $data['4'],
                    'node_count' => $data['5'],
                    'additional_info' => $data['6'],
//                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);

    }
}
