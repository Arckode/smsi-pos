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
        Schema::create('menu_submodules', function (Blueprint $table) {
            $table->id('sub_module_id');
            $table->unsignedBigInteger('module_id');
            $table->string('sub_module_name');
            $table->string('url');
            $table->timestamps();

            // $table->foreign('module_id')->references('id')->on('menu_modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_submodules');
    }
};
