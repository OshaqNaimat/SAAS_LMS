<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create a default organization to hold your existing data
        $defaultOrgId = DB::table('organizations')->insertGetId([
            'name' => 'Apex Global Institute',
            'slug' => 'apex-global',
            'plan' => 'enterprise',
            'status' => 'active',
            'max_users' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tables = ['users', 'class_rooms', 'attendances', 'payments', 'schedules', 'generated_reports'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->foreignId('organization_id')->nullable()->constrained()->cascadeOnDelete();
            });
        }

        // 2. Backfill all existing rows into the default organization
        foreach ($tables as $table) {
            DB::table($table)->update(['organization_id' => $defaultOrgId]);
        }

        // 3. Now make it required going forward
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->foreignId('organization_id')->nullable(false)->change();
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
