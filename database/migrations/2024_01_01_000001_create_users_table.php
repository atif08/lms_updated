<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('email')->unique();
            $table->string('country_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('qualification_name')->nullable();
            $table->string('institution')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('major')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            $table->boolean('is_active')->default(0);
            $table->string('user_type')->nullable();

            $table->foreignId('parent_id')->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('last_activity_at')->nullable();

            $table->string('delete_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
