<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $cascadeTables = ['attendances', 'class_rooms', 'generated_reports', 'payments', 'schedules'];

        foreach ($cascadeTables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->foreign('organization_id')
                      ->references('id')->on('organizations')
                      ->cascadeOnDelete();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('organization_id')
                  ->references('id')->on('organizations')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        $tables = ['attendances', 'class_rooms', 'generated_reports', 'payments', 'schedules', 'users'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['organization_id']);
            });
        }
    }
};
