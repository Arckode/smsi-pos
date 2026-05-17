<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetsSeeder extends Seeder
{
    public function run(): void
    {
        // Affiliates
        DB::table('affiliasi')->insert([
            ['nama_affiliasi' => 'John Trafford', 'kota' => 'New York', 'no_telepon' => '123-456-7890', 'email' => 'john@affiliasi.com', 'pic_name' => 'John Doe'],
            ['nama_affiliasi' => 'Elena Smith', 'kota' => 'Los Angeles', 'no_telepon' => '098-765-4321', 'email' => 'elena@affiliasi.com', 'pic_name' => 'Elena Johnson'],
            ['nama_affiliasi' => 'Bob Johnson', 'kota' => 'Chicago', 'no_telepon' => '555-555-5555', 'email' => 'bob@affiliasi.com', 'pic_name' => 'Bob Williams'],
        ]);
    }
}
