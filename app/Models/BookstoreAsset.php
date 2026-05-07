<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookstoreAsset extends Model
{
    use HasFactory;

    protected $table = 'bookstore_assets';

    protected $fillable = [
        'asset_type',
        'name',
        'isbn_sku',
        'barcode_upc',
        'book_category_id',
        'publisher_id',
        'publication_year',
        'language',
        'inventory_category_id',
        'brand',
        'cogs_price',
        'sales_price',
        'description',
        'big_uom',
        'big_uom_value',
        'small_uom',
        'small_uom_value',
        'inventory_methods',
        'stock_quantity',
        'cover_image_url',
        'status',
    ];

    protected $casts = [
        'book_category_id' => 'integer',
        'publisher_id' => 'integer',
        'publication_year' => 'integer',
        'inventory_category_id' => 'integer',
        'cogs_price' => 'decimal:2',
        'sales_price' => 'decimal:2',
        'big_uom_value' => 'decimal:2',
        'small_uom_value' => 'decimal:2',
        'stock_quantity' => 'integer',
        'status' => 'boolean',
    ];
}
