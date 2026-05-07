<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// package_id (Foreign Key)
// book_id (Foreign Key)
// quantity: Number of copies of the book included in the package.
// original_price: Original price of the book (before any package discount) for reference.
// price: Price of the book within the package (can be used for calculating total package price or discounts).

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_packages_detail', function (Blueprint $table) {
            $table->id('package_detail_id');
            $table->integer('package_id');
            $table->integer('book_id');
            $table->integer('quantity');
            $table->decimal('original_price', 10, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_packages_detail');
    }
};
