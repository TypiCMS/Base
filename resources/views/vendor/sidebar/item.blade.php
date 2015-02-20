<li class="{{ $item->state }} @if($item->hasItems()) treeview @endif clearfix">
    <a href="{{ $item->route }}" @if($item->hasAppend())class="hasAppend"@endif>
        <i class="{{ $item->icon or 'fa fa-angle-double-right' }}"></i>
        <div>{{ $item->name }}</div>

        @if($item->hasBadge())
            @foreach($item->badges as $badge)
                {!! $badge->render() !!}
            @endforeach
        @endif

        @if($item->hasItems())<i class="{{ $item->toggleIcon or 'fa fa-angle-left' }} pull-right"></i>@endif
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
