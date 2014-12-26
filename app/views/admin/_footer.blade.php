{{ HTML::script(asset('js/admin/components.min.js')) }}

@if(Config::get('typicms.adminLocale') != 'en')
    {{ HTML::script(asset('js/angular-locales/angular-locale_' . Config::get('typicms.adminLocale') . '-' . Config::get('typicms.adminLocale') . '.js')) }}
    {{ HTML::script(asset('js/pickadate-locales/' . Config::get('typicms.adminLocale') . '_' . strtoupper(Config::get('typicms.adminLocale')) . '.js')) }}
@endif

@yield('js')
