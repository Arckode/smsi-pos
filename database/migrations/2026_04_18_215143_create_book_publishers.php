<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// publisher_id (Primary Key)
// name
// address
// contact_phone
// contact_email

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_publishers', function (Blueprint $table) {
            $table->id('publisher_id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_publishers');
    }
};
