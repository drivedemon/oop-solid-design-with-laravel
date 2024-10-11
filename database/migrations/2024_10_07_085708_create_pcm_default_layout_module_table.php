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
        Schema::create('pcm_default_layout_module', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('region', 30)->default('');
            $table->integer('type')->comment('0: Medical, 1:Life, 2: Medical & Life , 3: Individual');
            $table->string('module_name')->nullable();
            $table->string('display_name')->nullable();
            $table->integer('sequential');
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
        Schema::dropIfExists('pcm_default_layout_module');
    }
};
