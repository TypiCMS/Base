        @if (count($locales) > 1)
        <ul class="nav nav-tabs">
            @foreach ($locales as $lang)
            <li class="@if ($locale == $lang)active @endif">
                <a href="#{{ $lang }}" data-target="#{{ $lang }}" data-toggle="tab">@lang('global.languages.'.$lang)</a>
            </li>
            @endforeach
        </ul>
        @endif
