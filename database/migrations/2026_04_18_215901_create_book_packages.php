<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// package_id (Primary Key): Unique identifier for each package.
// package_name: Name or title of the package.
// description: Description of the package contents or theme.
// package_price: Price for the entire package.
// stock_quantity: Number of packages available in inventory.
// cover_image_url: Optional URL for the package cover image.
// status: Boolean to indicate if the package is currently active and available for sale.

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('package_name');
            $table->text('description')->nullable();
            $table->decimal('package_price', 10, 2);
            $table->integer('stock_quantity')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_packages');
    }
};
