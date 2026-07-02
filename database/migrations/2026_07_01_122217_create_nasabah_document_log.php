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
        Schema::create('nasabah_document_log', function (Blueprint $table) {
            $table->id();
            $table->integer('nasabah_id');
            $table->string('document_type')->nullable();
            $table->string('value_before')->nullable();
            $table->string('value_after')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_document_log');
    }
};
