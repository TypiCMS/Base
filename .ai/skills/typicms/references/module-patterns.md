# TypiCMS Module Patterns Reference

This document contains detailed patterns for TypiCMS module development.

## Route Patterns

### Complete Route File Structure

```php
<?php

declare(strict_types=1);

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Models\Page;
use TypiCMS\Modules\ModuleName\Http\Controllers\AdminController;
use TypiCMS\Modules\ModuleName\Http\Controllers\ApiController;
use TypiCMS\Modules\ModuleName\Http\Controllers\PublicController;

/*
 * Front office routes
 */
if (($page = getPageLinkedToModule('modulename')) instanceof Page) {
    $middleware = $page->private ? ['public', 'auth'] : ['public'];
    foreach (locales() as $lang) {
        if ($page->isPublished($lang) && ($path = $page->path($lang))) {
            Route::middleware($middleware)
                ->prefix($path)
                ->name($lang . '::')
                ->group(function (Router $router): void {
                    $router->get('/', [PublicController::class, 'index'])->name('index-modulename');
                    $router->get('{slug}', [PublicController::class, 'show'])->name('modulename');
                });
        }
    }
}

/*
 * Admin routes
 */
Route::middleware('admin')
    ->prefix('admin')
    ->name('admin::')
    ->group(function (Router $router): void {
        $router->get('modulename', [AdminController::class, 'index'])
            ->name('index-modulename')
            ->middleware('can:read modulename');
        $router->get('modulename/create', [AdminController::class, 'create'])
            ->name('create-modulename')
            ->middleware('can:create modulename');
        $router->get('modulename/{modulename}/edit', [AdminController::class, 'edit'])
            ->name('edit-modulename')
            ->middleware('can:read modulename');
        $router->post('modulename', [AdminController::class, 'store'])
            ->name('store-modulename')
            ->middleware('can:create modulename');
        $router->put('modulename/{modulename}', [AdminController::class, 'update'])
            ->name('update-modulename')
            ->middleware('can:update modulename');
    });

/*
 * API routes
 */
Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router): void {
    $router->get('modulename', [ApiController::class, 'index'])
        ->middleware('can:read modulename');
    $router->patch('modulename/{modulename}', [ApiController::class, 'updatePartial'])
        ->middleware('can:update modulename');
    $router->delete('modulename/{modulename}', [ApiController::class, 'destroy'])
        ->middleware('can:delete modulename');
});
```

## API Controller Patterns

### Index with QueryBuilder

```php
public function index(Request $request): LengthAwarePaginator
{
    $query = ModuleName::query()
        ->selectFields();

    return QueryBuilder::for($query)
        ->allowedSorts(['status_translated', 'title_translated', 'created_at'])
        ->allowedFilters([
            AllowedFilter::custom('title', new FilterOr()),
        ])
        ->allowedIncludes(['image'])
        ->paginate($request->integer('per_page'));
}
```

### Partial Update for Translatable Fields

```php
protected function updatePartial(ModuleName $model, Request $request): void
{
    foreach ($request->only('status') as $key => $content) {
        if ($model->isTranslatableAttribute($key)) {
            foreach ($content as $lang => $value) {
                $model->setTranslation($key, $lang, $value);
            }
        } else {
            $model->{$key} = $content;
        }
    }

    $model->save();
}
```

## Public Controller Patterns

```php
final class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = ModuleName::query()
            ->published()
            ->order()
            ->with('image')
            ->paginate(config('typicms.modules.modulename.per_page'));

        return view('modulename::public.index', ['models' => $models]);
    }

    public function show(string $slug): View
    {
        $model = ModuleName::query()
            ->published()
            ->whereSlugIs($slug)
            ->with('image')
            ->firstOrFail();

        return view('modulename::public.show', ['model' => $model]);
    }
}
```

## Sidebar View Composer

```php
<?php

declare(strict_types=1);

namespace TypiCMS\Modules\ModuleName\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use TypiCMS\Modules\Sidebar\SidebarGroup;
use TypiCMS\Modules\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view): void
    {
        if (Gate::denies('read modulename')) {
            return;
        }

        $view->offsetGet('sidebar')->group(__('Content'), function (SidebarGroup $group): void {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Module Name'), function (SidebarItem $item): void {
                $item->id = 'modulename';
                $item->icon = config('typicms.modules.modulename.sidebar.icon');
                $item->weight = config('typicms.modules.modulename.sidebar.weight');
                $item->route('admin::index-modulename');
            });
        });
    }
}
```

## Facade Pattern

```php
<?php

declare(strict_types=1);

namespace TypiCMS\Modules\ModuleName\Facades;

use Illuminate\Support\Facades\Facade;

class ModuleName extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ModuleName';
    }
}
```

## Presenter Pattern

```php
<?php

declare(strict_types=1);

namespace TypiCMS\Modules\ModuleName\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;

class ModulePresenter extends Presenter
{
    public function headerImage(): ?string
    {
        if ($this->entity->image) {
            return $this->image(2880, null, [], 'image');
        }

        return null;
    }
}
```

## Model Relationships

### BelongsTo (Image)

```php
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TypiCMS\Modules\Core\Models\File;

/** @return BelongsTo<File, $this> */
public function image(): BelongsTo
{
    return $this->belongsTo(File::class, 'image_id');
}
```

### BelongsTo (Category)

```php
/** @return BelongsTo<ModuleCategory, $this> */
public function category(): BelongsTo
{
    return $this->belongsTo(ModuleCategory::class);
}
```

