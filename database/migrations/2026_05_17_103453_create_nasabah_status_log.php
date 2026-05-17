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
        Schema::create('nasabah_status_log', function (Blueprint $table) {
            $table->id();
            $table->integer('nasabah_id');
            $table->string('status_before')->nullable();
            $table->string('status_after')->nullable();
            $table->timestamp('status_changed_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_status_log');
    }
};
