<div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand " href="{{ Helper::AppUrl() }}">
        <img src="{{ Helper::AppLogo() }}" alt="Logo" class="logo rounded-1" width="150" />
    </a>
    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#mobileMenu" aria-controls="mobileMenu">
        <i class="fa-solid fa-bars fs-3 text-white"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-4">
            @foreach ($menus as $menu)
                @if ($menu->type == 'home')
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::fullUrlIs($menu->link) ? 'active' : '' }}"
                            aria-current="page" href="{{ Helper::AppUrl() }}">@lang('home.home')</a>
                    </li>
                @elseif ($menu->type == 'products')
                    <li class="nav-item position-relative dropdown has-submenu h-100">
                        <div class="d-flex justify-content-between w-100 h-100 align-items-center pb-2">
                            <a class="nav-link text-white {{ Request::fullUrlIs($menu->link) ? 'active' : '' }}"
                                href="{{ $menu->link }}">{{ $menu->name }}</a>
                            <div class="products-toggle">
                                <i class="fa-solid fa-chevron-down iconToggle"></i>
                            </div>
                        </div>
                        <ul class="dropdown-menu-list first-level position-absolute">
                            @foreach ($menuServices as $menuService)
                                @if ($menuService->hasChilds())
                                    <li class="dropdown-submenu">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a class="dropdown-item"
                                                href="{{ $menuService->link }}">{{ $menuService->name }}</a>
                                            <div class="submenu-toggle pe-3">
                                                <i class="fa-solid fa-chevron-right iconToggle text-black "></i>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu-list second-level ">
                                            @foreach ($menuService->childs as $menuProductChild)
                                                <li><a class="dropdown-item"
                                                        href="{{ $menuProductChild->link }}">{{ $menuProductChild->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li> <a class="dropdown-item"
                                            href="{{ $menuService->link }}">{{ $menuService->name }}</a> </li>
                                @endif
                            @endforeach

                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::fullUrlIs($menu->link) ? 'active' : '' }}"
                            href="{{ $menu->link }}">{{ $menu->name }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-4">
            @if ($altLangLink)
                <li class="nav-item">
                    <a class="btn btn-dark" href="{{ $altLangLink }}">
                        {{ trans('home.' . (app()->getLocale() === 'ar' ? 'en' : 'ar')) }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
