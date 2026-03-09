<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('import_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('report_name');
            $table->string('report_type');

            $table->foreignId('account_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->nullableMorphs('importable');

            $table->string('status');
            $table->text('file_path');

            $table->integer('total_rows')->default(0);
            $table->json('headers')->nullable();
            $table->json('mappings')->nullable();

            $table->text('error')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('import_requests');
    }
};
