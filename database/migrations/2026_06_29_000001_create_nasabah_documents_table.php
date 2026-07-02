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
        Schema::create('nasabah_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabah')->cascadeOnDelete();
            $table->string('doc_type');
            $table->string('location_url')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_documents');
    }
};
