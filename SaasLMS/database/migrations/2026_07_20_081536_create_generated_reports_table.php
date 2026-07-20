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
    Schema::create('generated_reports', function (Blueprint $table) {
        $table->id();
        $table->string('type');          // attendance | roster | lessons
        $table->string('filename');
        $table->string('department');    // display label
        $table->string('path');          // storage path
        $table->unsignedInteger('size_bytes');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('generated_reports');
}
};
