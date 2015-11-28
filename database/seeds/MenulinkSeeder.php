<?php

use Illuminate\Database\Seeder;

class MenulinkSeeder extends Seeder
{
    public function run()
    {
        $typi_menulinks = [
            ['id' => '1', 'menu_id' => '1', 'page_id' => '1', 'position' => '1', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 22:08:05', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '2', 'menu_id' => '1', 'page_id' => '2', 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],

            ['id' => '3', 'menu_id' => '2', 'page_id' => '2', 'position' => '1', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 17:20:16', 'updated_at' => '2014-03-28 13:32:46'],
            ['id' => '4', 'menu_id' => '2', 'page_id' => '3', 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 17:20:43', 'updated_at' => '2014-03-28 17:31:37'],

            ['id' => '5', 'menu_id' => '3', 'page_id' => '0', 'position' => '1', 'target' => '_blank', 'class' => 'btn-facebook', 'icon_class' => 'fa fa-facebook fa-fw', 'has_categories' => 0, 'created_at' => '2014-03-28 18:30:11', 'updated_at' => '2014-03-28 18:30:17'],
            ['id' => '6', 'menu_id' => '3', 'page_id' => '0', 'position' => '2', 'target' => '_blank', 'class' => 'btn-twitter', 'icon_class' => 'fa fa-twitter fa-fw', 'has_categories' => 0, 'created_at' => '2014-03-28 18:31:35', 'updated_at' => '2014-03-28 18:31:47'],
        ];

        $typi_menulink_translations = [
            ['id' => '1', 'menulink_id' => '1', 'locale' => 'fr', 'status' => '1', 'title' => 'Accueil', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '2', 'menulink_id' => '1', 'locale' => 'nl', 'status' => '1', 'title' => 'Home', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '3', 'menulink_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'Home', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '4', 'menulink_id' => '2', 'locale' => 'fr', 'status' => '1', 'title' => 'Contact', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 13:29:27'],
            ['id' => '5', 'menulink_id' => '2', 'locale' => 'nl', 'status' => '1', 'title' => 'Contact', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 13:29:27'],
            ['id' => '6', 'menulink_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'Contact', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 13:29:27'],

            ['id' => '7', 'menulink_id' => '3', 'locale' => 'fr', 'status' => '1', 'title' => 'Contact', 'url' => '', 'created_at' => '2014-03-28 17:20:16', 'updated_at' => '2014-03-28 13:30:40'],
            ['id' => '8', 'menulink_id' => '3', 'locale' => 'nl', 'status' => '1', 'title' => 'Contact', 'url' => '', 'created_at' => '2014-03-28 17:20:16', 'updated_at' => '2014-03-28 13:30:40'],
            ['id' => '9', 'menulink_id' => '3', 'locale' => 'en', 'status' => '1', 'title' => 'Contact', 'url' => '', 'created_at' => '2014-03-28 17:20:16', 'updated_at' => '2014-03-28 13:30:40'],

            ['id' => '10', 'menulink_id' => '4', 'locale' => 'fr', 'status' => '1', 'title' => 'Conditions d’utilisation', 'url' => '', 'created_at' => '2014-03-28 17:20:43', 'updated_at' => '2014-03-28 17:20:51'],
            ['id' => '11', 'menulink_id' => '4', 'locale' => 'nl', 'status' => '1', 'title' => 'Gebruiksvoorwaarden', 'url' => '', 'created_at' => '2014-03-28 17:20:43', 'updated_at' => '2014-03-28 17:20:47'],
            ['id' => '12', 'menulink_id' => '4', 'locale' => 'en', 'status' => '1', 'title' => 'Terms of use', 'url' => '', 'created_at' => '2014-03-28 17:20:43', 'updated_at' => '2014-03-28 17:20:44'],

            ['id' => '13', 'menulink_id' => '5', 'locale' => 'fr', 'status' => '1', 'title' => 'Facebook', 'url' => 'https://www.facebook.com', 'created_at' => '2014-03-28 18:30:11', 'updated_at' => '2014-03-28 18:30:17'],
            ['id' => '14', 'menulink_id' => '5', 'locale' => 'nl', 'status' => '1', 'title' => 'Facebook', 'url' => 'https://www.facebook.com', 'created_at' => '2014-03-28 18:30:11', 'updated_at' => '2014-03-28 18:30:17'],
            ['id' => '15', 'menulink_id' => '5', 'locale' => 'en', 'status' => '1', 'title' => 'Facebook', 'url' => 'https://www.facebook.com', 'created_at' => '2014-03-28 18:30:11', 'updated_at' => '2014-03-28 18:30:17'],
            ['id' => '16', 'menulink_id' => '6', 'locale' => 'fr', 'status' => '1', 'title' => 'Twitter', 'url' => 'https://twitter.com', 'created_at' => '2014-03-28 18:31:35', 'updated_at' => '2014-03-28 18:31:47'],
            ['id' => '17', 'menulink_id' => '6', 'locale' => 'nl', 'status' => '1', 'title' => 'Twitter', 'url' => 'https://twitter.com', 'created_at' => '2014-03-28 18:31:35', 'updated_at' => '2014-03-28 18:31:44'],
            ['id' => '18', 'menulink_id' => '6', 'locale' => 'en', 'status' => '1', 'title' => 'Twitter', 'url' => 'https://twitter.com', 'created_at' => '2014-03-28 18:31:35', 'updated_at' => '2014-03-28 18:31:42'],
        ];

        DB::table('menulinks')->insert($typi_menulinks);
        DB::table('menulink_translations')->insert($typi_menulink_translations);
    }
}
