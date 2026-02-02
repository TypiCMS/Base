---
name: TypiCMS Development
description: This skill should be used when the user asks to "create a module", "add a TypiCMS module", "create a new content type", "add fields to a module", "work with translations", "customize a module", mentions TypiCMS architecture, module structure, or wants to understand how TypiCMS modules work.
version: 1.0.0
---

# TypiCMS Development Patterns

This skill provides guidance for developing with TypiCMS, a modular multilingual CMS built on Laravel.

## Core Concepts

### Module Architecture

TypiCMS organizes functionality into self-contained modules in `/Modules/`. Each module follows a consistent structure:

```
Modules/ModuleName/
├── Composers/
│   └── SidebarViewComposer.php
├── config/
│   └── modulename.php
├── Exports/
│   └── Export.php
├── Facades/
│   └── ModuleName.php
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── ApiController.php
│   │   └── PublicController.php
│   └── Requests/
│       └── FormRequest.php
├── Models/
│   └── ModuleName.php
├── Observers/
│   └── CustomObserver.php (optional)
├── Presenters/
│   └── ModulePresenter.php
├── Providers/
│   └── ModuleServiceProvider.php
└── routes/
    └── modulename.php
```

### Database Conventions

- All tables use the `typicms_` prefix (handled automatically)
- Translatable fields use JSON columns with locale keys: `{"en": "value", "fr": "valeur"}`
- Use `json()` column type with `new Expression('(JSON_OBJECT())')` default

### Multilingual Support

Supported locales are configured in `config/typicms.php`. Models use the `HasTranslations` trait with a `$translatable` array defining which fields support multiple languages.

## Creating a New Module

### Step 1: Create the Model

Extend `TypiCMS\Modules\Core\Models\Base` and use appropriate traits:

```php
<?php

declare(strict_types=1);

namespace TypiCMS\Modules\ModuleName\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Core\Traits\Historable;
use TypiCMS\Modules\ModuleName\Presenters\ModulePresenter;
use TypiCMS\Translatable\HasTranslations;

class ModuleName extends Base
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected string $presenter = ModulePresenter::class;

    protected $guarded = [];

    /** @var array<string> */
    public array $translatable = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    /** @var array<string> */
    public array $tipTapContent = [
        'body',
    ];

    public function url(?string $locale = null): string
    {
        $locale ??= app()->getLocale();
        $route = $locale . '::modulename';
        $slug = $this->translate('slug', $locale) !== ''
            ? $this->translate('slug', $locale)
            : null;

        return Route::has($route) && $slug ? url(route($route, $slug)) : url('/');
    }
}
```

### Step 2: Create the Migration

Use JSON columns for translatable fields:

```php
Schema::create('modulename', function (Blueprint $table): void {
    $table->id();
    $table->foreignId('image_id')->nullable()->constrained('files')->nullOnDelete();
    $table->json('status')->default(new Expression('(JSON_OBJECT())'));
    $table->json('title')->default(new Expression('(JSON_OBJECT())'));
    $table->json('slug')->default(new Expression('(JSON_OBJECT())'));
    $table->json('summary')->default(new Expression('(JSON_OBJECT())'));
    $table->json('body')->default(new Expression('(JSON_OBJECT())'));
    $table->timestamps();
});
```

### Step 3: Create the Service Provider

Register routes, config, views, facades, and observers:

```php
<?php

declare(strict_types=1);

namespace TypiCMS\Modules\ModuleName\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Override;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Observers\TipTapHTMLObserver;
use TypiCMS\Modules\ModuleName\Composers\SidebarViewComposer;
use TypiCMS\Modules\ModuleName\Facades\ModuleName as ModuleNameFacade;
use TypiCMS\Modules\ModuleName\Models\ModuleName;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modulename.php', 'typicms.modules.modulename');
        $this->loadRoutesFrom(__DIR__ . '/../routes/modulename.php');
        $this->loadViewsFrom(resource_path('views'), 'modulename');

        AliasLoader::getInstance()->alias('ModuleName', ModuleNameFacade::class);

        ModuleName::observe(new SlugObserver());
        ModuleName::observe(new TipTapHTMLObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        View::composer('modulename::public.*', function ($view): void {
            $view->page = getPageLinkedToModule('modulename');
        });
    }

    #[Override]
    public function register(): void
    {
        $this->app->bind('ModuleName', ModuleName::class);
    }
}
```

