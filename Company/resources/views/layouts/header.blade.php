<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl custom-header background-dark-blue color-white">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon color-white" data-feather="menu"></i></a></li>
            </ul>
            <a class="color-white font-medium-4" href="/dashboard">{{__('manager-sub-title')}}</a>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item me-3">
                <p id="now_time" class="mb-0" style="margin-right: 15px;"></p>
            </li>
            <li class="nav-item d-lg-block me-3">
                <span class="user-name fw-bolder">ログイン名: {{Auth::user()->name}}</span>
            </li>
        </ul>
    </div>
</nav>
