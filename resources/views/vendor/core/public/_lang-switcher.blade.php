@if (($enabledLocales = enabledLocales()) and count($enabledLocales) > 1)
    <nav class="lang-switcher dropdown">
        <button class="lang-switcher-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownLangSwitcher">
            {{ $lang }}
        </button>
        <ul class="lang-switcher-list dropdown-menu" aria-labelledby="dropdownLangSwitcher">
            @foreach ($enabledLocales as $locale)
                @if ($locale !== $lang)
                    <li>
                        @isset($page)
                            @if ($page->isPublished($locale))
                                <a class="lang-switcher-item dropdown-item" href="{{ isset($model) && $model->isPublished($locale) ? $model->url($locale) : $page->url($locale) }}">
                                    {{ $locale }}
                                </a>
                            @else
                                <a class="lang-switcher-item dropdown-item" href="{{ url('/' . $locale) }}">
                                    {{ $locale }}
                                </a>
                            @endif
                        @else
                            <a class="lang-switcher-item dropdown-item" href="{{ url('/' . $locale) }}">
                                {{ $locale }}
                            </a>
                        @endisset
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
@endif
