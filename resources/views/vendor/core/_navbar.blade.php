@if ($navbar)
    <nav class="typicms-navbar navbar navbar-expand justify-content-between sticky-top">
        <div class="container-fluid">
            @if (Request::segment(1) === 'admin')
                <button class="btn btn-link d-lg-none px-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            @endif

            <a class="typicms-navbar-brand navbar-brand" href="{{ route('admin::dashboard') }}">
                {{ websiteTitle(config('typicms.navbar_locale')) }}
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @if (Request::segment(1) === 'admin')
                        <x-core::navbar-public-link :model="$model ?? null" />
                    @else
                        <x-core::navbar-admin-link :model="$model ?? null" />
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="icon-circle-user-round me-1"></span>
                        <span class="d-none d-lg-inline">
                            {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">{{ auth()->user()->email }}</h6></li>
                        @can('update users')
                        <li>
                            <a class="dropdown-item" href="{{ route('admin::edit-user', Auth::id()) }}">
                                {{ __('Profile', [], config('typicms.navbar_locale')) }}
                            </a>
                        </li>
                        @endcan
                        <li>
                            <form action="{{ route(mainLocale() . '::logout') }}" method="post">
                                {{ csrf_field() }}
                                <button class="dropdown-item" type="submit">
                                    @lang('Logout', [], config('typicms.navbar_locale'))
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @can('read settings')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin::index-settings') }}">
                            <span class="icon-settings me-1"></span>
                            <span class="d-none d-lg-inline">
                                {{ __('Settings', [], config('typicms.navbar_locale')) }}
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </nav>
@endif
