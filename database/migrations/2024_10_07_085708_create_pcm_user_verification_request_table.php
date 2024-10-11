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
        Schema::create('pcm_user_verification_request', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->string('pcm_user_uuid');
            $table->integer('request_type')->nullable();
            $table->string('verification_code', 100);
            $table->dateTime('expiration_time');
            $table->string('created_platform', 45);
            $table->string('created_by');
            $table->dateTime('created_at');
            $table->string('updated_platform', 45);
            $table->string('updated_by');
            $table->dateTime('updated_at');
            $table->integer('record_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcm_user_verification_request');
    }
};
