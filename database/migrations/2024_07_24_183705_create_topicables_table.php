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
        Schema::create('topicables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->morphs('topicable');
            $table->timestamps();
            $table->integer('order')->default(0);
            // Add indexes for faster queries
            $table->index(['topic_id', 'topicable_id', 'topicable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topicables');
    }
};
