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
        Schema::create('pcm_user', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->string('census_uuid');
            $table->date('login_buffer_day')->nullable();
            $table->string('login_username')->nullable();
            $table->string('login_password')->nullable();
            $table->integer('failed_verification_attempts')->default(0);
            $table->string('email');
            $table->string('billing_address');
            $table->string('phone_number');
            $table->integer('account_status');
            $table->dateTime('activated_at')->nullable();
            $table->string('last_name', 45);
            $table->string('first_name', 45)->default('');
            $table->date('dob');
            $table->string('gender', 6);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('record_status');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('role', 45);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcm_user');
    }
};
