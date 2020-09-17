<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MenulinkSeeder extends Seeder
{
    public function run()
    {
        $typi_menulinks = [
            ['id' => 1, 'menu_id' => 1, 'page_id' => 1, 'parent_id' => null, 'image_id' => null, 'position' => 1, 'target' => null, 'class' => null, 'icon_class' => null, 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Home", "fr": "Accueil", "nl": "Home"}', 'url' => '{"en": null, "fr": null, "nl": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'menu_id' => 1, 'page_id' => 2, 'parent_id' => null, 'image_id' => null, 'position' => 2, 'target' => null, 'class' => null, 'icon_class' => null, 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Contact", "fr": "Contact", "nl": "Contact"}', 'url' => '{"en": null, "fr": null, "nl": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'menu_id' => 2, 'page_id' => 2, 'parent_id' => null, 'image_id' => null, 'position' => 1, 'target' => null, 'class' => null, 'icon_class' => null, 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Contact", "fr": "Contact", "nl": "Contact"}', 'url' => '{"en": null, "fr": null, "nl": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 1, 'target' => '_blank', 'class' => 'btn-facebook', 'icon_class' => 'fa fa-facebook fa-fw', 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Facebook", "fr": "Facebook", "nl": "Facebook"}', 'url' => '{"en": "https://www.facebook.com", "fr": "https://www.facebook.com", "nl": "https://www.facebook.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 2, 'target' => null, 'class' => null, 'icon_class' => 'fa fa-linkedin fa-fw', 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "LinkedIn", "fr": "LinkedIn", "nl": "LinkedIn"}', 'url' => '{"en": "https://www.linkedin.com", "fr": "https://www.linkedin.com", "nl": "https://www.linkedin.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 3, 'target' => '_blank', 'class' => 'btn-twitter', 'icon_class' => 'fa fa-twitter fa-fw', 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Twitter", "fr": "Twitter", "nl": "Twitter"}', 'url' => '{"en": "https://twitter.com", "fr": "https://twitter.com", "nl": "https://twitter.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 4, 'target' => null, 'class' => null, 'icon_class' => 'fa fa-instagram fa-fw', 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Instagram", "fr": "Instagram", "nl": "Instagram"}', 'url' => '{"en": "https://www.instagram.com", "fr": "https://www.instagram.com", "nl": "https://www.instagram.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 5, 'target' => null, 'class' => null, 'icon_class' => 'fa fa-youtube-play fa-fw', 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "YouTube", "fr": "YouTube", "nl": "YouTube"}', 'url' => '{"en": "https://www.youtube.com", "fr": "https://www.youtube.com", "nl": "https://www.youtube.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'menu_id' => 4, 'page_id' => 3, 'parent_id' => null, 'image_id' => null, 'position' => 0, 'target' => null, 'class' => null, 'icon_class' => null, 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Terms and conditions", "fr": "Conditions générales", "nl": "Algemene Voorwaarden"}', 'url' => '{"en": null, "fr": null, "nl": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'menu_id' => 4, 'page_id' => 4, 'parent_id' => null, 'image_id' => null, 'position' => 0, 'target' => null, 'class' => null, 'icon_class' => null, 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Privacy policy", "fr": "Charte vie privée", "nl": "Privacyverklaring"}', 'url' => '{"en": null, "fr": null, "nl": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'menu_id' => 4, 'page_id' => 5, 'parent_id' => null, 'image_id' => null, 'position' => 0, 'target' => null, 'class' => null, 'icon_class' => null, 'status' => '{"en": 1, "fr": 1, "nl": 1}', 'title' => '{"en": "Cookie policy", "fr": "Politique des cookies", "nl": "Cookieverklaring"}', 'url' => '{"en": null, "fr": null, "nl": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('menulinks')->insert($typi_menulinks);
    }
}