### Thumb Attribute

```php
use Illuminate\Database\Eloquent\Casts\Attribute;

protected $appends = ['thumb'];

/** @return Attribute<string, null> */
protected function thumb(): Attribute
{
    return Attribute::make(get: fn () => $this->present()->image(null, 54));
}
```

## Sortable Module Pattern

For modules with drag-and-drop ordering:

```php
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ModuleName extends Base implements Sortable
{
    use SortableTrait;

    /** @var array<string, string> */
    public array $sortable = [
        'order_column_name' => 'position',
    ];
}
```

Add to migration:

```php
$table->unsignedInteger('position')->default(0);
```

## Admin View Patterns

### _form.blade.php

```blade
<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Module Name')" />
    <x-core::title :$model :default="__('New item')" />
    <x-core::form-buttons :$model />
</div>

<div class="content">
    <x-core::form-errors />

    <div class="row">
        <div class="col-lg-8">
            <x-core::title-and-slug-fields :locales="locales()" />
            <x-core::toggle-status-button />

            {!! TranslatableBootForm::textarea(__('Summary'), 'summary')->rows(4) !!}
            <x-core::tiptap-editors :model="$model" name="body" :label="__('Body')" />
        </div>
        <div class="col-lg-4">
            <div class="right-column">
                <file-manager></file-manager>
                <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
                <files-field :init-files="{{ $model->files }}"></files-field>
                {!! TranslatableBootForm::textarea(__('Meta title'), 'meta_title')->rows(2) !!}
                {!! TranslatableBootForm::textarea(__('Meta description'), 'meta_description')->rows(4) !!}
            </div>
        </div>
    </div>
</div>
```

### create.blade.php

```blade
@extends('core::admin.master')

@section('title', __('New item'))

@section('main')
    {!! BootForm::open()->action(route('admin::store-modulename'))->multipart() !!}
        @include('modulename::admin._form')
    {!! BootForm::close() !!}
@endsection
```

### edit.blade.php

```blade
@extends('core::admin.master')

@section('title', $model->title)

@section('main')
    {!! BootForm::open()->action(route('admin::update-modulename', $model))->method('put')->multipart()->bind($model) !!}
        @include('modulename::admin._form')
    {!! BootForm::close() !!}
@endsection
```

## Export Class Pattern

```php
<?php

declare(strict_types=1);

namespace TypiCMS\Modules\ModuleName\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use TypiCMS\Modules\ModuleName\Models\ModuleName;

class Export implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return ModuleName::query()->order();
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Status', 'Created At'];
    }

    public function map($model): array
    {
        return [
            $model->id,
            $model->title,
            $model->isPublished() ? 'Published' : 'Draft',
            $model->created_at->format('Y-m-d H:i'),
        ];
    }
}
```

## Category Pattern

Many modules have associated categories. Follow the News/NewsCategory pattern:

1. Create `ModuleCategory` model with similar structure
2. Add `category_id` foreign key to main model
3. Create separate config file (`module_categories.php`)
4. Add category routes and controllers
5. Register category facade in service provider

## Feedable Interface

For RSS feed support:

```php
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class ModuleName extends Base implements Feedable
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->summary ?? '')
            ->updated($this->updated_at)
            ->link($this->url())
            ->authorName(config('app.name'));
    }
}
```

Add to config:

```php
'has_feed' => true,
```

## Observer Patterns

### SlugObserver (Multilingual)

Use for models with `HasTranslations` trait. Auto-generates unique slugs per locale from the title field.

```php
use TypiCMS\Modules\Core\Observers\SlugObserver;

// In ModuleServiceProvider::boot()
ModuleName::observe(new SlugObserver());
```

**How it works:**
- Generates slug from title using `Str::slug()` for each locale
- Ensures uniqueness by appending `-1`, `-2`, etc. if slug exists
- Checks against `slug->{locale}` JSON path in database

### SlugMonolingualObserver (Non-translatable)

Use for models without translations (simple string `slug` and `title` fields).

```php
use TypiCMS\Modules\Core\Observers\SlugMonolingualObserver;

// In ModuleServiceProvider::boot()
ModuleName::observe(new SlugMonolingualObserver());
```

**How it works:**
- Generates slug from title only if slug is null
- Ensures uniqueness by appending `-1`, `-2`, etc.
- Checks against simple `slug` column

### TipTapHTMLObserver

Use for models with TipTap rich text fields. Patches the HTML output to fix formatting issues (e.g., removes nested `<p>` tags inside `<li>` elements).

```php
use TypiCMS\Modules\Core\Observers\TipTapHTMLObserver;

// In ModuleServiceProvider::boot()
ModuleName::observe(new TipTapHTMLObserver());
```

**Requirements:**
- Model must have `$tipTapContent` property listing rich text fields:

```php
/** @var array<string> */
public array $tipTapContent = [
    'body',
    'description',
];
```

**How it works:**
- Runs on `saving` event
- Iterates through all fields in `$tipTapContent`
- For each locale, patches the HTML content
- Specifically removes `<p>` tags that TipTap incorrectly nests inside `<li>` elements

## Publishing Vendor Modules

To customize a vendor module:

```bash
php artisan typicms:publish modulename
```

This copies the module to `/Modules/` for customization.

## Creating New Module (Artisan)

To scaffold a new module:

```bash
php artisan typicms:create ModuleName
```

This creates the basic module structure that can be customized.
