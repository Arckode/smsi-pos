<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetsSeeder extends Seeder
{
    public function run(): void
    {
        // Authors
        DB::table('book_authors')->insert([
            ['full_name' => 'John Trafford', 'bio' => 'Author of several best-selling novels'],
            ['full_name' => 'Elena Smith', 'bio' => 'Responsible for product development and strategy'],
            ['full_name' => 'Bob Johnson', 'bio' => 'System configuration and management'],
        ]);

        // Publishers
        DB::table('book_publishers')->insert([
            ['name' => 'Publisher A', 'contact_email' => 'contact@publisherA.com'],
            ['name' => 'Publisher B', 'contact_email' => 'contact@publisherB.com'],
            ['name' => 'Publisher C', 'contact_email' => 'contact@publisherC.com'],
        ]);

        // Book Categories
        DB::table('book_categories')->insert([
            ['category_name' => 'Fiction'],
            ['category_name' => 'Non-fiction'],
            ['category_name' => 'Science'],
            ['category_name' => 'History'],
            ['category_name' => 'Children'],
        ]);

        // UOM
        DB::table('uom')->insert([
            ['uom_name' => 'Book (BK)'],
            ['uom_name' => 'Piece (PC)'],
            ['uom_name' => 'Box (BX)'],
            ['uom_name' => 'Pack (PK)'],
            ['uom_name' => 'Set (SET)'],
            ['uom_name' => 'Each (EA)'],
            ['uom_name' => 'Bundle (BDL)'],
            ['uom_name' => 'Kilogram (KG)'],
            ['uom_name' => 'Meter (M)'],
            ['uom_name' => 'Sheet (SH)'],
            ['uom_name' => 'Carton (CTN)'],
            ['uom_name' => 'Unit (U)'],
        ]);

        // Inventory Categories
        DB::table('inventory_categories')->insert([
            ['category_name' => 'Stationary'],
            ['category_name' => 'Merchandise'],
        ]);

        // Bookstore Assets
        DB::table('bookstore_assets')->insert([
            [
                'asset_type' => 'book',
                'name' => 'The Great Gatsby',
                'isbn_sku' => '978-3-16-148410-0',
                'barcode_upc' => '123456789012',
                'book_category_id' => 1,
                'publisher_id' => 1,
                'publication_year' => 1925,
                'language' => 'English',
                'inventory_category_id' => null,
                'brand' => null,
                'cogs_price' => 5.00,
                'sales_price' => 10.00,
                'description' => 'A classic novel by F. Scott Fitzgerald.',
                'big_uom' => 'Book (BK)',
                'big_uom_value' => 1,
                'small_uom' => 'Piece (PC)',
                'small_uom_value' => 1,
                'inventory_methods' => 'FIFO',
                'stock_quantity' => 0,
                'cover_image_url' => null,
            ],
            [
                'asset_type' => 'inventory',
                'name' => 'Notebook',
                'isbn_sku' => null,
                'barcode_upc' => null,
                'book_category_id' => null,
                'publisher_id' => null,
                'publication_year' => null,
                'language' => null,
                'inventory_category_id' => 1,
                'brand' => 'Brand A',
                'cogs_price' => 2.00,
                'sales_price' => 4.00,
                'description' => null,
                'big_uom' => null,
                'big_uom_value' => null,
                'small_uom' => null,
                'small_uom_value' => null,
                'inventory_methods' => null,
                'stock_quantity' => 0,
                'cover_image_url' => null,
            ],
        ]);
    }
}
