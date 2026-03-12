<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration removes the deprecated Vimeo columns from the lessons table
     * after the data has been migrated to the media table.
     */
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn([
                'vimeo_id',
                'vimeo_uri',
                'vimeo_embed_url',
                'vimeo_ready'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('vimeo_id')->nullable()->after('external_link');
            $table->string('vimeo_uri')->nullable()->after('vimeo_id');
            $table->string('vimeo_embed_url')->nullable()->after('vimeo_uri');
            $table->boolean('vimeo_ready')->default(false)->after('vimeo_embed_url');
        });
    }
};
