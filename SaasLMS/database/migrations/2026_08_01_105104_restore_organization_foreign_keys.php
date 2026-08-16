<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['users', 'class_rooms', 'attendances', 'payments', 'schedules', 'generated_reports'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) use ($table) {
                if (!Schema::hasColumn($table, 'organization_id')) {
                    $t->foreignId('organization_id')->nullable()->constrained()->cascadeOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        $tables = ['users', 'class_rooms', 'attendances', 'payments', 'schedules', 'generated_reports'];
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropForeign(['organization_id']);
                $t->dropColumn('organization_id');
            });
        }
    }
};
