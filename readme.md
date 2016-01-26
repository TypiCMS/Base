# TypiCMS

[![Packagist](https://img.shields.io/packagist/v/typicms/base.svg?style=flat-square)]()
[![Packagist](https://img.shields.io/packagist/l/typicms/base.svg?style=flat-square)]()
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/96951b30-0060-414c-992d-df965bd63000.svg?style=flat-square)]()
[![Scrutinizer](https://img.shields.io/scrutinizer/g/typicms/base.svg?style=flat-square)]()

TypiCMS is a modular multilingual content management system built with [Laravel 5.2](http://laravel.com). Out of the box you can manage pages, events, news, places, sliders, etc.

![TypiCMS screenshot](http://typicms.org/uploads/files/typicms-screenshot.png?1)

## Table of contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
  - [npm & Gulp](#npm--gulp)
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
- [Upgrade instructions](#upgrade-instructions)
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

First install [Node.js](http://nodejs.org) and [gulp](http://gulpjs.com)

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

### npm & Gulp

In order to work on assets, you need to install [Node.js](http://nodejs.org) and [gulp](http://gulpjs.com), then cd to your website folder and run these commands:

1. Install gulp packages according to gulpfile.js (directory **node_modules**)

   ```
   npm install
   ```
2. Compile admin and public assets

   ```
   gulp all
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
2. Add ```TypiCMS\Modules\News\Providers\ModuleProvider::class,``` to **config/app.php**, before ```TypiCMS\Modules\Core\Providers\ModuleProvider::class,```
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
3. Add ```TypiCMS\Modules\Cats\Providers\ModuleProvider::class,``` to **config/app.php**, before ```TypiCMS\Modules\Core\Providers\ModuleProvider::class,```
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

Commands are located in **/vendor/typicms/core/src/Commands**

### Installation of TypiCMS

```
php artisan typicms:install
```

### Set cache key prefix in app/config/cache.php

```
php artisan cache:prefix yourCachePrefix
```

This command is triggered by ```typicms:install```

### Initial migration and seed

```
php artisan typicms:database
```

This command is triggered by ```typicms:install```

### Clean the directory public/html

```
php artisan clear-html
```

### Publish a module

If you want to modify a module, for example add some fields or a relation, you can not do it easily because each module is in vendor directory.
The solution is to remove it from composer and copy it to the **/Modules** directory. For example, the module **Pages** will be published by running this command:

```
php artisan typicms:publish pages
```

These steps will be executed:

1. Publishing of views and migrations for Pages module.
2. Copying of everything excepted views and migrations from **/vendor/typicms/pages/src** to **/Modules/Pages**.
3. Running ```composer remove typicms/pages```.

When a module is published, it will be tracked by git and you will be able to make changes in **/Modules/Modulename** directory without loosing changes when running ```composer update```.

### Create a module

You can easily scaffold a module, for a module named Cats, run this command:

```
php artisan typicms:create cats
```

##Upgrade instructions

###Upgrade from 2.6.x to 2.7.x

- In **config/app.php**:
  - remove ```TypiCMS\TranslatableBootForms\TranslatableBootFormsServiceProvider::class,```;
  - add ```AdamWathan\BootForms\BootFormsServiceProvider::class,``` to the providers list;
  - add ```Propaganistas\LaravelTranslatableBootForms\TranslatableBootFormsServiceProvider::class,``` to the providers list;
  - add ```'TranslatableBootForm' => Propaganistas\LaravelTranslatableBootForms\Facades\TranslatableBootForm::class,``` to the aliases list.
- Run ```composer require propaganistas/laravel-translatable-bootforms```.
- Run ```composer remove typicms/translatablebootforms```.
- In composer.json, change version of all typicms modules from ~2.6.0 to ~2.7.0.
- Run ```composer update```.
- Remove **resources/vendor/*/admin** directories, republish them if needed.

###Upgrade from 2.5.x to 2.6.x

- Follows the steps needed to [upgrade to Laravel 5.2](https://laravel.com/docs/5.2/upgrade#upgrade-5.2.0)
- If you have customs modules in /Modules directory, you will have to add missing methods in adminControllers and apiControllers and setup [implicit model binding](https://laravel.com/docs/5.2/routing#route-model-binding).
- ```logo`` and/or ```logoOrTitle``` methods are removed, in public master.blade.php, update with recent changes made to version 2.6.

###Upgrade from 2.4.34 to 2.5.7

Create an empty writable directory **public/html**, add in it a **.gitignore** file with this content :

```
*
!.gitignore
```

In ```composer.json``` :

- change each modules from ~2.4.x to ~2.5.0
- change edvinaskrucas/notification to ~5.1.0
- change typicms/translatablebootforms to ~2.2.0
- Add ```"cviebrock/image-validator": "~2.0.0",```
- Add ```"php artisan clear-html"``` in **post-install-cmd** and **post-update-cmd** scripts
- Replace ```php artisan clear-compiled``` by ```php clear-compiled```

Run ```composer update```

In **App/Http/Kernel.php**

- add to middleware array
    - \TypiCMS\Modules\Core\Http\Middleware\PublicLocale::class,
    - \Krucas\Notification\Middleware\NotificationMiddleware::class,
- remove ```publicLocale``` from routes middleware

In **config/translatable.php**, add ```'locale' => null```.

In **config/auth.php**, change ```'emails.password'``` to ```'users::emails.password'```.

Remove these files, they will be recreated by ```vendor:publish``` command

- resources/views/vendor/core/admin/_tabs-lang-form.blade.php
- resources/views/vendor/core/admin/_tabs-lang-list.blade.php
- resources/views/vendor/core/admin/_tabs-lang.blade.php
- resources/views/vendor/core/public/_languages-menu.blade.php

Copy the clear-compiled file to root directory

In table pages, add ```no_cache` tinyint(1) NOT NULL DEFAULT '0'```

In table galleries, add ```image` varchar(255) NULL```

In **resources/views/vendor/core/admin/master.blade.php**, replace ```{{ Notification::[…] }}``` by ```{!! Notification::[…] !!}``` (3 lines)

Remove each occurrence of ```@inject('page', 'typicms.xxxx.page')``` from each front end view of each module (index.blade.php, show.blade.php,…), $page is now injected in the view via a view composer, see ModuleProvider classes.

Run ```php artisan vendor:publish```

Replace **package.json** file new one.

Copy **set-content-locale.js** to **resources/assets/js/admin**

In **resource/assets/less/admin/master.less**, remove ```@import (inline) '../../../../node_modules/alertify.js/dist/css/alertify-bootstrap-3.css'```;

In **_index.blade.php** files, replace ```<div class="btn-toolbar" role="toolbar" ng-include="'/views/partials/btnLocales.html'"></div>``` by ```@include('core::admin._tabs-lang-list')```

Remove **bower_components** and **node_modules** directories

Replace files in **resource/assets/less/admin/** directory with new one

Run ```npm install```, ```bower update```, then ```gulp all```

## Contributing

Feel free to fork and make pull requests directly on the master branch!

TypiCMS coding style follows the "recommended" preset of StyleCI. See https://styleci.readme.io/docs/presets#recommended

Thanks to all contributors!

## License

TypiCMS is an open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
