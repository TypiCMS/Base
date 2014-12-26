<div class="col-xs-6 col-sm-3 col-md-2 sidebar sidebar-offcanvas" id="sidebar" role="navigation">
    @foreach ($menus as $section => $items)
    @if ($items->count())
    <div class="sidebar-panel">
        @if ($section)
        <a class="sidebar-title @if(Config::get('current_user.menus_'.$section.'_collapsed'))collapsed @endif" href="#{{ $section }}" data-toggle="collapse">
            <div> @lang('global.menus.' . $section)</div>
        </a>
        @endif
        <div class="panel-collapse collapse @if(! Config::get('current_user.menus_'.$section.'_collapsed'))in @endif" id="{{ $section }}">
            <ul class="nav nav-sidebar">
                @foreach ($items->sortBy('weight') as $name => $item)
                <li class="{{ Request::is($item['request']) ? 'active' : ''}}">
                    <a href="{{ URL::route($item['route']) }}">
                        <span class="{{ $item['icon-class'] }}"></span>
                        <div> {{ \Patchwork\Utf8::ucfirst(trans($name . '::global.name')) }}</div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @endforeach
</div>
