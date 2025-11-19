<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database using create.sql and populate.sql
     */
    public function run(): void
    {
        // 1. Run the Creation Script (Schema + Tables)
        $createPath = base_path('database/create.sql');
        
        if (!file_exists($createPath)) {
            $this->command->error("File not found: $createPath");
            return;
        }
        
        DB::unprepared(file_get_contents($createPath));
        $this->command->info('Tables created successfully.');

        // 2. Run the Populate Script (Insert Data)
        $populatePath = base_path('database/populate.sql');

        if (!file_exists($populatePath)) {
            $this->command->error("File not found: $populatePath");
            return;
        }

        DB::unprepared(file_get_contents($populatePath));
        $this->command->info('Database populated successfully.');
    }
}