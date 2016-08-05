<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $typi_roles = [
            ['id' => 1, 'name' => 'administrator'],
            ['id' => 2, 'name' => 'visitor'],
        ];

        DB::table('roles')->insert($typi_roles);
    }
}
