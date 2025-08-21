<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This loads `database/thingy-seed.sql`, replaces the `{{schema}}` placeholder
     * with the schema name defined in your .env (`DB_SCHEMA`), and executes it.
     *
     * Example:
     *   .env         → DB_SCHEMA=thingy
     *   .env.testing → DB_SCHEMA=thingy_test
     */
    public function run(): void
    {
        // Get schema name from environment (.env or .env.testing)
        $schema = env('DB_SCHEMA', 'public');

        // Load the raw SQL file
        $path = base_path('database/thingy-seed.sql');
        $sql = file_get_contents($path);

        // Replace all {{schema}} placeholders with the configured schema name
        $sql = str_replace('{{schema}}', $schema, $sql);

        // Execute the SQL against the current connection
        DB::unprepared($sql);

        $this->command->info("Database seeded using schema: {$schema}");
    }
}
