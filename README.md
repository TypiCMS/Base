# TypiCMS

[![Latest Stable Version](https://poser.pugx.org/typicms/base/v/stable)](https://packagist.org/packages/typicms/base)
[![License](https://poser.pugx.org/typicms/base/license)](https://packagist.org/packages/typicms/base)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TypiCMS/Base/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TypiCMS/Base/?branch=master)

TypiCMS is a modular multilingual content management system built with [Laravel 5.5](http://laravel.com). Out of the box you can manage pages, events, news, places, sliders, etc.

![TypiCMS screenshot](http://typicms.org/uploads/files/typicms-screenshot.png?2)

## Table of contents

* [Features](#features)
* [Requirements](#requirements)
* [Installation](#installation)
  * [Assets](#assets)
  * [Configuration](#configuration)
  * [Installation of a module](#installation-of-a-module)
* [Modules](#modules)
  * [Pages](#pages)
  * [Menus](#menus)
  * [Projects](#projects)
  * [Categories](#categories)
  * [Tags](#tags)
  * [Events](#events)
  * [News](#news)
  * [Contacts](#contacts)
  * [Partners](#partners)
  * [Files](#files)
  * [Galleries](#galleries)
  * [Users and roles](#users-and-roles)
  * [Blocks](#blocks)
  * [Translations](#translations)
  * [Sitemap](#sitemap)
  * [Settings](#settings)
  * [History](#history)
* [Facades](#facades)
* [Artisan commands](#artisan-commands)
* [Roadmap](#roadmap)
* [Upgrade instructions](#upgrade-instructions)
* [Change log](#change-log)
* [Contributing](#contributing)
* [Credits](#credits)
* [Licence](#licence)

## Features

### URLs

This kind of URLs are managed by the CMS:

**Modules:**

* /en/events/slug-in-english
* /fr/evenements/slug-en-francais

**Pages:**

* /en/parent-pages-slug-en/subpage-slug-en/page-slug-en
* /fr/parent-pages-slug-fr/subpage-slug-fr/page-slug-fr

## Requirements

* PHP >= 7.0.0
* MySQL 5.7
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* Memcached or Redis
* XML PHP Extension

## Installation

First install [Node.js](http://nodejs.org)

1. Create a new project

   ```
   composer create-project typicms/base mywebsite
   ```

2. Enter the newly created folder

   ```
   cd mywebsite
   ```

3. DB migration and seed, user creation, npm installation and directory rights

   ```
   php artisan typicms:install
   ```

Go to http://mywebsite.local/admin and log in.

### Assets

Assets are managed with [Laravel Mix](https://github.com/JeffreyWay/laravel-mix).
In order to work on assets, you need to install [Node.js](http://nodejs.org), then cd to your website folder and run these commands:

1. Install npm packages (in directory **node_modules**)

   ```
   npm install
   ```

2. Compile admin and public assets

   ```
   npm run dev
   ```

### Configuration

1. Set locales in config/translatable.php.
2. Set fallback_locale in config/app.php.
3. Set main_locale_in_url in config/typicms.php to true or false.
4. Cache driver is set to array, you can change it to another taggable cache system such as redis or memcached in your .env file.

### Installation of a module

This example is for the News module. After these steps, the module will appear in the sidebar of the back office.
If you need to customize it, [publish it](#publish-a-module)!

1. Install module with Composer

   ```
   composer require typicms/news
   ```

2. Add `TypiCMS\Modules\News\Providers\ModuleProvider::class,` to **config/app.php**, before `TypiCMS\Modules\Core\Providers\ModuleProvider::class,`
3. Publish views and migrations

   ```
   php artisan vendor:publish
   ```

4. Migrate the database

   ```
   php artisan migrate
   ```

### Module scaffolding

This example is for a new module called Cats.

1. Create the module with artisan:

   ```
   php artisan typicms:create cats
   ```

2. The module is in **/Modules/Cats**, you can customize it
3. Add `TypiCMS\Modules\Cats\Providers\ModuleProvider::class,` to **config/app.php**, before `TypiCMS\Modules\Core\Providers\ModuleProvider::class,`
4. Migrate the database

   ```
   php artisan migrate
   ```

## Existing modules

Each module can be published in order to be modified and tracked by git. Here is more info on [publishing a module](#publish-a-module).

### Pages

Pages are nestable with drag and drop, on drop, URIs are generated and saved in the database.
Each translation of a page has its own route.
A page can be linked to a module.
A page can have multiple sections.

### Menus

Each menu has nestable entries. One entry can be linked to a page or URL.
You can return a HTML formated menu with `Menus::render('menuname')` or `@menu('menuname')`.

### Projects

Projects have categories, projects URLs follows this pattern: /en/projects/category-slug/project-slug

### Tags

Tags are linked to projects and use the [Selectize](https://brianreavis.github.io/selectize.js/) plugin.
The tags module has many to many polymorphic relations so a tag can be easily linked to any module.

### Events

Events have starting and ending dates.

### News

News module.

### Contacts

Frontend contact form and admin side records management.

### Partners

A partner has a logo, website URL, title and body content.

### Files

The files module allows you to upload and organize files in folders. Behind the scene, [DropzoneJS](http://www.dropzonejs.com) is used to upload files.
Thumbnails are generated on request with [Croppa](https://github.com/BKWLD/croppa).

### Users and roles

User registration can be enabled through the settings panel (/admin/settings).
Roles and Permissions are managed with [spatie/laravel-permission](https://github.com/spatie/laravel-permission).

### Blocks

Blocks are useful to display custom content in your views.
You can display the content of a block with `Blocks::render('blockname')` or `@block('blockname')`.

### Translations

Translations can be stored in the database through the admin panel (/admin/translations).

You can call DB translation everywhere with `Lang::get('db.Key')`, `trans('db.Key')` or `@lang('db.Key')`.

### Sitemap

Route sitemap.xml generates a sitemap file in XML format.
To add modules to the site map configure app/config/sitemap.php.

### Settings

Change website title, and other options trough the settings panel. Settings are saved in the database

### History

_created_, _updated_, _deleted_, _online_ and _offline_ actions are logged in database.
25 latest records are displayed in the back office’s dashboard.

## Facades

Each modules has a facade that give you access to the repository, you can call for example `News::latest(3)` to get the three latest news.
Check available methods in each module’s repository.

## Artisan commands

Commands are located in **/vendor/typicms/core/src/Commands**

### Installation of TypiCMS

```
php artisan typicms:install
```

### Set cache key prefix in app/config/cache.php

```
php artisan cache:prefix yourCachePrefix
```

This command is triggered by `typicms:install`

### Initial migration and seed

```
php artisan typicms:database
```

This command is triggered by `typicms:install`

### Publish a module

If you want to modify a module, for example add some fields or a relation, you can not do it easily because each module is in vendor directory.
The solution is to remove it from composer and copy it to the **/Modules** directory. For example, the module **Pages** will be published by running this command:

```
php artisan typicms:publish pages
```

These steps will be executed:

1. Publishing of views and migrations for Pages module.
2. Copying of everything excepted views and migrations from **/vendor/typicms/pages/src** to **/Modules/Pages**.
3. Running `composer remove typicms/pages`.

When a module is published, it will be tracked by git and you will be able to make changes in **/Modules/Modulename** directory without loosing changes when running `composer update`.

### Create a module

You can easily scaffold a module, for a module named Cats, run this command:

```
php artisan typicms:create cats
```

## Upgrade instructions

[See the Wiki for upgrade instructions](https://github.com/TypiCMS/Base/wiki)

## Change log

Please see [CHANGELOG](https://github.com/TypiCMS/Base/blob/master/CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONTRIBUTING.md) for details.

## Credits

* [Samuel De Backer](https://github.com/sdebacker)
* [All contributors](https://github.com/TypiCMS/Base/graphs/contributors)

## License

TypiCMS is an open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
