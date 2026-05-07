<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert ([
            ["name" => "Owner", "created_at" => now(), "updated_at" => now()],
            ["name" => "Admin", "created_at" => now(), "updated_at" => now()],
            ["name" => "Agent", "created_at" => now(), "updated_at" => now()],
        ]);
    }
}
