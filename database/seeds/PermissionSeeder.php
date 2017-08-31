<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $typi_permissions = [
            ['id' => 1, 'name' => 'view-navbar', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'dashboard', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'see-history', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'see-settings', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'update-setting', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'delete-history', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'change-locale', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'update-preferences', 'guard_name' => 'web'],
            ['id' => 9, 'name' => 'clear-cache', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'see-all-blocks', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'create-block', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'update-block', 'guard_name' => 'web'],
            ['id' => 13, 'name' => 'delete-block', 'guard_name' => 'web'],
            ['id' => 14, 'name' => 'see-all-files', 'guard_name' => 'web'],
            ['id' => 15, 'name' => 'create-file', 'guard_name' => 'web'],
            ['id' => 16, 'name' => 'update-file', 'guard_name' => 'web'],
            ['id' => 17, 'name' => 'delete-file', 'guard_name' => 'web'],
            ['id' => 18, 'name' => 'see-all-galleries', 'guard_name' => 'web'],
            ['id' => 19, 'name' => 'create-gallery', 'guard_name' => 'web'],
            ['id' => 20, 'name' => 'update-gallery', 'guard_name' => 'web'],
            ['id' => 21, 'name' => 'delete-gallery', 'guard_name' => 'web'],
            ['id' => 22, 'name' => 'see-all-menus', 'guard_name' => 'web'],
            ['id' => 23, 'name' => 'create-menu', 'guard_name' => 'web'],
            ['id' => 24, 'name' => 'update-menu', 'guard_name' => 'web'],
            ['id' => 25, 'name' => 'delete-menu', 'guard_name' => 'web'],
            ['id' => 26, 'name' => 'see-all-pages', 'guard_name' => 'web'],
            ['id' => 27, 'name' => 'create-page', 'guard_name' => 'web'],
            ['id' => 28, 'name' => 'update-page', 'guard_name' => 'web'],
            ['id' => 29, 'name' => 'delete-page', 'guard_name' => 'web'],
            ['id' => 30, 'name' => 'see-all-roles', 'guard_name' => 'web'],
            ['id' => 31, 'name' => 'create-role', 'guard_name' => 'web'],
            ['id' => 32, 'name' => 'update-role', 'guard_name' => 'web'],
            ['id' => 33, 'name' => 'delete-role', 'guard_name' => 'web'],
            ['id' => 34, 'name' => 'see-all-translations', 'guard_name' => 'web'],
            ['id' => 35, 'name' => 'create-translation', 'guard_name' => 'web'],
            ['id' => 36, 'name' => 'update-translation', 'guard_name' => 'web'],
            ['id' => 37, 'name' => 'delete-translation', 'guard_name' => 'web'],
            ['id' => 38, 'name' => 'see-all-users', 'guard_name' => 'web'],
            ['id' => 39, 'name' => 'create-user', 'guard_name' => 'web'],
            ['id' => 40, 'name' => 'update-user', 'guard_name' => 'web'],
            ['id' => 41, 'name' => 'delete-user', 'guard_name' => 'web'],
        ];

        DB::table('permissions')->insert($typi_permissions);
    }
}
