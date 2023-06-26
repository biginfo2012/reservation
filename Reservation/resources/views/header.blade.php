<nav
    class="header-navbar navbar navbar-expand-lg align-items-center  navbar-light navbar-shadow container-xxl custom-header background-dark-blue color-white">
    @if(!empty($shop_setting) && !empty($shop_setting->image_url))
        <img src="{{asset('image') . '/' . $shop_setting->image_url}}" class="position-absolute" style="width: 100%; height: 250px;">
    @endif
    <div class="navbar-container d-flex content pb-0">
        <div class="bookmark-wrapper align-items-end col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto mb-0 mt-auto">
            <p class="color-white font-medium-4 mb-0">{{__('manager-sub-title')}}</p>
            <p class="color-white mb-0">{{$shop->address}} {{ $shop->shop_name }}</p>
            <p class="color-white mb-0">{{ $shop->phone }}</p>
        </div>
    </div>
</nav>
