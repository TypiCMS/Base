<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $typi_roles = [
            ['id' => '1', 'name' => 'Administrator'],
            ['id' => '2', 'name' => 'Redactor'],
        ];

        DB::table('roles')->insert($typi_roles);
    }
}
