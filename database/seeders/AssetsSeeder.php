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
            ['nama_affiliasi' => 'PT. John Trafford', 'kota' => 'New York', 'no_telepon' => '123-456-7890', 'email' => 'john@affiliasi.com', 'pic_name' => 'John Doe'],
            ['nama_affiliasi' => 'PT. Elena Smith', 'kota' => 'Los Angeles', 'no_telepon' => '098-765-4321', 'email' => 'elena@affiliasi.com', 'pic_name' => 'Elena Johnson'],
            ['nama_affiliasi' => 'PT. Bob Johnson', 'kota' => 'Chicago', 'no_telepon' => '555-555-5555', 'email' => 'bob@affiliasi.com', 'pic_name' => 'Bob Williams'],
        ]);

        // Nasabah
        DB::table('nasabah')->insert([
            ['nama_lengkap' => 'Alice Brown'],
            ['nama_lengkap' => 'Charlie Davis'],
            ['nama_lengkap' => 'Eve Wilson'],
            ['nama_lengkap' => 'Frank Wilson'],
            ['nama_lengkap' => 'Grace Lee'],
            ['nama_lengkap' => 'Harry Smith'],
            ['nama_lengkap' => 'Ivy Johnson'],
            ['nama_lengkap' => 'Jack White'],
            ['nama_lengkap' => 'Karen Green'],
            ['nama_lengkap' => 'Leo Turner'],
            ['nama_lengkap' => 'Mia Clark'],
            ['nama_lengkap' => 'Nina Adams'],
            ['nama_lengkap' => 'Oscar Baker'],
            ['nama_lengkap' => 'Paul Harris'],
            ['nama_lengkap' => 'Quinn Martin'],
            ['nama_lengkap' => 'Rachel Lee'],
            ['nama_lengkap' => 'Sam Wilson'],
            ['nama_lengkap' => 'Tina Brown'],
            ['nama_lengkap' => 'Uma Davis'],
            ['nama_lengkap' => 'Victor Clark'],
        ]);
    }
}
