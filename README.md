# TypiCMS

[![Latest Stable Version](https://poser.pugx.org/typicms/base/v/stable)](https://packagist.org/packages/typicms/base)
[![License](https://poser.pugx.org/typicms/base/license)](https://packagist.org/packages/typicms/base)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TypiCMS/Base/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TypiCMS/Base/?branch=master)

TypiCMS is a modular multilingual content management system built with [Laravel 6](https://laravel.com). Out of the box you can manage pages, events, news, places, menus, translations, etc.

![TypiCMS screenshot](https://typicms.org/uploads/files/typicms-screenshot.png?2)

## Table of contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
  - [Assets](#assets)
  - [Configuration](#configuration)
  - [Installation of a module](#installation-of-a-module)
- [Available modules](#available-modules)
  - [Pages](#pages)
  - [Menus](#menus)
  - [Projects](#projects)
  - [Categories](#categories)
  - [Tags](#tags)
  - [Events](#events)
  - [News](#news)
  - [Contacts](#contacts)
  - [Partners](#partners)
  - [Files](#files)
  - [Galleries](#galleries)
  - [Users and roles](#users-and-roles)
  - [Blocks](#blocks)
  - [Translations](#translations)
  - [Sitemap](#sitemap)
  - [Settings](#settings)
  - [History](#history)
- [Facades](#facades)
- [Artisan commands](#artisan-commands)
- [Roadmap](#roadmap)
- [Change log](#change-log)
- [Contributing](#contributing)
- [Credits](#credits)
- [Licence](#licence)

## Features

### URLs

This kind of URLs are managed by the CMS:

**Modules:**

- /en/events/slug-in-english
- /fr/evenements/slug-en-francais

**Pages:**

- /en/parent-pages-slug-en/subpage-slug-en/page-slug-en
- /fr/parent-pages-slug-fr/subpage-slug-fr/page-slug-fr

## Requirements

- PHP >= 7.2
- MySQL 5.7.8
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

First install [Composer](https://getcomposer.org)

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

Note: if you use MariaDB, set 'mariadb' to true in config/typicms.php

Go to http://mywebsite.test/admin and log in.

### Assets

Assets are managed with [Laravel Mix](https://github.com/JeffreyWay/laravel-mix).
In order to work on assets, you need to install [Node.js](http://nodejs.org), then enter your website folder and run these commands:

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
If you need to customize it, you can [publish it](#publish-a-module)!

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

This example is for a module called Cats.

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

## Available modules

Each module can be [published](#publish-a-module).

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

The files module allows you to upload and organize images, documents and folders. It works with [DropzoneJS](http://www.dropzonejs.com) for the uploading proccess.
Thumbnails are generated on the fly thanks to [Croppa](https://github.com/BKWLD/croppa).

If you want to store the original images on a storage service such as Amazon s3 and your cropped images on the local disk, set `FILESYSTEM_DRIVER=s3` in your **.env** file and in **config/croppa.php** set `'src_dir' => 'filesystem.default.driver'` and `'crops_dir' => storage_path('app/public')`.

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

A sitemap is generated by reading all pages available in your project. The URL is /sitemap.xml.

### Settings

Change the website title, logo, and other options in the settings panel.

### History

_created_, _updated_, _deleted_, _online_ and _offline_ actions are logged in database.
Latest records are displayed in the back office’s dashboard.

## Facades

Each modules has a facade that give you access to the repository, you can call for example `News::latest(3)` to get the three latest news.
Check available methods in each module’s repository.

## Artisan commands

Commands are located in **/vendor/typicms/core/src/Commands**

### Installation of TypiCMS

```
php artisan typicms:install
```

### Initial migration and seed

```
php artisan typicms:database
```

This command is triggered by `typicms:install`

### Publish a module

If you want to modify a module, for example to add some fields or a relation, you have to publish it by running:

```
php artisan typicms:publish <modulename>
```

The module is now located in the **/Modules** directory.

These steps will be executed:

1. Publishing of views and migrations for Pages module.
2. Copying of everything excepted views and migrations from **/vendor/typicms/pages/src** to **/Modules/Pages**.
3. Running `composer remove typicms/pages`.

When a module is published, it will be tracked by git and you will be able to make changes in **/Modules/Modulename** directory without loosing changes when running `composer update`.

### Create a module

You can easily scaffold a module by running this this command:

```
php artisan typicms:create <modulename>
```

## Changelog

Please see [CHANGELOG](https://github.com/TypiCMS/Base/blob/master/CHANGELOG.md) for more information on what has changed.

## Contributing

Please see [CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Samuel De Backer](https://github.com/sdebacker)
- [All contributors](https://github.com/TypiCMS/Base/graphs/contributors)

## License

TypiCMS is an open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
