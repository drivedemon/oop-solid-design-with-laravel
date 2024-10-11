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
        Schema::create('pcm_group_user', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('pcm_group_uuid');
            $table->string('pcm_user_uuid')->index('fk_3');
            $table->string('pcm_user_group_uuid')->nullable();
            $table->string('census_uuid');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('record_status');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcm_group_user');
    }
};
