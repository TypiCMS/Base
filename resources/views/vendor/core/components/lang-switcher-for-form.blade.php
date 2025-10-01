@props(['locales'])

@if (count($locales) > 1)
    <div class="btn-group btn-group-sm ms-auto">
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownLangSwitcher" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span id="active-locale">{{ config('typicms.content_locale') ? __('languages.' . config('typicms.content_locale')) : __('All languages') }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLangSwitcher">
            @foreach ($locales as $locale)
                <a class="dropdown-item btn-lang-js @if (!session('allLocalesInForm') && $locale === (string) config('typicms.content_locale')) active @endif" href="#" data-locale="{{ $locale }}">
                    @lang('languages.' . $locale)
                </a>
            @endforeach

            <div class="dropdown-divider"></div>
            <a class="dropdown-item btn-lang-js @if (session('allLocalesInForm')) active @endif" href="#" data-locale="all">
                @lang('All languages')
            </a>
        </div>
    </div>
@endif
