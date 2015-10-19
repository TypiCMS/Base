# TypiCMS

[![Packagist](https://img.shields.io/packagist/v/typicms/base.svg?style=flat-square)]()
[![Packagist](https://img.shields.io/packagist/l/typicms/base.svg?style=flat-square)]()
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/96951b30-0060-414c-992d-df965bd63000.svg?style=flat-square)]()
[![Scrutinizer](https://img.shields.io/scrutinizer/g/typicms/base.svg?style=flat-square)]()
[![StyleCI](https://styleci.io/repos/28512514/shield)](https://styleci.io/repos/28512514)

TypiCMS is a multilingual content management system built with [Laravel 5](http://laravel.com).

![TypiCMS screenshot](http://typicms.org/uploads/files/typicms-screenshot.png?1)

## Table of contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
  - [npm, Bower & Gulp](#npm-bower--gulp)
  - [Configuration](#configuration)
  - [Installation of a module](#installation-of-a-module)
- [Modules](#modules)
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
  - [Users and groups](#users-and-groups)
  - [Blocks](#blocks)
  - [Translations](#translations)
  - [Sitemap](#sitemap)
  - [Settings](#settings)
  - [History](#history)
- [Facades](#facades)
- [Artisan commands](#artisan-commands)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [Testing](#testing)
- [Licence](#licence)

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

- PHP >= 5.5.9
- OpenSSL PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- Memcached or Redis

## Installation

First install [Node.js](http://nodejs.org), [Bower](http://bower.io) and [gulp](http://gulpjs.com)

1. Create a new project

   ```
   composer create-project typicms/base mywebsite
   ```
2. Enter the newly created folder

   ```
   cd mywebsite
   ```
3. DB migration and seed, user creation, npm installation, bower installation and directory rights

   ```
   php artisan typicms:install
   ```

Go to http://mywebsite.local/admin and log in.

### npm, Bower & Gulp

In order to work on assets, you need to install [Node.js](http://nodejs.org), [Bower](http://bower.io) and [gulp](http://gulpjs.com), then cd to your website folder and run these commands:

1. Install bower packages according to bower.json (directory app/assets/components)

   ```
   bower install
   ```
2. Install gulp packages according to gulpfile.js (directory node_modules)

   ```
   npm install
   ```
3. Compile admin and public assets

   ```
   gulp
   ```

### Configuration

1. Set locales in config/translatable.php.
2. Set fallback_locale in config/app.php.
3. Set main_locale_in_url in config/typicms.php to true or false.
4. Cache driver is set to array, you can change it to another taggable cache system such as redis or memcached in your .env file.

### Installation of a module

This example is for the News module. After these steps, the module will appear in the sidebar of the back office.

1. Install module with Composer

   ```
   composer require typicms/news
   ```
2. Add ```TypiCMS\Modules\News\Providers\ModuleProvider::class,``` to *config/app.php*, before ```TypiCMS\Modules\Core\Providers\ModuleProvider::class,```
3. Publish views and migrations

   ```
   php artisan vendor:publish
   ```
4. Migrate the database

   ```
   php artisan migrate
   ```

## Modules

### Pages

Pages are nestable with drag and drop, on drop, URIs are generated and saved in the database.  
Each translation of a page has its own route.  
A page can be linked to a module.

### Menus

Each menu has nestable entries. One entry can be linked to a page or URL.  
You can return a HTML formated menu with ``` Menus::build('menuname') ```.

### Projects

Projects have categories, projects URLs follows this pattern: /en/projects/category-slug/project-slug

### Categories

Categories have many projects.

### Tags

Tags are linked to projects and use the [Selectize](https://brianreavis.github.io/selectize.js/) jQuery plugin.  
The tags module has many to many polymorphic relations so it could easily be linked to other modules.

### Events

Events have starting and ending dates.

### News

Simple news module with linked files/images galleries.

### Contacts

Frontend contact form and admin side records management.

### Partners

A partner has a logo, website URL, title and body content.

### Files

The files module allows you to upload multiple files. It uses [DropzoneJS](http://www.dropzonejs.com) to upload them.  
Thumbnails are generated on the fly with [Croppa](https://github.com/BKWLD/croppa).

### Galleries

You can create as many galleries as you want, each gallery has many files.  
Galleries are linkable to any module item through a polymorphic many to many relation.

### Users

User registration can be enabled through the settings panel (/admin/settings).

### Blocks

Blocks are useful to display custom content in your views.  
You can get the content of a block with ``` Blocks::build('blockname') ```.

### Translations

Translations can be stored in the database through the admin panel (/admin/translations).

You can call DB translation everywhere with ``` Lang::get('db.Key') ```, ``` trans('db.Key') ``` or ``` @lang('db.Key') ```.

### Sitemap

Route sitemap.xml generates a sitemap file in XML format.  
To add modules to the site map configure app/config/sitemap.php.

### Settings

Change website title, and other options trough the settings panel. Settings are saved in the database

### History

*created*, *updated*, *deleted*, *online* and *offline* actions are logged in database.  
25 latest records are displayed in the back office’s dashboard.

## Facades

Each modules has a facade that give you access to the repository, you can call for example ```News::latest(3)``` to get the three latest news.  
Check available methods in each module’s repository.

## Artisan commands

Commands are located in app/TypiCMS/Commands

* Installation of TypiCMS

  ```
  php artisan typicms:install
  ```

* Set cache key prefix in app/config/cache.php

  ```
  php artisan cache:prefix yourCachePrefix
  ```

* Initial migration and seed

  ```
  php artisan typicms:database
  ```

## Contributing

Feel free to fork and make pull requests directly on the master branch!

TypiCMS coding style follows the "recommended" preset of StyleCI. See https://styleci.readme.io/docs/presets#recommended

Thanks to all contributors!

## License

TypiCMS is an open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
