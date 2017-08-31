<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $typi_roles = [
            ['id' => 1, 'name' => 'administrator', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'visitor', 'guard_name' => 'web'],
        ];

        DB::table('roles')->insert($typi_roles);
    }
}
