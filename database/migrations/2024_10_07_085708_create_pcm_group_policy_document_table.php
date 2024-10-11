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
        Schema::create('pcm_group_policy_document', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('pcm_group_policy_setting_uuid');
            $table->string('file_name');
            $table->string('file_path');
            $table->integer('sequential')->nullable()->default(0);
            $table->dateTime('expiry_date')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('record_status');
            $table->string('pcm_document_type_uuid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcm_group_policy_document');
    }
};
