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
        Schema::table('characters', function (Blueprint $table) {
            $table->string('house_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('character_image_thumb')->nullable();
            $table->string('character_image_full')->nullable();
            $table->json('siblings')->nullable();
            $table->json('parents')->nullable();
            $table->json('killed')->nullable();
            $table->json('guarded_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn([
                'house_name',
                'nickname',
                'character_image_thumb',
                'character_image_full',
                'siblings',
                'parents',
                'killed',
                'guarded_by',
            ]);
        });
    }
};
