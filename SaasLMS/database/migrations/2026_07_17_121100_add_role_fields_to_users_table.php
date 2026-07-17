<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name')->after('name');
            $table->string('roll_number')->nullable()->unique()->after('father_name');
            $table->string('class')->nullable()->after('roll_number');
            $table->string('section')->nullable()->after('class');
            $table->string('assigned_class')->nullable()->after('section'); // for teachers
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['father_name', 'roll_number', 'class', 'section', 'assigned_class']);
        });
    }
};
