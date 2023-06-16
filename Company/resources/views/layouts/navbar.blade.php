<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow background-dark-blue color-white" data-scroll-to-active="true">
    <div class="main-menu-content" style="margin-top: 6rem !important;">
        <ul class="navigation navigation-main background-dark-blue" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ str_contains(\Request::route()->getName(), 'dashboard') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('dashboard')}}">
                    <span class="menu-title text-truncate" data-i18n="{{__('dashboard')}}">{{__('dashboard')}}</span>
                </a>
            </li>
            <li class="{{ str_contains(\Request::route()->getName(), 'reservation') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('reservation-list')}}">
                    <span class="menu-title text-truncate" data-i18n="{{__('reservation-list')}}">{{__('reservation-list')}}</span>
                </a>
            </li>
            <li class="{{ str_contains(\Request::route()->getName(), 'client') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('client-manage')}}">
                    <span class="menu-title text-truncate" data-i18n="{{__('client-manage')}}">{{__('client-manage')}}</span>
                </a>
            </li>
            <li class="{{ str_contains(\Request::route()->getName(), 'noti') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('noti-manage')}}">
                    <span class="menu-title text-truncate" data-i18n="{{__('noti-manage')}}">{{__('noti-manage')}}</span>
                </a>
            </li>
{{--            <li class="{{ str_contains(\Request::route()->getName(), 'shop') ? 'active' : '' }} nav-item">--}}
{{--                <a class="d-flex align-items-center" href="{{route('shop-manage')}}">--}}
{{--                    <span class="menu-title text-truncate" data-i18n="{{__('shop-manage')}}">{{__('shop-manage')}}</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="{{ str_contains(\Request::route()->getName(), 'menu') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('menu-manage')}}">
                    <span class="menu-title text-truncate" data-i18n="{{__('menu-manage')}}">{{__('menu-manage')}}</span>
                </a>
            </li>
            <li class="{{ str_contains(\Request::route()->getName(), 'my-page') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('my-page')}}">
                    <span class="menu-title text-truncate" data-i18n="{{__('my-page')}}">{{__('my-page')}}</span>
                </a>
            </li>
        </ul>
        <div style="position: absolute; bottom: 30px; left: 54px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    <i class="me-50" data-feather="power"></i> {{__('logout')}}</a>
            </form>
        </div>

    </div>
</div>
