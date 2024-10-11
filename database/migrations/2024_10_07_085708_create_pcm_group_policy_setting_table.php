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
        Schema::create('pcm_group_policy_setting', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('pcm_group_uuid');
            $table->string('pcm_policy_uuid');
            $table->integer('access_mode')->comment('0-hide mode
1-read only mode
2-write mode');
            $table->string('policy_name');
            $table->string('policy_number', 100);
            $table->string('insurer_name', 100);
            $table->string('proposer_name', 160);
            $table->integer('claim_management_type')->comment('0 - EE can claim EE & Spouse , Spouse can claim Spouse 
1 - EE can claim EE & Spouse , Spouse cannot claim Spouse 
2 - EE can claim EE  , Spouse claim Spouse');
            $table->integer('claim_buffer_day');
            $table->date('effective_date');
            $table->text('ecard_mapping_db_field')->default('');
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
        Schema::dropIfExists('pcm_group_policy_setting');
    }
};
