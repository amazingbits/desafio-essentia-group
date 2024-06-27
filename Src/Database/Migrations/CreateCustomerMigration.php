<?php

namespace Src\Database\Migrations;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerMigration extends Migration
{
    private static string $tableName = "tbl_customer";

    public static function up(): void
    {
        DB::schema()->create(self::$tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("phone_number");
            $table->string("image_url");
        });
    }

    public static function down(): void
    {
        DB::schema()->dropIfExists(self::$tableName);
    }
}