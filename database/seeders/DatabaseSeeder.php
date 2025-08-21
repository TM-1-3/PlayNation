<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This loads `database/thingy-seed.sql` and replaces 'thingy' 
     * with the schema name from environment (DB_SCHEMA).
     *
     * The SQL file can be run directly in psql for development:
     * psql -d database_name -f database/thingy-seed.sql
     */
    public function run(): void
    {
        // Get schema name from environment (.env or .env.testing)
        $schema = env('DB_SCHEMA', 'public');

        // Load the raw SQL file
        $path = base_path('database/thingy-seed.sql');
        $sql = file_get_contents($path);

        // Only replace 'thingy' when it's a complete word (surrounded by non-word characters)
        $sql = preg_replace('/\bthingy\b/', $schema, $sql);

        // Execute the SQL against the current connection
        DB::unprepared($sql);

        $this->command->info("Database seeded using schema: {$schema}");
    }
}
