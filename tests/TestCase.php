<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /** Seed only once per test process. */
    private static bool $seeded = false;

    protected function setUp(): void
    {
        parent::setUp();

        if (! self::$seeded) {
            // Runs DatabaseSeeder, which loads database/thingy-seed.sql
            // and swaps {{schema}} with DB_SCHEMA from .env.testing
            $this->seed();

            self::$seeded = true;
        }
    }
}