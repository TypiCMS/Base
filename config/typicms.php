<?php 
return [

    /*
    |--------------------------------------------------------------------------
    | Per module config
    |--------------------------------------------------------------------------
    |
    | Here you can override config for each module.
    |
    */
    'news' => [
        'per_page' => 50,
    ],

    /*
    |--------------------------------------------------------------------------
    | You can choose not to have main locale in URL
    |--------------------------------------------------------------------------
    */
    'main_locale_in_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Welcome message url
    |--------------------------------------------------------------------------
    */
    'welcome_message_url' => getEnv('WELCOME_MESSAGE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Modules that can be linked to a menu item
    |--------------------------------------------------------------------------
    */
    'modules_for_menu_items' => [
        'Categories',
        'Events',
        'Galleries',
        'News',
        'Partners',
        'Places',
        'Projects',
        'Tags',
    ],

    /*
    |--------------------------------------------------------------------------
    | Modules for permissions table
    |--------------------------------------------------------------------------
    */
    'modules_for_permissions_table' => [
        'Blocks',
        'Categories',
        'Contacts',
        'Events',
        'Files',
        'Galleries',
        'Groups',
        'Menus',
        'News',
        'Pages',
        'Partners',
        'Places',
        'Projects',
        'Tags',
        'Translations',
        'Users',
    ],

];
