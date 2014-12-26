# TypiCMS
[![Build Status](https://travis-ci.org/sdebacker/TypiCMS.svg?branch=master)](https://travis-ci.org/sdebacker/TypiCMS)
[![Latest Stable Version](https://poser.pugx.org/sdebacker/typicms/v/stable.svg)](https://packagist.org/packages/sdebacker/typicms)
[![License](https://poser.pugx.org/sdebacker/typicms/license.svg)](https://packagist.org/packages/sdebacker/typicms)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sdebacker/TypiCMS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sdebacker/TypiCMS/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/5c96a56f-2006-4911-bf7c-d9afad35db5a/mini.png)](https://insight.sensiolabs.com/projects/5c96a56f-2006-4911-bf7c-d9afad35db5a)

TypiCMS is a multilingual content management system built with [Laravel 4.2](http://laravel.com).
[Bower](http://bower.io) and [gulp](http://gulpjs.com) are used for assets management and user interface is build with [Bootstrap 3](http://getbootstrap.com) with Less.

**Demo**

* [Back office](http://typicms.samsfactory.com/admin) (login: ``` admin@example.com ```, password: ``` admin ```)
* [Front office](http://typicms.samsfactory.com)

![TypiCMS screenshot](http://typicms.samsfactory.com/uploads/pages/TypiCMS-screenshot.png)

## Table of contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
  - [Quick installation](#quick-installation)
  - [Manual installation](#manual-installation)
  - [Bower & Gulp](#bower--gulp)
  - [Configuration](#configuration)
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
  - [User and groups](#users-and-groups)
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

This kind of urls are managed by the CMS :

**Modules:**

* /en/events/slug-in-english
* /fr/evenements/slug-en-francais

**Pages:**

* /en/parent-pages-slug-en/subpage-slug-en/page-slug-en
* /fr/parent-pages-slug-fr/subpage-slug-fr/page-slug-fr

## Requirements

- PHP >= 5.4.0
- MCrypt PHP Extension
- Memcached or Redis or APC

## Installation

### Quick installation

1. Install [Node.js](http://nodejs.org), [Bower](http://bower.io) and [gulp](http://gulpjs.com)
2. Create an empty MySQL database
3. Create a new project

   ```
   composer create-project sdebacker/typicms mywebsite
   ```
4. Enter newly created folder

   ```
   cd mywebsite
   ```
5. DB Migrate and seed, create user, npm install, bower install and directory rights

   ```
   php artisan typicms:install
   ```
6. Go to http://mywebsite.local/admin and log in.

### Manual installation

1. Create an empty database
2. Download TypiCMS

   ```
   git clone https://github.com/sdebacker/TypiCMS.git mywebsite
   ```
3. Enter newly created folder

   ```
   cd mywebsite
   ```
4. Install dependencies with [Composer](https://getcomposer.org/doc/00-intro.md)

   ```
   composer install
   ```
5. Set a new encryption key

   ```
   php artisan key:generate
   ```
6. Change cache prefix in app/config/cache.php

   ```
   php artisan cache:prefix yourCachePrefix
   ```
7. Rename .env.example to .env

   ```
   mv .env.example .env
   ```
8. Fill in your database credentials in .env

9. Migrate and seed Database

   ```
   php artisan migrate --seed
   ```
10. Set permissions

    ```
    chmod -R 777 app/storage
    chmod -R 777 public/uploads
    ```
11. Go to http://mywebsite.local/admin and log in:

   * email: ```admin@example.com```
   * password: ```admin```

### Bower & Gulp

In order to work on assets, you need to install [Node.js](http://nodejs.org), [Bower](http://bower.io) and [gulp](http://gulpjs.com), then cd to your website folder and run these commands:

1. Install bower packages according to bower.json (directory app/assets/components)

   ```
   bower install
   ```
2. Install Gulp packages according to gulpfile.js (directory node_modules)

   ```
   npm install
   ```
3. Compile admin and public assets

   ```
   gulp
   ```

### Configuration

1. Set available locales and default locale in app/config/app.php
2. Cache driver is set to memcached, you can change it to another taggable cache system such as redis in app/config/cache.php

## Modules

### Pages

Pages are nestable with drag and drop, on drop, uris are generated and saved in database. A page has routes for each translation.

### Menus

Each menu have nestable entries. One entry can be linked to a module, page, URI or URL.
You can get a menu HTML formated with ``` Menus::build('menuname') ```.
An icon can easily be added to a menu item by filling icon class field.

### Projects

Projects have categories, projects urls follows this pattern : /en/projects/category-slug/project-slug

### Categories

Categories has many projects.

### Tags

Tags are linked to projects and use [Selectize](https://brianreavis.github.io/selectize.js/) jQuery plugin.
It has many to many polymorphic relations so it could easily be linked to other modules.

### Events

Events have starting and ending dates

### News

Simple news module with linked files/images galleries.

### Contacts

Frontend contact form and admin side records management.

### Partners

A partner has a logo, website url, title and body content.

### Files

Files module allows you to upload multiple files, it uses [DropzoneJS](http://www.dropzonejs.com).
Thumbnails are generated on the fly with [Croppa](https://github.com/BKWLD/croppa).

### Galleries

You can create as many galleries as you want, each gallery has many files.
Galleries are linkable to any module item through a polymorphic many to many relation, for now only News module is properly set up to support galleries.

### Users and groups

[Sentry 2](https://cartalyst.com/manual/sentry) is used to manage users, groups and permissions.
Users registration can be enable through the settings panel (/admin/settings).

### Blocks

Blocks are usefull for custom content to display in your views.
You can get content of a block with ``` Blocks::build('blockname') ```.

### Translations

Translations can be stored in database through the admin panel (/admin/translations).

You can call DB translation everywhere with ``` Lang::get('db.Key') ```, ``` trans('db.Key') ``` or ``` @lang('db.Key') ```.

### Sitemap

Route sitemap.xml generate a sitemap file in xml format.
Configure modules to add to the site map in app/config/sitemap.php file.

### Settings

Change website title, and other options trough the settings panel. Settings are saved in database.

### History

History table records changes and 25 latest are displayed in back office’s dashboard. Logged actions are *created*, *updated*, *deleted*, *set online* and *set offline*.
It works for each modules excepted Users and Groups.

## Facades

Modules that have their own Facade: News, Events, Projects, Places, Partners, Galleries, Blocks, Files and Menus.

In your views, you can call for example ```News::latest(3)``` to get the three latest news.
Check available methods in each module's repository.

## Artisan commands

Commands are located in app/TypiCMS/Commands

* Initialisation of TypiCMS

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

## Roadmap

* Improve user interface
* Make modules as packages
* Build more tests

## Contributing

Feel free to fork and make pull requests directly on master branch!
TypiCMS follows [PSR-2](http://www.php-fig.org/psr/psr-2/) standard.

Thanks to [elvendor](https://github.com/elvendor) and [jekjek](https://github.com/jekjek) for their contributions!

## Testing

Some admin controllers are actually tested, more tests needed.

## License

TypiCMS is an open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
