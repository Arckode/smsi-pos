<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        // Modules
        DB::table('menu_modules')->insert([
            ['name' => 'User Management', 'icon' => 'fas fa-users'],
            ['name' => 'Product Management', 'icon' => 'fas fa-box'],
            ['name' => 'Settings', 'icon' => 'fas fa-cog'],
        ]);

        // Sub-modules
        DB::table('menu_submodules')->insert([
            ['module_id' => 1, 'sub_module_name' => 'User List', 'url' => '/users/lists'],
            ['module_id' => 1, 'sub_module_name' => 'Manage User Access', 'url' => '/users/access'],
            ['module_id' => 2, 'sub_module_name' => 'Book Lists', 'url' => '/books'],
            ['module_id' => 2, 'sub_module_name' => 'Create Product', 'url' => '/products/create'],
            ['module_id' => 3, 'sub_module_name' => 'General Settings', 'url' => '/settings'],
        ]);

        // User Access (Example - Replace with your actual user IDs and module assignments)
        DB::table('menu_user_access')->insert([
            ['user_id' => 1, 'module_id' => 1, 'sub_module_ids' => json_encode([1, 2])], // User 1 has access to module 1 with submodules 1 and 2
            ['user_id' => 1, 'module_id' => 2, 'sub_module_ids' => json_encode([3])], // User 1 has access to module 2 with submodule 3
            ['user_id' => 2, 'module_id' => 1, 'sub_module_ids' => json_encode([1])], // User 2 has access to module 1 with submodule 1
        ]);

        DB::table('menu_user_submodule_permissions')->insert([
            ['user_id' => 1, 'sub_module_id' => 1, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
            ['user_id' => 1, 'sub_module_id' => 2, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['user_id' => 2, 'sub_module_id' => 1, 'can_create' => false, 'can_read' => true, 'can_update' => false, 'can_delete' => false],
        ]);
    }
}
