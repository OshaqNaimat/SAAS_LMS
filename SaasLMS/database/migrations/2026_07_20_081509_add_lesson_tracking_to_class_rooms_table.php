<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('class_rooms', function (Blueprint $table) {
        $table->unsignedInteger('total_lessons')->default(0)->after('max_seats');
        $table->unsignedInteger('completed_lessons')->default(0)->after('total_lessons');
    });
}

public function down(): void
{
    Schema::table('class_rooms', function (Blueprint $table) {
        $table->dropColumn(['total_lessons', 'completed_lessons']);
    });
}
};
