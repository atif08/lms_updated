<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->after('batch_id')->constrained()->nullOnDelete();
        });

        // Backfill: assign course_id from enrollments for existing records
        DB::statement('
            UPDATE attendances a
            INNER JOIN enrollments e ON e.user_id = a.user_id
            SET a.course_id = e.course_id
            WHERE a.course_id IS NULL
        ');

        // MySQL requires us to drop the FK that relies on the unique index first
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('attendances_user_id_foreign');
            $table->dropUnique('attendances_user_id_date_unique');
            $table->unique(['user_id', 'date', 'course_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id', 'date', 'course_id']);
            $table->unique(['user_id', 'date']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->dropConstrainedForeignId('course_id');
        });
    }
};
