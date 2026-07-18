<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');        // e.g. "Grade 11"
            $table->string('section');     // e.g. "Alpha"
            $table->string('stream')->nullable(); // e.g. "Science Stream"
            $table->string('room')->nullable();   // e.g. "Room 304"
            $table->unsignedInteger('max_seats')->default(30);
            $table->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
