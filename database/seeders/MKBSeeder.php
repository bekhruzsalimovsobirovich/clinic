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
        print_r('MKB-10 creating...'.PHP_EOL);
        MKB::truncate();
        $csvData = fopen(public_path('mkb10.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                MKB::create([
                    'code' => $data['0'],
                    'name' => $data['1'],
                    'parent_code' => $data['2'],
                    'updated_at' => now()
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
