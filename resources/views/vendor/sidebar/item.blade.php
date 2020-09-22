<li class="sidebar-item-{{ $item->id }} {{ $item->state }} @if($item->hasItems()) treeview @endif">
    <a href="{{ $item->route }}" @if($item->hasAppend())class="hasAppend"@endif>
        <span class="icon">
            {!! $item->icon ?? '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/></svg>' !!}
        </span>

        <div>{{ $item->name }}</div>

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
