<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->truncate();

        $typi_settings = [
            ['id' => '1', 'group_name' => 'config', 'key_name' => 'webmaster_email', 'value' => 'info@example.com', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'group_name' => 'config', 'key_name' => 'google_analytics_code', 'value' => null, 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'group_name' => 'config', 'key_name' => 'lang_chooser', 'value' => '1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '4', 'group_name' => 'fr', 'key_name' => 'website_title', 'value' => 'Site web sans titre', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'group_name' => 'fr', 'key_name' => 'status', 'value' => '1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '6', 'group_name' => 'nl', 'key_name' => 'website_title', 'value' => 'Untitled website', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '7', 'group_name' => 'nl', 'key_name' => 'status', 'value' => '1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '8', 'group_name' => 'en', 'key_name' => 'website_title', 'value' => 'Untitled website', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '9', 'group_name' => 'en', 'key_name' => 'status', 'value' => '1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '10', 'group_name' => 'config', 'key_name' => 'welcome_message', 'value' => 'Welcome to the administration panel of TypiCMS.', 'created_at' => '2014-03-18 12:48:01', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '11', 'group_name' => 'config', 'key_name' => 'auth_public', 'value' => 0, 'created_at' => '2014-03-18 12:48:01', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '12', 'group_name' => 'config', 'key_name' => 'register', 'value' => 0, 'created_at' => '2014-03-18 12:48:01', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '13', 'group_name' => 'config', 'key_name' => 'admin_locale', 'value' => 'en', 'created_at' => '2014-03-22 12:48:01', 'updated_at' => '2014-03-22 12:48:01'],
        ];

        DB::table('settings')->insert($typi_settings);
    }
}
