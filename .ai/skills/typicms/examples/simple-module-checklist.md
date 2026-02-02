# Simple Module Creation Checklist

Use this checklist when creating a new TypiCMS module.

## Files to Create

### 1. Model (`Modules/ModuleName/Models/ModuleName.php`)
- [ ] Extend `TypiCMS\Modules\Core\Models\Base`
- [ ] Add `HasTranslations` trait
- [ ] Define `$translatable` array
- [ ] Define `$tipTapContent` array if using rich text
- [ ] Add `url()` method for public URLs
- [ ] Add relationships (image, category, etc.)

### 2. Migration (`database/migrations/xxxx_create_modulename_table.php`)
- [ ] Use JSON columns for translatable fields
- [ ] Add `new Expression('(JSON_OBJECT())')` default for JSON fields
- [ ] Add foreign keys for images (`files` table)
- [ ] Only create `up()` method (no `down()`)

### 3. Service Provider (`Modules/ModuleName/Providers/ModuleServiceProvider.php`)
- [ ] Merge config
- [ ] Load routes
- [ ] Load views from `resource_path('views')`
- [ ] Register facade alias
- [ ] Attach `SlugObserver`
- [ ] Attach `TipTapHTMLObserver` if using rich text
- [ ] Register sidebar view composer
- [ ] Bind model in `register()` method

### 4. Config (`Modules/ModuleName/config/modulename.php`)
- [ ] Set `linkable_to_page`
- [ ] Set `per_page`
- [ ] Define `order` array
- [ ] Configure `sidebar` (icon, weight)
- [ ] Define `permissions`

### 5. Controllers
- [ ] `AdminController` - index, create, edit, store, update
- [ ] `ApiController` - index, updatePartial, destroy
- [ ] `PublicController` - index, show (if public-facing)

### 6. Form Request (`Modules/ModuleName/Http/Requests/FormRequest.php`)
- [ ] Extend `AbstractFormRequest`
- [ ] Use `.*` suffix for translatable fields
- [ ] Add validation rules

### 7. Routes (`Modules/ModuleName/routes/modulename.php`)
- [ ] Public routes (if linkable to page)
- [ ] Admin routes with permissions
- [ ] API routes

### 8. Facade (`Modules/ModuleName/Facades/ModuleName.php`)
- [ ] Return model name from `getFacadeAccessor()`

### 9. Presenter (`Modules/ModuleName/Presenters/ModulePresenter.php`)
- [ ] Extend `TypiCMS\Modules\Core\Presenters\Presenter`

### 10. Sidebar Composer (`Modules/ModuleName/Composers/SidebarViewComposer.php`)
- [ ] Check gate permission
- [ ] Add to appropriate sidebar group

### 11. Views (`resources/views/vendor/modulename/`)
- [ ] `admin/index.blade.php`
- [ ] `admin/create.blade.php`
- [ ] `admin/edit.blade.php`
- [ ] `admin/_form.blade.php`
- [ ] `public/index.blade.php` (if public)
- [ ] `public/show.blade.php` (if public)

## Post-Creation Steps

1. [ ] Run migration: `php artisan migrate`
2. [ ] Clear cache: `php artisan cache:clear`
3. [ ] Add permissions to roles in admin panel
4. [ ] Link module to a page (if `linkable_to_page` is true)

## Common Traits Reference

| Need | Trait to Add |
|------|--------------|
| Translations | `HasTranslations` |
| File attachments | `HasFiles` |
| Tags | `HasTags` |
| Activity log | `Historable` |
| Drag-and-drop sort | `SortableTrait` (+ `Sortable` interface) |
| Presenter | `PresentableTrait` |

## Naming Conventions

| Type | Convention | Example |
|------|------------|---------|
| Module folder | PascalCase singular | `News`, `Event` |
| Model | PascalCase singular | `News`, `Event` |
| Table | snake_case plural | `news`, `events` |
| Route name | kebab-case | `index-news`, `edit-event` |
| Config key | snake_case | `typicms.modules.news` |
| Permission | snake_case | `read news`, `create events` |
