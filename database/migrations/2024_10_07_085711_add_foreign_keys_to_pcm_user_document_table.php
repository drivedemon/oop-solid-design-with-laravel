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
        Schema::table('pcm_user_document', function (Blueprint $table) {
            $table->foreign(['pcm_document_type_uuid'], 'pcm_user_document_ibfk_1')->references(['uuid'])->on('pcm_document_type')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pcm_user_document', function (Blueprint $table) {
            $table->dropForeign('pcm_user_document_ibfk_1');
        });
    }
};
