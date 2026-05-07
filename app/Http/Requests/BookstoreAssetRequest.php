<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookstoreAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $assetId = $this->route('asset')?->id;

        return [
            'asset_type' => ['required', Rule::in(['book', 'inventory'])],
            'name' => ['required', 'string', 'max:255'],
            'isbn_sku' => ['required', 'string', 'max:255', Rule::unique('bookstore_assets', 'isbn_sku')->ignore($assetId)],
            'barcode_upc' => ['required', 'string', 'max:255', Rule::unique('bookstore_assets', 'barcode_upc')->ignore($assetId)],
            'book_category_id' => ['nullable', 'integer'],
            'publisher_id' => ['nullable', 'integer'],
            'publication_year' => ['nullable', 'integer'],
            'language' => ['nullable', 'string', 'max:100'],
            'inventory_category_id' => ['nullable', 'integer'],
            'brand' => ['nullable', 'string', 'max:255'],
            'cogs_price' => ['required', 'numeric'],
            'sales_price' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
            'big_uom' => ['nullable', 'string', 'max:50'],
            'big_uom_value' => ['nullable', 'numeric'],
            'small_uom' => ['nullable', 'string', 'max:50'],
            'small_uom_value' => ['nullable', 'numeric'],
            'inventory_methods' => ['nullable', 'string', 'max:100'],
            'stock_quantity' => ['nullable', 'integer'],
            'cover_image_url' => ['nullable', 'string', 'max:255'],
            'status' => ['boolean'],
        ];
    }
}