### Step 4: Create Controllers

**AdminController** - Extend `BaseAdminController`:

```php
final class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('modulename::admin.index');
    }

    public function create(): View
    {
        return view('modulename::admin.create', ['model' => new ModuleName()]);
    }

    public function edit(ModuleName $modulename): View
    {
        return view('modulename::admin.edit', ['model' => $modulename]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $model = ModuleName::query()->create($request->validated());
        return $this->redirect($request, $model)->withMessage(__('Item successfully created.'));
    }

    public function update(ModuleName $modulename, FormRequest $request): RedirectResponse
    {
        $modulename->update($request->validated());
        return $this->redirect($request, $modulename)->withMessage(__('Item successfully updated.'));
    }
}
```

**ApiController** - Extend `BaseApiController` for data tables and AJAX operations.

**PublicController** - Extend `BasePublicController` for frontend routes.

### Step 5: Create Form Request

Use array notation with `.*` suffix for translatable fields:

```php
class FormRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'image_id' => ['nullable', 'integer'],
            'title.*' => ['nullable', 'max:255'],
            'slug.*' => ['nullable', 'alpha_dash', 'max:255', 'required_if:status.*,1'],
            'status.*' => ['boolean'],
            'summary.*' => ['nullable', 'max:1000'],
            'body.*' => ['nullable', 'max:30000'],
        ];
    }
}
```

### Step 6: Create Config File

```php
return [
    'linkable_to_page' => true,
    'per_page' => 50,
    'order' => [
        'created_at' => 'desc',
    ],
    'sidebar' => [
        'icon' => '<i class="icon-file-text"></i>',
        'weight' => 30,
    ],
    'permissions' => [
        'read modulename' => 'Read',
        'create modulename' => 'Create',
        'update modulename' => 'Update',
        'delete modulename' => 'Delete',
    ],
];
```

## Common Traits

| Trait | Purpose |
|-------|---------|
| `HasTranslations` | Multilingual field support |
| `HasFiles` | File attachments (images, documents) |
| `HasTags` | Tagging functionality |
| `Historable` | Activity logging |
| `SortableTrait` | Drag-and-drop ordering |
| `PresentableTrait` | Presenter pattern support |

## Helper Functions

| Function | Description |
|----------|-------------|
| `locales()` | Get all configured locales |
| `mainLocale()` | Get the primary locale |
| `homeUrl()` | Get home URL for current locale |
| `column($name)` | Get JSON column path for locale (e.g., `title->en`) |
| `getPageLinkedToModule($module)` | Get CMS page linked to a module |

## Views Location

Views are stored in `resources/views/vendor/{modulename}/` with subfolders:
- `admin/` - Admin panel views (index, create, edit, _form)
- `public/` - Frontend views (index, show, _list-item)

## Observers

| Observer | Purpose | Use When |
|----------|---------|----------|
| `SlugObserver` | Auto-generates unique slugs from title for multilingual models | Model uses `HasTranslations` trait |
| `SlugMonolingualObserver` | Auto-generates unique slugs from title for non-translatable models | Model has simple `slug` and `title` string fields |
| `TipTapHTMLObserver` | Patches TipTap HTML output (e.g., removes `<p>` tags inside `<li>` elements) | Model has `$tipTapContent` array with rich text fields |

## Additional Resources

### Reference Files

For detailed patterns and code examples:
- **`references/module-patterns.md`** - Complete module patterns and variations
- **`examples/`** - Working code examples from existing modules
