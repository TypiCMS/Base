<li class="{{ $name }}-nav-item {{ $name }}-nav-item-{{ $menulink->id }} {{ $menulink->class }}" id="menuitem_{{ $menulink->id }}" role="menuitem">
    <a class="{{ $name }}-nav-link {{ $menulink->items->count() > 0 ? 'dropdown-toggle' : '' }}{{ !empty($menulink->parent) ? 'dropdown-item' : '' }}" href="{{ $menulink->items->count() > 0 ? '#' : url($menulink->href) }}" @if ($menulink->target === '_blank') target="_blank"
        rel="noopener noreferrer" @endif @if ($menulink->items->count() > 0) role="button" id="menuitem_{{ $menulink->id }}_id" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" @endif>
        @if ($menulink->image !== null)
            <img class="{{ $name }}-nav-image" aria-hidden="true" src="{{ $menulink->present()->image(64, 64) }}" width="32" height="32" alt="" />
        @endif
        <span class="{{ $name }}-nav-label">{{ $menulink->title }}</span>
    </a>
    @if ($menulink->items->count() > 0)
        <ul class="{{ $name }}-nav-dropdown dropdown-menu" aria-labelledby="menuitem_{{ $menulink->id }}_id" role="menu">
            @foreach ($menulink->items as $menulink)
                @include('menus::public._item', ['menulink' => $menulink])
            @endforeach
        </ul>
    @endif
</li>
