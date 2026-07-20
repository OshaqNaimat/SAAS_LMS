<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_id')->unique();
            $table->foreignId('student_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('student_name');       // stored directly too, in case roll number doesn't match a user
            $table->string('roll_number');
            $table->string('category');            // Tuition Fee, Exam Fee, etc.
            $table->string('channel');             // Bank Deposit, Cash Counter, Pay Order
            $table->unsignedBigInteger('amount');  // in PKR, stored as integer (no decimals)
            $table->enum('status', ['cleared', 'pending', 'overdue'])->default('cleared');
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
