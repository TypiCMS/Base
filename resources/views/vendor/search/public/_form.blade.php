@if (Route::has($lang . '::search'))
    <form class="search-form" method="get" action="{{ route($lang . '::search') }}">
        <div class="input-group">
            <input class="search-input form-control" type="text" name="query" id="query" aria-label="@lang('Search')" placeholder="@lang('Search')" value="{{ request()->string('query') }}" />
            <button class="search-button btn btn-primary" type="submit">Search</button>
        </div>
    </form>
@endif
