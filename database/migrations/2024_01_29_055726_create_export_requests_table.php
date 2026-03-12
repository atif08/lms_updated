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
        Schema::create('export_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('account_id')->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('export_type', 1000);
            $table->json('payload')->nullable();
            $table->text('full_path')->nullable();
            $table->string('status')->nullable();
            $table->integer('attempts')->nullable();
            $table->boolean('failed')->nullable();
            $table->longText('exception')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_requests');
    }
};
