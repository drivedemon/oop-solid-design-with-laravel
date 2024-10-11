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
        Schema::table('pcm_census_policy', function (Blueprint $table) {
            $table->foreign(['pcm_user_uuid'], 'FK_93_1')->references(['uuid'])->on('pcm_user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pcm_policies_uuid'], 'FK_93_2')->references(['uuid'])->on('pcm_policies')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pcm_census_policy', function (Blueprint $table) {
            $table->dropForeign('FK_93_1');
            $table->dropForeign('FK_93_2');
        });
    }
};
