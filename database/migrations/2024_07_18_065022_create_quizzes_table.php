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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->float('total_marks')->nullable();
            $table->float('pass_marks')->nullable();
            $table->integer('max_attempts')->default(1);
            $table->tinyInteger('is_published')->default(0);
            $table->integer('duration')->nullable();
            $table->integer('time_between_attempts')->nullable();
            $table->integer('order')->default(0);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_upto')->nullable();
            $table->json('negative_marking_settings')->nullable();
            // Fields for settings tab
            $table->boolean('is_active')->default(true);
            $table->boolean('unregistered_users_can_solve')->default(false);
            $table->boolean('hide_answers_in_reports')->default(false);
            $table->boolean('no_review_needed')->default(false);
            $table->boolean('student_can_download_results')->default(false);
            $table->integer('time_to_complete')->nullable();
            $table->enum('questions_per_page', ['single', 'section', 'all'])->default('all');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
