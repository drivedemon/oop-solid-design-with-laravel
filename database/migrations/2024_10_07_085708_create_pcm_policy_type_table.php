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
        Schema::create('pcm_policy_type', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->string('type', 100);
            $table->string('code', 10);
            $table->string('mapping_type', 45);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcm_policy_type');
    }
};
