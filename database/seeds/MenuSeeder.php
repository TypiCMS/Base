<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {

        $typi_menus = array(
            array('id' => '1','name' => 'main','class' => 'nav-main nav nav-pills','created_at' => '2013-09-03 22:05:21','updated_at' => '2014-02-17 16:25:05'),
            array('id' => '2','name' => 'footer','class' => 'nav-footer nav nav-pills pull-right','created_at' => '2013-09-03 22:05:42','updated_at' => '2014-02-17 16:24:59'),
            array('id' => '3','name' => 'social','class' => 'nav-social list-unstyled','created_at' => '2014-02-04 18:27:18','updated_at' => '2014-02-17 16:25:21'),
        );

        $typi_menu_translations = array(
            array('id' => '1','menu_id' => '1','locale' => 'fr','status' => '1','title' => 'Principal','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
            array('id' => '2','menu_id' => '1','locale' => 'nl','status' => '1','title' => 'Main','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
            array('id' => '3','menu_id' => '1','locale' => 'en','status' => '1','title' => 'Main','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
            array('id' => '4','menu_id' => '2','locale' => 'fr','status' => '1','title' => 'Pied de site','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
            array('id' => '5','menu_id' => '2','locale' => 'nl','status' => '1','title' => 'Footer','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
            array('id' => '6','menu_id' => '2','locale' => 'en','status' => '1','title' => 'Footer','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
            array('id' => '7','menu_id' => '3','locale' => 'fr','status' => '1','title' => 'Réseaux sociaux','created_at' => '2014-02-04 18:27:18','updated_at' => '2014-02-04 18:35:01'),
            array('id' => '8','menu_id' => '3','locale' => 'nl','status' => '1','title' => 'Sociale netwerken','created_at' => '2014-02-04 18:27:18','updated_at' => '2014-02-04 18:35:01'),
            array('id' => '9','menu_id' => '3','locale' => 'en','status' => '1','title' => 'Social networks','created_at' => '2014-02-04 18:27:18','updated_at' => '2014-02-04 18:35:01'),
        );

        DB::table('menus')->insert( $typi_menus );
        DB::table('menu_translations')->insert( $typi_menu_translations );

    }

}
