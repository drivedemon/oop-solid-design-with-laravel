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
        Schema::create('pcm_user_group', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('pcm_group_uuid');
            $table->string('pcm_layout_uuid');
            $table->integer('is_custom');
            $table->string('name');
            $table->string('factor_1')->nullable();
            $table->string('factor_2')->nullable();
            $table->string('factor_3')->nullable();
            $table->string('factor_4')->nullable();
            $table->string('factor_1_column_name')->nullable();
            $table->string('factor_2_column_name')->nullable();
            $table->string('factor_3_column_name')->nullable();
            $table->string('factor_4_column_name')->nullable();
            $table->text('logo_path')->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('pcm_user_group');
    }
};
