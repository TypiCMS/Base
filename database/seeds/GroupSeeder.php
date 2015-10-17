<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $typi_groups = [
            ['id' => '1','name' => 'Admin','permissions' => '{"dashboard":1,"settings.index":1,"pages.index":1,"pages.view":1,"pages.create":1,"pages.store":1,"pages.edit":1,"pages.sort":1,"pages.destroy":1,"files.index":1,"files.view":1,"files.create":1,"files.store":1,"files.edit":1,"files.sort":1,"files.destroy":1,"news.index":1,"news.view":1,"news.create":1,"news.store":1,"news.edit":1,"news.sort":1,"news.destroy":1,"events.index":1,"events.view":1,"events.create":1,"events.store":1,"events.edit":1,"events.sort":1,"events.destroy":1,"categories.index":1,"categories.view":1,"categories.create":1,"categories.store":1,"categories.edit":1,"categories.sort":1,"categories.destroy":1,"projects.index":1,"projects.view":1,"projects.create":1,"projects.store":1,"projects.edit":1,"projects.sort":1,"projects.destroy":1,"places.index":1,"places.view":1,"places.create":1,"places.store":1,"places.edit":1,"places.sort":1,"places.destroy":1,"menus.index":1,"menus.view":1,"menus.create":1,"menus.store":1,"menus.edit":1,"menus.sort":1,"menus.destroy":1,"menulinks.index":1,"menulinks.view":1,"menulinks.create":1,"menulinks.store":1,"menulinks.edit":1,"menulinks.sort":1,"menulinks.destroy":1,"users.index":1,"users.view":1,"users.create":1,"users.store":1,"users.edit":1,"users.sort":1,"users.destroy":1,"groups.index":1,"groups.view":1,"groups.create":1,"groups.store":1,"groups.edit":1,"groups.sort":1,"groups.destroy":1}','created_at' => '2014-11-04 23:30:06','updated_at' => '2014-11-04 23:30:06'],
            ['id' => '2','name' => 'Public','permissions' => '','created_at' => '2014-11-04 23:30:06','updated_at' => '2014-11-04 23:30:06'],
        ];

        DB::table('groups')->insert($typi_groups);
    }
}
