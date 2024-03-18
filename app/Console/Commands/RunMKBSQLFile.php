<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunMKBSQLFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:mkb {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run mkb sql file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');

        // Check if the file exists
        if (!file_exists($file)) {
            $this->error('SQL file not found.');
            return;
        }

        // Read the SQL file content
        $sql = file_get_contents($file);

        // Execute the SQL queries
        DB::unprepared($sql);

        $this->info('SQL file executed successfully.');
    }
}
