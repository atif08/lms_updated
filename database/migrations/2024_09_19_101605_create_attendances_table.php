<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Student ID
            $table->foreignId('batch_id')->nullable(); // Batch ID
            $table->dateTime('check_in')->nullable();   // Check-in time
            $table->dateTime('check_out')->nullable();   // Check-in time
            $table->string('hours', 100)->nullable(); // Total hours (calculated)
            $table->date('date');// Attendance Date
            $table->string('status')->default('ABSENT'); // Attendance Status
            $table->string('remarks')->nullable();  // Additional remarks (optional)
            $table->timestamps();
            $table->unique(['user_id', 'date']); // To avoid duplicate records for a student on the same date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('attendances');
    }
};
