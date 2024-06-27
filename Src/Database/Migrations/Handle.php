<?php

namespace Src\Database\Migrations;

use Illuminate\Database\Capsule\Manager as DB;

class Handle
{
    private static array $migrationList = [
        CreateCustomerMigration::class,
    ];

    public static function up(): void
    {
        try {
            foreach (self::$migrationList as $migration) {
                $migration::down();
                $migration::up();
            }
        } catch (\Exception $e) {
            throw new \Exception('Error: ' . $e->getMessage());
        }
    }
}