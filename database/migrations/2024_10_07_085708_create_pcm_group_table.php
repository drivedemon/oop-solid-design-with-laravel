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
        Schema::create('pcm_group', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('pcp_group_uuid')->nullable();
            $table->string('pcm_group_name', 45);
            $table->string('responsibility_uuid')->nullable();
            $table->text('secondary_responsibility');
            $table->integer('group_type')->comment('0: pcp
1: Individual
2: cxa');
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
        Schema::dropIfExists('pcm_group');
    }
};
