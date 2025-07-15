



<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header border-bottom">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <ul class="navbar-nav">
            @foreach ($menus as $menuIndex =>  $menu)
                @if ($menu->type == 'home')
                    <li class="nav-item">
                        <a class="nav-link  {{ Request::fullUrlIs($menu->link) ? 'active' : '' }}" href="{{Helper::AppUrl()}}">@lang('home.home')</a>
                    </li>
                @elseif($menu->type == 'products')
                    <li class="nav-item dropdown">
                        <div class="d-flex justify-content-between align-items-center w-100 nav-link" >
                            <a href="{{$menu->link}}">{{$menu->name}}</a>
                            <i class="fas fa-chevron-down transition-rotate" data-bs-toggle="collapse"  href="#productsCollapse{{$menuIndex}}"></i>
                        </div>
                        <div class="collapse" id="productsCollapse{{$menuIndex}}">
                            <ul class="nav flex-column ps-3">
                                @foreach ($menuServices as $menuServiceIndex => $menuService)
                                    @if ($menuService->hasChilds())
                                    <li class="nav-item dropdown">
                                            <div class="d-flex justify-content-between align-items-center w-100 nav-link">
                                                <a href="{{$menuService->link}}">{{$menuService->name}}</a>
                                                <i class="fas fa-chevron-right iconToggle" data-bs-toggle="collapse" href="#flooringCollapse{{$menuServiceIndex}}"></i>
                                            </div>
                                            <div class="collapse" id="flooringCollapse{{$menuServiceIndex}}">
                                                <ul class="nav flex-column ps-3">
                                                    @foreach ($menuService->childs as $menuProductChild )
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{$menuProductChild->link}}">{{$menuProductChild->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $menuService->link }}">{{ $menuService->name }}</a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $menu->link }}">{{ $menu->name }}</a>
                    </li>
                @endif
            @endforeach
            @if ($altLangLink)
                <li class="nav-item mt-3">
                    <a href="{{ $altLangLink }}" class="btn btn-dark ms-4">{{ trans('home.' . (app()->getLocale() === 'ar' ? 'en' : 'ar')) }}</a>
                </li>
            @endif
        </ul>
    </div>
</div>
