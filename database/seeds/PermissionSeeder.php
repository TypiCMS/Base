<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $typi_permissions = [
            ['id' => 1, 'name' => 'see navbar', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'see dashboard', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'see history', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'read settings', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'update settings', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'clear history', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'change locale', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'update preferencess', 'guard_name' => 'web'],
            ['id' => 9, 'name' => 'clear cache', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'read blocks', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'create blocks', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'update blocks', 'guard_name' => 'web'],
            ['id' => 13, 'name' => 'delete blocks', 'guard_name' => 'web'],
            ['id' => 14, 'name' => 'read files', 'guard_name' => 'web'],
            ['id' => 15, 'name' => 'create files', 'guard_name' => 'web'],
            ['id' => 16, 'name' => 'update files', 'guard_name' => 'web'],
            ['id' => 17, 'name' => 'delete files', 'guard_name' => 'web'],
            ['id' => 22, 'name' => 'read menus', 'guard_name' => 'web'],
            ['id' => 23, 'name' => 'create menus', 'guard_name' => 'web'],
            ['id' => 24, 'name' => 'update menus', 'guard_name' => 'web'],
            ['id' => 25, 'name' => 'delete menus', 'guard_name' => 'web'],
            ['id' => 26, 'name' => 'read pages', 'guard_name' => 'web'],
            ['id' => 27, 'name' => 'create pages', 'guard_name' => 'web'],
            ['id' => 28, 'name' => 'update pages', 'guard_name' => 'web'],
            ['id' => 29, 'name' => 'delete pages', 'guard_name' => 'web'],
            ['id' => 30, 'name' => 'read roles', 'guard_name' => 'web'],
            ['id' => 31, 'name' => 'create roles', 'guard_name' => 'web'],
            ['id' => 32, 'name' => 'update roles', 'guard_name' => 'web'],
            ['id' => 33, 'name' => 'delete roles', 'guard_name' => 'web'],
            ['id' => 34, 'name' => 'read translations', 'guard_name' => 'web'],
            ['id' => 35, 'name' => 'create translations', 'guard_name' => 'web'],
            ['id' => 36, 'name' => 'update translations', 'guard_name' => 'web'],
            ['id' => 37, 'name' => 'delete translations', 'guard_name' => 'web'],
            ['id' => 38, 'name' => 'read users', 'guard_name' => 'web'],
            ['id' => 39, 'name' => 'create users', 'guard_name' => 'web'],
            ['id' => 40, 'name' => 'update users', 'guard_name' => 'web'],
            ['id' => 41, 'name' => 'delete users', 'guard_name' => 'web'],
        ];

        DB::table('permissions')->insert($typi_permissions);
    }
}
