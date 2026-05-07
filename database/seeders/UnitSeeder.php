<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('units')->truncate();

        Schema::enableForeignKeyConstraints();

        $data = [
            ["name" => "Store", "created_at" => now(), "updated_at" => now()],
        ];

        Unit::insert($data);
    }
}
