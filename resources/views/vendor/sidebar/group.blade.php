<li class="sidebar-panel sidebar-panel-{{ $group->id }}">
    @if($group->shouldShowHeading())
        <a class="sidebar-title @if(config('typicms.user.menus_'.$group->id.'_collapsed'))collapsed @endif" href="#{{ $group->id }}" data-toggle="collapse">
            <div>{{ $group->name }}</div>
        </a>
    @endif
    <ul class="nav-sidebar panel-collapse collapse @if(! Config::get('typicms.user.menus_'.$group->id.'_collapsed'))show @endif" id="{{ $group->id }}">
        @foreach($group->getItems() as $item)
            {!! $item->render() !!}
        @endforeach
    </ul>
</li>
