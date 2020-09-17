<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->truncate();

        $typi_settings = [
            ['id' => 1, 'group_name' => 'config', 'key_name' => 'webmaster_email', 'value' => 'info@example.com', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'group_name' => 'config', 'key_name' => 'google_analytics_code', 'value' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'group_name' => 'config', 'key_name' => 'lang_chooser', 'value' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'group_name' => 'fr', 'key_name' => 'website_title', 'value' => 'Site web sans titre', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'group_name' => 'fr', 'key_name' => 'status', 'value' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'group_name' => 'nl', 'key_name' => 'website_title', 'value' => 'Untitled website', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'group_name' => 'nl', 'key_name' => 'status', 'value' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'group_name' => 'en', 'key_name' => 'website_title', 'value' => 'Untitled website', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'group_name' => 'en', 'key_name' => 'status', 'value' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'group_name' => 'config', 'key_name' => 'welcome_message', 'value' => 'Welcome to the administration panel of TypiCMS.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'group_name' => 'config', 'key_name' => 'auth_public', 'value' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'group_name' => 'config', 'key_name' => 'register', 'value' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'group_name' => 'config', 'key_name' => 'admin_locale', 'value' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('settings')->insert($typi_settings);
    }
}
