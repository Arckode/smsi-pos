<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('api_keys')->truncate();

        Schema::enableForeignKeyConstraints();

        $data = [
            ["unit_id" => 1, "name" => "mms", "url" => "https://mms.erp-sistem.com", "created_at" => now(), "updated_at" => now()],
            ["unit_id" => 2, "name" => "fast", "url" => "https://fmp.erp-sistem.com", "created_at" => now(), "updated_at" => now()],
            ["unit_id" => 3, "name" => "track", "url" => "https://track.erp-sistem.com", "created_at" => now(), "updated_at" => now()],
            ["unit_id" => 4, "name" => "maxima", "url" => "https://maxima.erp-sistem.com", "created_at" => now(), "updated_at" => now()],
            ["unit_id" => 5, "name" => "excel", "url" => "https://epm.erp-sistem.com", "created_at" => now(), "updated_at" => now()],
        ];

        ApiKey::insert($data);
    }
}
