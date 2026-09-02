<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('substitutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->foreignId('substitute_teacher_id')->constrained('users')->cascadeOnDelete();
            $table->string('reason')->nullable();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['schedule_id', 'date']); // only one substitute per period per day
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('substitutions');
    }
};
