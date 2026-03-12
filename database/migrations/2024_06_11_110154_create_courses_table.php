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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status');
            $table->longText('description')->nullable();
            $table->longText('announcement')->nullable();
            $table->string('course_duration_hr')->nullable();
            $table->string('course_duration_min')->nullable();
            $table->string('difficulty_level');
            $table->boolean('is_announcement')->default(false);
            $table->double('price')->default(0);
            $table->boolean('is_question')->default(false);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
