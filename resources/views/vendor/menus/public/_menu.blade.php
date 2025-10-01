@if ($menu = Menus::getMenu($name))
    @if (($menulinks = $menu->menulinks->load('image')) and $menulinks->count() > 0)
        <ul class="{{ $name }}-nav-list {{ $menu->class }}" role="menu">
            @foreach ($menulinks as $menulink)
                @include('menus::public._item')
            @endforeach
        </ul>
    @endif
@endif
