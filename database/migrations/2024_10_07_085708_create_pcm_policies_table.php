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
        Schema::create('pcm_policies', function (Blueprint $table) {
            $table->comment('Is_unknown_subgroup = 0 : Disable for All
Is_unknown_subgroup = 1 : Allow Master and Normal
Is_unknown_subgroup = 2 : Allow Master');
            $table->uuid()->primary();
            $table->integer('policy_id');
            $table->integer('client_no')->nullable();
            $table->string('policy_type', 40)->nullable();
            $table->string('proposer', 160)->nullable();
            $table->string('region', 5)->default('HK');
            $table->string('policy_number', 100)->nullable();
            $table->string('insurance_company', 100)->nullable();
            $table->string('renewal_responsibility', 60)->nullable();
            $table->date('start_date')->nullable();
            $table->date('policy_end_date')->nullable();
            $table->string('service_office', 20)->nullable()->default('Hong Kong');
            $table->string('medical_responsibility', 40)->nullable();
            $table->string('medical_currency', 30)->nullable();
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
        Schema::dropIfExists('pcm_policies');
    }
};
