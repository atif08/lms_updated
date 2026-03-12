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
        $tables = [
             'announcements', 'assignments', 'attendances',
            'batches', 'bug_reports', 'categories','question_options',
            'course_answers', 'course_questions', 'courses',
            'export_requests', 'file_libraries',
            'lessons', 'media',
            'permissions',
             'progress',
            'questions', 'quiz_attempts',
            'quizzes',
            'roles', 'section_questions', 'submitted_assignments',
            'topic_quiz', 'topicables', 'topics','quiz_sections','quiz_attempt_answers'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->softDeletes(); // This adds the deleted_at column
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
             'announcements', 'assignments', 'attendances',
            'batches', 'bug_reports', 'categories',
            'course_answers', 'course_questions', 'courses',
            'export_requests', 'file_libraries',
            'lessons', 'media',
            'permissions',
             'progress',
             'questions', 'quiz_attempts',
               'quizzes',
            'roles', 'section_questions', 'submitted_assignments',
            'topic_quiz', 'topicables', 'topics',
            'users'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropSoftDeletes(); // This will drop the deleted_at column if rolled back
            });
        }
    }
};
