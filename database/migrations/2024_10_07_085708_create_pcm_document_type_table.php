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
        Schema::create('pcm_document_type', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->integer('type')->comment('0: File, 1: Clinic, 2: Benefit Coverage');
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcm_document_type');
    }
};
