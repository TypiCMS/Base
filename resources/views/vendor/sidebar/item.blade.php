<li class="nav-sidebar-item sidebar-item-{{ $item->id }} {{ $item->state }} @if($item->hasItems()) treeview @endif">
    <a class="nav-sidebar-item-link @if($item->hasAppend())hasAppend @endif" href="{{ $item->route }}">
        <i class="nav-sidebar-item-link-icon icon {{ $item->icon ?? 'fa fa-angle-double-right' }}"></i>
        <div class="nav-sidebar-item-link-label">{{ $item->name }}</div>

        @if($item->hasBadge())
            @foreach($item->badges as $badge)
                {!! $badge->render() !!}
            @endforeach
        @endif

        @if($item->hasItems())<i class="{{ $item->toggleIcon ?? 'fa fa-angle-left' }} pull-right"></i>@endif
    </a>

    @if($item->hasAppend())
        @foreach($item->appends as $append)
            {!! $append->render() !!}
        @endforeach
    @endif

    @if($item->hasItems())
        <ul class="treeview-menu">
            @foreach($item->getItems() as $item)
                @include('sidebar::item')
            @endforeach
        </ul>
    @endif
</li>
