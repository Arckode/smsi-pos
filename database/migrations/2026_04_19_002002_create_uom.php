<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// Book (BK) — for individual books
// Piece (PC or EA) — general unit for single items like notebooks, pens, or other stationery
// Box (BX) — for packaged sets or bulk items (e.g., box of pens)
// Pack (PK) — smaller grouped units (e.g., pack of bookmarks)
// Set (SET) — for collections or grouped items sold together (e.g., a set of notebooks)
// Each (EA) — single unit, often interchangeable with piece
// Bundle (BDL) — grouped items bundled together
// Kilogram (KG) — for weight-based items like paper reams
// Meter (M) — for measuring lengths, e.g., rolls of wrapping paper
// Sheet (SH) — for individual sheets of paper or stickers
// Carton (CTN) — larger packaging unit for bulk stock
// Unit (U or UN) — generic unit for items not fitting other categories

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uom', function (Blueprint $table) {
            $table->id('uom_id');
            $table->string('uom_name')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uom');
    }
};
