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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('course_status')->nullable()->after('is_active');
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('quiz_link')->nullable()->after('external_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('course_status');
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('quiz_link');
        });
    }
};
