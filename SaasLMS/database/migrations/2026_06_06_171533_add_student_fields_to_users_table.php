<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Students use roll_number to log in instead of an email address
            $table->string('roll_number')->nullable()->unique()->after('email');
            $table->string('father_name')->nullable()->after('name');
            $table->string('class')->nullable()->after('role');
            $table->string('section')->nullable()->after('class');

            // Make email nullable since students won't necessarily need one to log in
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['roll_number', 'father_name', 'class', 'section']);
            $table->string('email')->nullable(false)->change();
        });
    }
};
