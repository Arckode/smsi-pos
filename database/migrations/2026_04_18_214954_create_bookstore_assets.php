<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// id (Primary Key): Unique identifier for each book.
// asset_type (book/inventory): Indicates the type of asset.
// name: Title of the book/assets.
// isbn/sku: (International Standard Book Number #for books) / (Stock Keeping Unit #for inventory), unique for each edition.
// Barcode/UPC: Unique code for inventory tracking and sales.

// ***Books***
// book_category_id (Foreign Key): Links to the Category table.
// publisher_id (Foreign Key): Links to the Publisher table.
// publication_year: Year the book was published.
// language: Language of the book.

// ***Inventory***
// inventory_category (Foreign Key): Links to the Inventory Category table Stationary/Merchandise.
// Brand: Brand of the inventory item (if applicable).

// cogs_price: Cost of goods sold price of the book.
// sales_price: Sales price of the book.
// description: Short summary or description.
// big_uom: Unit of measurement for items (e.g., piece, box, etc.).
// small_uom: Unit of measurement for items (e.g., piece, box, etc.).
// inventory_methods: FIFO, LIFO, FEFO

// stock_quantity: Number of copies currently in inventory on small uom.
// cover_image_url: Optional URL for the book cover image.
// status: Boolean to indicate if the book is currently available for sale.

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookstore_assets', function (Blueprint $table) {
            $table->id();
            $table->enum('asset_type', ['book', 'inventory']);
            $table->string('name');
            $table->string('isbn_sku')->unique()->nullable();
            $table->string('barcode_upc')->unique()->nullable();

            $table->integer('book_category_id')->nullable();
            $table->integer('publisher_id')->nullable();
            $table->integer('publication_year')->nullable();
            $table->string('language')->nullable();

            $table->integer('inventory_category_id')->nullable();
            $table->string('brand')->nullable();
            
            $table->decimal('cogs_price', 8, 2);
            $table->decimal('sales_price', 8, 2);
            $table->string('description')->nullable();
            $table->string('big_uom')->nullable();
            $table->decimal('big_uom_value', 10, 2)->nullable();
            $table->string('small_uom')->nullable();
            $table->decimal('small_uom_value', 10, 2)->nullable();
            $table->string('inventory_methods')->nullable();
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
        Schema::dropIfExists('bookstore_assets');
    }
};
