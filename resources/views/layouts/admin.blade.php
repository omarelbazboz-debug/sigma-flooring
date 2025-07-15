<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $lang == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('uploads/settings/source/' . $configration->fav_icon) }}" type="image/x-icon" />

    <!-- Title -->
    <title>{{ $configration->app_name }} - {{ trans('home.admin_panel') }}</title>


    <link
        href="{{ asset('public/assets/back/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('public/assets/back/css/preloader.min.css') }}" type="text/css" />
    <!-- dropzone css -->
    <link href="{{ asset('public/assets/back/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- choices css -->
    <link rel="stylesheet"
        href="{{ asset('public/assets/back/libs/choices.js/public/assets/styles/choices.min.css') }}"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/back/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    @if ($lang == 'ar')
        <link href="{{ asset('public/assets/back/css/css/bootstrap-rtl.min.css') }}" id="bootstrap-style"
            rel="stylesheet" type="text/css" />
    @endif
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/back/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/back/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />
    @if ($lang == 'ar')
        <link href="{{ asset('public/assets/back/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet"
            type="text/css" />
    @endif
    <link href="{{ asset('public/assets/back/libs/admin-resources/rwd-table/rwd-table.min.css') }}"
        rel="stylesheet" type="text/css" />


    <!-- Responsive datatable examples -->
    <link
        href="{{ asset('public/assets/back/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />


    @yield('style')
</head>

<body @if (auth()->user()->theme == 'dark') cz-shortcut-listen="true" data-layout-mode="dark" @endif
    @if (auth()->user()->topbar) data-topbar="dark" @endif data-sidebar="{{ auth()->user()->side_bar }}">

    <!-- Page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ LaravelLocalization::localizeUrl('admin') }}" class="logo logo-dark">

                            <span class="logo-sm">
                                <img src="{{ asset('uploads/settings/source/' . $configration->app_logo) }}"
                                    alt="logo" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('uploads/settings/source/' . $configration->app_logo) }}"
                                    alt="logo" height="24"><span class="logo-txt">
                                    {{ auth()->user()->name() }}
                                </span>
                            </span>
                        </a>

                        <a href="{{ LaravelLocalization::localizeUrl('admin') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('uploads/settings/source/' . $configration->app_logo) }}"
                                    alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('uploads/settings/source/' . $configration->app_logo) }}"
                                    alt="" height="24"> <span class="logo-txt">
                                    {{ auth()->user()->name() }}</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img id="header-lang-img"
                                src="{{ url($lang == 'ar' ? 'resources/public/assets/back/images/flags/eg.png' : 'resources/public/assets/back/images/flags/us.jpg') }}"
                                alt="{{ $lang }}" height="16">
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}"
                                class="dropdown-item notify-item language" data-lang="en">
                                <img src="{{ asset('public/assets/back/images/flags/us.jpg') }}" alt="English"
                                    class="me-1" height="12"> <span class="align-middle">English</span>
                            </a>
                            <!-- item-->
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}"
                                class="dropdown-item notify-item language" data-lang="ar">
                                <img src="{{ asset('public/assets/back/images/flags/eg.png') }}" alt="Arabic"
                                    class="me-1" height="12">
                                <span class="align-middle">Arabic</span>
                            </a>

                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item " id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item right-bar-toggle me-2">
                            <i data-feather="settings" class="icon-lg"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            @if (auth()->user()->image)
                                <img class="rounded-circle header-profile-user" alt="{{ auth()->user()->name() }}"
                                    src="{{ URL::to('uploads/users/source') }}/{{ Auth::user()->image }}">
                            @else
                                <img class="rounded-circle header-profile-user"alt="avatar"
                                    src="{{ asset('public/assets/back/images/users/avatar-1.jpg') }}">
                            @endif
                            <span class="d-none d-xl-inline-block ms-1 fw-medium"> {{ auth()->user()->name() }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ url('user/account-settings') }}"><i
                                    class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                                {{ trans('home.edit_profile') }}</a>
                            <a class="dropdown-item" href="{{ url('admin/settings') }}"><i
                                    class="mdi mdi-lock font-size-16 align-middle me-1"></i>
                                {{ trans('home.settings') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                                {{ trans('home.log_out') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li>
                            <a href="{{ url('/') }}" target="_blank">
                                <i class="bx bx-mobile-landscape"></i>
                                <span data-key="t-dashboard">{{ trans('home.website') }}</span>
                            </a>
                        </li>
                        <li class="@if (Request::segment(3) == '') mm-active @endif">
                            <a href="{{ url('admin') }}">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">{{ trans('home.dashboard') }}</span>
                            </a>
                        </li>
                        <li class="@if (Request::segment(3) == '') mm-active @endif">
                            <a href="{{ url('scan') }}" target="_blank">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">{{ trans('home.scan') }}</span>
                            </a>
                        </li>
                        @can('contactUs')
                            <li class="@if (Request::segment(3) == 'contact-us-messages') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/contact-us-messages') }}">
                                    <i class="bx bx-message-alt-dots"></i>
                                    <span data-key="t-dashboard">{{ trans('home.contactUsMessages') }}</span>
                                    @if (\App\Models\ContactUs::messageCount() > 0)
                                        <span
                                            class="badge rounded-pill bg-soft-danger text-danger float-end">{{ \App\Models\ContactUs::messageCount() }}</span>
                                    @endif
                                </a>
                            </li>
                        @endcan
                        <li class="@if (Request::segment(3) == 'contact-us-messages') mm-active @endif">
                            <a href="{{ LaravelLocalization::localizeUrl('admin/careers-applications') }}">
                                <i class="bx bx-message-alt-dots"></i>
                                <span data-key="t-dashboard">{{ trans('home.careerApplications') }}</span>

                            </a>
                        </li>
                        <li class="menu-title" data-key="t-menu">{{ trans('home.website') }}</li>


                        <li class="@if (Request::segment(3) == 'menus' || Request::segment(3) == 'menu-items') mm-active @endif">
                            <a href="javascript: void(0);" class="has-arrow">
                                <span><i class="dripicons-align-center"></i>{{ trans('home.menus') }}</span>
                            </a>
                            <ul class="sub-menu @if (Request::segment(3) == 'menus' || Request::segment(3) == 'menu-items') mm-collapse mm-show @endif"
                                aria-expanded="false">
                                @can(['menu', 'menuItem'])
                                    <li>
                                        <a class="@if (Request::segment(3) == 'menus') active @endif"
                                            href="{{ url('admin/menus') }}">
                                            <span> {{ trans('home.menus') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="@if (Request::segment(3) == 'menu-items') active @endif"
                                            href="{{ url('admin/menu-items') }}">
                                            <span>{{ trans('home.menu_items') }}</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>

                        <li class="@if (Request::segment(3) == 'intro-sliders' ||
                                Request::segment(3) == 'offers-sliders' ||
                                Request::segment(3) == 'home-sliders') mm-active @endif">
                            <a href="javascript: void(0);" class="has-arrow">
                                <span><i class="mdi mdi-camera-image"></i>{{ trans('home.sliders') }}</span>
                            </a>
                            <ul class="sub-menu @if (Request::segment(3) == 'intro-sliders' ||
                                    Request::segment(3) == 'offers-sliders' ||
                                    Request::segment(3) == 'home-sliders') mm-collapse mm-show @endif"
                                aria-expanded="false">
                                @can('introSlider')
                                    <li>
                                        <a class="@if (Request::segment(3) == 'intro-sliders') active @endif"
                                            href="{{ url('admin/intro-sliders') }}">
                                            <span> {{ trans('home.intro_sliders') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('offersSlider')
                                    <li>
                                        <a class="@if (Request::segment(3) == 'offers-sliders') active @endif"
                                            href="{{ url('admin/offers-sliders') }}">
                                            <span> {{ trans('home.offers_sliders') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('homeSlider')
                                    <li>
                                        <a class="@if (Request::segment(3) == 'home-sliders') active @endif"
                                            href="{{ url('admin/home-sliders') }}">
                                            <span> {{ trans('home.home_sliders') }}</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>

                        @can(['about', 'aboutStruc'])
                            <li class="@if (Request::segment(3) == 'editAbout' || Request::segment(3) == 'aboutStrucs') mm-active @endif">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="bx bx-info-circle"></i>
                                    <span data-key="t-pages">{{ __('home.about') }}</span>
                                </a>
                                <ul class="sub-menu @if (Request::segment(3) == 'editAbout' || Request::segment(3) == 'aboutStrucs' || Request::segment(3) == 'careers') mm-collapse mm-show @endif"
                                    aria-expanded="false">
                                    <li class="@if (Request::segment(3) == 'editAbout') active @endif">
                                        <a class="@if (Request::segment(3) == 'editAbout') active @endif"
                                            href="{{ LaravelLocalization::localizeUrl('admin/editAbout') }}">{{ trans('home.editAbout') }}</a>
                                    </li>

                                    <li class="@if (Request::segment(3) == 'aboutStrucs') active @endif">
                                        <a class="@if (Request::segment(3) == 'aboutStrucs') active @endif "
                                            href="{{ LaravelLocalization::localizeUrl('admin/aboutStrucs') }}">{{ trans('home.aboutStrucs') }}</a>
                                    </li>
                                    @can('statements')
                                        <li class="@if (Request::segment(3) == 'careers') active @endif">
                                            <a class="@if (Request::segment(3) == 'careers') active @endif"
                                                href="{{ LaravelLocalization::localizeUrl('admin/careers') }}">{{ trans('home.head_headers') }}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                            <li class=" @if (Request::segment(3) == 'phones') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/phones') }}"><i
                                        class="fas fa-phone"></i><span
                                        class="sidemenu-label">{{ trans('home.number_phones') }}</span></a>
                            </li>

                        @can('address')
                        <li class="@if (Request::segment(3) == 'addresses') active show @endif">
                            <a href="{{ LaravelLocalization::localizeUrl('admin/addresses') }}"><i
                                    class="fas fa-map-pin"></i><span
                                    class="sidemenu-label">{{ trans('home.addresses') }}</span></a>
                        </li>
                    @endcan
                        @can('progress')
                            <li class=" @if (Request::segment(3) == 'progresses') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/progresses') }}"><i
                                        class="fa fa-spinner"></i><span
                                        class="sidemenu-label">{{ trans('home.number_progresses') }}</span></a>
                            </li>
                        @endcan
                        @can(['blogCategory', 'blogItem'])
                            <li class="@if (Request::segment(3) == 'blog-categories' || Request::segment(3) == 'blog-items') mm-active @endif">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="bx bx-book-open"></i>
                                    <span data-key="t-pages">{{ __('home.blogs') }}</span>
                                </a>
                                <ul class="sub-menu @if (Request::segment(3) == 'blog-categories' || Request::segment(3) == 'blog-items') mm-collapse mm-show @endif"
                                    aria-expanded="false">
                                    <li class="@if (Request::segment(3) == 'blog-categories') active @endif">
                                        <a class="@if (Request::segment(3) == 'blog-categories') active @endif"
                                            href="{{ LaravelLocalization::localizeUrl('admin/blog-categories') }}">
                                            {{ trans('home.blogcategory') }}</a>
                                    </li>
                                    <li class=" @if (Request::segment(3) == 'blog-items') active @endif">
                                        <a class="@if (Request::segment(3) == 'blog-items') active @endif"
                                            href="{{ LaravelLocalization::localizeUrl('admin/blog-items') }}">{{ trans('home.blogitem') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan


                        @can('title')
                            <li class=" @if (Request::segment(3) == 'titles') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/titles') }}"><i
                                        class="fa fa-edit"></i><span
                                        class="sidemenu-label">{{ trans('home.edit_sectiontitle') }}</span></a>
                            </li>
                        @endcan
                        @can('date')
                            <li class=" @if (Request::segment(3) == 'dates') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/dates') }}"><i
                                        class="fas fa-clock"></i><span
                                        class="sidemenu-label">{{ trans('home.dates') }}</span></a>
                            </li>
                        @endcan
                        @can('albums')
                        <li class=" @if (Request::segment(3) == 'albums') mm-active @endif">
                            <a href="{{ LaravelLocalization::localizeUrl('admin/albums') }}"><i
                                    class="bx bx-photo-album"></i><span
                                    class="sidemenu-label">{{ trans('home.products') }}</span></a>
                        </li>
                        @endcan
                        @can('galleryImage')
                            <li class="@if (Request::segment(3) == 'gallery-images') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/gallery-images') }}"><i
                                        class="bx bxs-image-add"></i><span
                                        class="sidemenu-label">{{ trans('home.galleryImages') }}</span></a>
                            </li>
                        @endcan
                        @can('beforeAfter')
                            <li class="@if (Request::segment(3) == 'beforeAfters') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/beforeAfters') }}"><i
                                        class="bx bxs-image-add"></i><span
                                        class="sidemenu-label">{{ trans('home.beforeAfters') }}</span></a>
                            </li>
                        @endcan
                        @can('home-images')
                            <li class="nav-item @if (Request::segment(3) == 'home-images') active show @endif">
                                <a class="nav-link" href="{{ url('admin/home-images') }}"><i
                                        class="fe fe-camera"></i><span
                                        class="sidemenu-label">{{ trans('home.homeImages') }}</span></a>
                            </li>
                        @endcan
                        @can('galleryVideo')
                            <li class="@if (Request::segment(3) == 'gallery-videos') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/gallery-videos') }}"><i
                                        class="fab fa-youtube"></i><span
                                        class="sidemenu-label">{{ trans('home.galleryVideos') }}</span></a>
                            </li>
                        @endcan
                        @can('faq')
                            <li class="@if (Request::segment(3) == 'editFaq') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/editFaq') }}"><i
                                        class="fas fa-question"></i><span
                                        class="sidemenu-label">{{ trans('home.faq') }}</span></a>
                            </li>
                        @endcan
                        @can('pages')
                            <li class="@if (Request::segment(3) == 'pages') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/pages') }}"><i
                                        class="fas fa-file"></i><span
                                        class="sidemenu-label">{{ trans('home.pages') }}</span></a>
                            </li>
                        @endcan
                        @can('news-letters')
                            <li class="@if (Request::segment(3) == 'news-letters') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/news-letters') }}"><i
                                        class="far fa-newspaper"></i><span
                                        class="sidemenu-label">{{ trans('home.newsLetters') }}</span></a>
                            </li>
                        @endcan
                        @can('testimonial')
                            <li class="@if (Request::segment(3) == 'testimonials') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/testimonials') }}"><i
                                        class="fa fa-quote-left"></i><span
                                        class="sidemenu-label">{{ trans('home.testimonials') }}</span></a>
                            </li>
                        @endcan
                        @can('team')
                            <li class="@if (Request::segment(3) == 'teams') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/teams') }}"><i
                                        class="fas fa-user"></i><span
                                        class="sidemenu-label">{{ trans('home.Awards') }}</span></a>
                            </li>
                        @endcan
                        @can('writers')
                            <li class="@if (Request::segment(3) == 'writers') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/writers') }}"><i
                                        class="fas fa-pen"></i><span
                                        class="sidemenu-label">{{ trans('home.writers') }}</span></a>
                            </li>
                        @endcan
                        @can('companies')
                            <li class="@if (Request::segment(3) == 'brands') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/brands') }}"><i
                                        class="mdi mdi-face-mask-outline"></i><span
                                        class="sidemenu-label">{{ trans('home.clients') }}</span></a>
                            </li>
                        @endcan
                        @can('partner')
                            <li class="@if (Request::segment(3) == 'partners') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/partners') }}"><i
                                        class="mdi mdi-face-mask-outline"></i><span
                                        class="sidemenu-label">{{ trans('home.Our partners') }}</span></a>
                            </li>
                        @endcan

                        @can('categories')
                            <li class="@if (Request::segment(3) == 'categories' || Request::segment(3) == 'attributes') mm-active @endif">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="bx bx-git-branch "></i>
                                    <span data-key="t-pages">{{ __('home.categories') }}</span>
                                </a>

                                <ul class="sub-menu @if (Request::segment(3) == 'categories' || Request::segment(3) == 'attributes') mm-collapse mm-show @endif"
                                    aria-expanded="false">
                                    @can('categories')
                                        <li class="@if (Request::segment(3) == 'categories') active @endif">
                                            <a class="@if (Request::segment(3) == 'categories') active @endif"
                                                href="{{ LaravelLocalization::localizeUrl('admin/categories') }}">
                                                {{ trans('home.categories') }}</a>
                                        </li>
                                    @endcan
                                    @can('attributes')
                                        <li class=" @if (Request::segment(3) == 'attributes') active @endif">
                                            <a class="@if (Request::segment(3) == 'attributes') active @endif"
                                                href="{{ LaravelLocalization::localizeUrl('admin/attributes') }}">{{ trans('home.attributes') }}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        @can('projects')
                            <li class=" @if (Request::segment(3) == 'projects') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/projects') }}"><i
                                        class="fas fa-building"></i><span
                                        class="sidemenu-label">{{ trans('home.projects') }}</span></a>
                            </li>
                        @endcan
                          <li class=" @if (Request::segment(3) == 'features') mm-active @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/features') }}"><i
                                        class="fas fa-building"></i><span
                                        class="sidemenu-label">{{ trans('home.features') }}</span></a>
                            </li>
                        @can('service')
                        <li class=" @if (Request::segment(3) == 'services') mm-active @endif">
                            <a href="{{ LaravelLocalization::localizeUrl('admin/services') }}"><i
                                    class="fas fa-wrench"></i><span
                                    class="sidemenu-label">{{ trans('home.services') }}</span></a>
                        </li>
                    @endcan
                        <li class="menu-title mt-2" data-key="t-components">{{ __('home.settings') }}</li>
                        @can('setting')
                            @can('users')
                                <li class="@if (Request::segment(3) == 'users' || Request::segment(3) == 'roles' || Request::segment(3) == 'permissions') mm-active @endif">
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <i class="bx bx-face"></i>
                                        <span data-key="t-pages">{{ __('home.users') }}</span>
                                    </a>

                                    <ul class="sub-menu @if (Request::segment(3) == 'users' || Request::segment(3) == 'roles') mm-collapse mm-show @endif"
                                        aria-expanded="false">
                                        @can('users')
                                            <li class="@if (Request::segment(3) == 'users') active @endif">
                                                <a class="@if (Request::segment(3) == 'users') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/users') }}">
                                                    {{ trans('home.users') }}</a>
                                            </li>
                                        @endcan
                                        @can('role')
                                            <li class=" @if (Request::segment(3) == 'roles') active @endif">
                                                <a class="@if (Request::segment(3) == 'roles') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/roles') }}">{{ trans('home.roles') }}</a>
                                            </li>
                                        @endcan
                                        @can('permission')
                                            <li class=" @if (Request::segment(3) == 'permissions') active @endif">
                                                <a class="@if (Request::segment(3) == 'permissions') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/permissions') }}">{{ trans('home.permissions') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('countries')
                                <li class="@if (Request::segment(3) == 'countries' || Request::segment(3) == 'regions' || Request::segment(3) == 'areas') mm-active @endif">
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <i class="mdi mdi-earth"></i>
                                        <span data-key="t-pages">{{ __('home.countries') }}</span>
                                    </a>

                                    <ul class="sub-menu @if (Request::segment(3) == 'countries' || Request::segment(3) == 'regions') mm-collapse mm-show @endif"
                                        aria-expanded="false">
                                        @can('countries')
                                            <li class="@if (Request::segment(3) == 'countries') active @endif">
                                                <a class="@if (Request::segment(3) == 'countries') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/countries') }}">
                                                    {{ trans('home.countries') }}</a>
                                            </li>
                                        @endcan
                                        @can('role')
                                            <li class=" @if (Request::segment(3) == 'regions') active @endif">
                                                <a class="@if (Request::segment(3) == 'regions') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/regions') }}">{{ trans('home.regions') }}</a>
                                            </li>
                                        @endcan
                                        @can('permission')
                                            <li class=" @if (Request::segment(3) == 'areas') active @endif">
                                                <a class="@if (Request::segment(3) == 'areas') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/areas') }}">{{ trans('home.areas') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('setting')
                                <li class="@if (Request::segment(3) == 'settings' || Request::segment(4) == 'en' || Request::segment(4) == 'ar') mm-active @endif">
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <i class="mdi mdi-table-settings"></i>
                                        <span data-key="t-pages">{{ __('home.settings') }}</span>
                                    </a>

                                    <ul class="sub-menu @if (Request::segment(3) == 'settings' || Request::segment(3) == 'en') mm-collapse mm-show @endif"
                                        aria-expanded="false">
                                        <li class="@if (Request::segment(3) == 'settings') active @endif">
                                            <a class="@if (Request::segment(3) == 'settings') active @endif"
                                                href="{{ LaravelLocalization::localizeUrl('admin/settings') }}">
                                                {{ trans('home.settings') }}</a>
                                        </li>
                                        @can('configration')
                                            <li class=" @if (Request::segment(4) == 'en') active @endif">
                                                <a class="@if (Request::segment(4) == 'en') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/configrations/en') }}">{{ trans('home.configrations') }}
                                                    {{ trans('home.en') }}</a>
                                            </li>
                                            <li class=" @if (Request::segment(4) == 'ar') active @endif">
                                                <a class="@if (Request::segment(4) == 'ar') active @endif"
                                                    href="{{ LaravelLocalization::localizeUrl('admin/configrations/ar') }}">{{ trans('home.configrations') }}
                                                    {{ trans('home.ar') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        @endcan



                        @can('seo')
                            <li class="@if (Request::segment(3) == 'seo-assistant') active show @endif">
                                <a href="{{ LaravelLocalization::localizeUrl('admin/seo-assistant') }}"><i
                                        class="fas fa-search"></i><span
                                        class="sidemenu-label">{{ trans('home.seo_assistant') }}</span></a>
                            </li>
                        @endcan
                    </ul>

                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <div class="main-content">
            <div class="page-content">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©
                            <a href="{{ LaravelLocalization::localizeUrl('https://be-group.com/') }}"
                                target="_blank" class="text-decoration-underline">
                                {{ trans('home.be-group') }}.
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <span>{{ trans('home.All Rights Reserved') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- End Page -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="m-0" />

            <div class="p-4">
                <div class="form-check form-check-inline d-none">
                    <input id="layout-vertical" value="vertical">
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input mode-setting-btn" type="radio" name="layout-mode"
                        id="layout-mode-light" value="light">
                    <label class="form-check-label" for="layout-mode-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input mode-setting-btn" type="radio" name="layout-mode"
                        id="layout-mode-dark" value="dark">
                    <label class="form-check-label" for="layout-mode-dark">Dark</label>
                </div>


                <input class="d-none" id="layout-width-fuild">

                <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed"
                        value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                    <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position"
                        id="layout-position-scrollable" value="scrollable"
                        onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                    <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input mode-setting-btn-topbar" type="radio" name="topbar-color"
                        id="topbar-color-light" value="light"
                        onchange="document.body.setAttribute('data-topbar', 'light')">
                    <label class="form-check-label" for="topbar-color-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input mode-setting-btn-topbar" type="radio" name="topbar-color"
                        id="topbar-color-dark" value="dark"
                        onchange="document.body.setAttribute('data-topbar', 'dark')">
                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                </div>
                <div class="d-none">
                    <input id="sidebar-size-default">
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input mode-setting-btn-sidebar" data-sidebar="light" type="radio"
                        name="sidebar-color" id="sidebar-color-light" value="light"
                        onchange="document.body.setAttribute('data-sidebar', 'light')">
                    <label class="form-check-label" data-sidebar="light" for="sidebar-color-light">Light</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input mode-setting-btn-sidebar" data-sidebar="dark" type="radio"
                        name="sidebar-color" id="sidebar-color-dark" value="dark"
                        onchange="document.body.setAttribute('data-sidebar', 'dark')">
                    <label class="form-check-label" data-sidebar="dark" for="sidebar-color-dark">Dark</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input mode-setting-btn-sidebar" data-sidebar="brand" type="radio"
                        name="sidebar-color" id="sidebar-color-brand" value="brand"
                        onchange="document.body.setAttribute('data-sidebar', 'brand')">
                    <label class="form-check-label" data-sidebar="brand" for="sidebar-color-brand">Brand</label>
                </div>

                <div class="d-none">
                    <input id="layout-direction-ltr">
                </div>

            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('public/assets/back/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- choices js -->
    <script src="{{ asset('public/assets/back/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/js/pages/form-advanced.init.js') }}"></script>

    <script src="{{ asset('public/assets/back/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('public/assets/back/libs/pace-js/pace.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('public/assets/back/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Plugins js-->
    <script
        src="{{ asset('public/assets/back/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('public/assets/back/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>
    <script src="{{ asset('public/assets/back/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/js/pages/table-responsive.init.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ asset('public/assets/back/js/pages/dashboard.init.js') }}"></script>



    <!-- ckeditor -->
    <script src="{{ asset('public/assets/back/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}">
    </script>
    <script src="{{ asset('public/assets/back/js/pages/form-editor.init.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('public/assets/back/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script src="{{ asset('public/assets/back/js/app.js') }}"></script>
    <script src="{{ asset('public/assets/back/js/new-tinymce/tinymce.min.js') }}"></script>


    <!-- Required datatable js -->
    <script src="{{ asset('public/assets/back/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('public/assets/back/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('public/assets/back/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('public/assets/back/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('public/assets/back/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('public/assets/back/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>

    <!-- Datatable init js -->
    <script src="{{ asset('public/assets/back/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>

    <script src="{{ asset('public/assets/back/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/simplebar/simplebar.min.js') }}"></script>


    @yield('script')

    <script>
        document.querySelectorAll('.ckeditor-classic').forEach(textarea => {
             ClassicEditor.create(textarea)
                .then(editor => {
                editor.ui.view.editable.element.style.height = "200px";
            })
               .catch(error => {
                console.error(error);
               });
      });
        // ///////// HTML editor ////////////////
        // const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        // const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;


        ///////// HTML editor ////////////////
        const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
        tinymce.init({
            selector: 'textarea.ckeditor-classic',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: false,
            toolbar_sticky_offset: isSmallScreen ? 102 : 108,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });


        ///////// MAPS with lat and long//////
        var lat = $('#latitude').val();
        var long = $('#longitude').val();

        if (lat != '') {
            function initMap2() {
                var uluru = {
                    lat: Number(lat),
                    lng: Number(long)
                };
                var myOptions = {
                        zoom: 15,
                        center: new google.maps.LatLng(lat, long)
                    },
                    map = new google.maps.Map(document.getElementById('map-canvas'), myOptions),
                    marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                    }),
                    infowindow = new google.maps.InfoWindow;
                map.addListener('click', function(e) {
                    map.setCenter(e.latLng);
                    marker.setPosition(e.latLng);
                    infowindow.setContent("Latitude: " + e.latLng.lat() +
                        "<br>" + "Longitude: " + e.latLng.lng());
                    infowindow.open(map, marker);
                    var s = $('#latitude').val(e.latLng.lat());
                    var ss = $('#longitude').val(e.latLng.lng());
                });
            }
        } else {
            function initMap1() {
                var uluru = {
                    lat: 30.0096523304429,
                    lng: 31.22744746506214
                };
                var myOptions = {
                        zoom: 10,
                        center: new google.maps.LatLng(30.0096523304429, 31.22744746506214)
                    },
                    map = new google.maps.Map(document.getElementById('map-canvas'), myOptions),
                    marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                    }),
                    infowindow = new google.maps.InfoWindow;
                map.addListener('click', function(e) {
                    map.setCenter(e.latLng);
                    marker.setPosition(e.latLng);
                    infowindow.setContent("Latitude: " + e.latLng.lat() +
                        "<br>" + "Longitude: " + e.latLng.lng());
                    infowindow.open(map, marker);
                    var s = $('#latitude').val(e.latLng.lat());
                    var ss = $('#longitude').val(e.latLng.lng());
                });
            }
        }



        $("form").submit(function() {
            $('#loader').show();
        });


        $(document).ready(function() {
            $('#switch, #meta_robots').change(function() {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    $(this).attr('checked', 'checked');
                } else {
                    $(this).removeAttr('checked');
                }
            });
            new Choices(".choices-multiple-remove-button", {
                removeItemButton: !0,
            });
        });


        $("#checkAll").change(function() {
            $(".tableChecked").prop('checked', $(this).prop("checked"));
        });


        $(".checkAllcart").change(function() {
            $(".cart").prop('checked', $(this).prop("checked"));
        });


        //// btn_delete single ////
        $(document).on('click', '.btn_delete', function() {

            if (!confirm('Are you sure you want to delete the row(s)?')) {
        return false; // Stop the function if user clicks "Cancel"
    }
            var ids = new Set();
            <?php
            $last_word = Request::segment(3);
            Session::put('route', $last_word);
            ?>

            $('.tableChecked:checked').each(function() {
                ids.add(String($(this).val()));
            });
            ids.add(String($(this).data('id')));
            console.log(ids);
            var idArray = Array.from(ids);
            if (idArray[0] == 'undefined') {
                alert("Please select at least one checkbox");
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?php echo Session::get('route'); ?>/" + idArray,
                    type: 'DELETE',
                    data: {
                        id: idArray
                    },
                    success: function() {
                        $('#checkAll').prop('checked', false);
                        for (var i = 0; i < idArray.length; i++) {
                            var row = $('tr#' + idArray[i]);
                            row.css('background-color', '#ccc');
                            row.fadeOut('slow');
                            row.find('input.tableChecked').prop('checked', false);
                        }
                        $('#successmesg').text('Selected items were successfully deleted.');
                        $('#successmesg').css('color','red').fadeIn().delay(3000).fadeOut();
                    }
                });
            }

        });

        //// btn_delete group ////
        $(document).on('click', '#btn_delete', function() {
            if (!confirm('Are you sure you want to delete the row(s)?')) {
        return false; // Stop the function if user clicks "Cancel"
    }
            var id = [];
            <?php
            $last_word = Request::segment(3);
            Session::put('route', $last_word);
            ?>

            $('.tableChecked:checked').each(function(i) {
                id[i] = $(this).val();
            });
            if (id.length === 0) //tell you if the array is empty
            {
                alert("Please Select atleast one checkbox");
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?php echo Session::get('route'); ?>/" + id,
                    type: 'DELETE',
                    data: {
                        id: id
                    },
                    success: function() {
                        $('#checkAll').prop('checked', false);
                        for (var i = 0; i < id.length; i++) {
                            var row = $('tr#' + id[i]);
                            row.css('background-color', '#ccc');
                            row.fadeOut('slow');
                            row.find('input.tableChecked').prop('checked', false);
                        }
                        $('#successmesg').text('Selected items were successfully deleted.');
                        $('#successmesg').css('color','red').fadeIn().delay(3000).fadeOut();
                    }
                });
            }


        });

        //// btn_active ////
        $(document).on('click', '.btn_active', function() {
            var ids = new Set();
            <?php
            $last_word = Request::segment(3);
            Session::put('route', $last_word);
            ?>

            $('.tableChecked:checked').each(function() {
                ids.add(String($(this).val()));
            });
            ids.add(String($(this).data('id')));
            var idArray = Array.from(ids);
            var clickedId = String($(this).data('id'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo Session::get('route'); ?>/up/" + idArray,
                method: 'POST',
                data: {
                    id: idArray
                },
                success: function() {
                    $('#checkAll').prop('checked', false);
                    idArray.forEach(function(id) {
                        var row = $('tr#' + id);
                        row.find('input.tableChecked').prop('checked', false);
                    });
                    idArray = idArray.filter(id => id !== clickedId);
                    idArray.forEach(function(id) {
                        var $switch = $('#switch-' + id);
                        var isChecked = $switch.prop('checked');
                        $switch.prop('checked', !isChecked);
                    });


                }
            });
        });

        $(document).on('click', '#btn_back', function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "backup",
                method: 'GET',
                success: function() {

                }
            });

        });
    </script>
    <script>
        $("#mode-setting-btn").click(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "switch-theme",
                method: 'GET',
                success: function() {
                    // location.reload();
                }
            });
        });
        $(".mode-setting-btn").click(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "switch-theme",
                method: 'GET',
                success: function() {
                    // location.reload();
                }
            });
        });
        $(".mode-setting-btn-sidebar").click(function() {
            var sidebar = $(this).data('sidebar');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "switch-theme-sidebar/" + sidebar,
                method: 'GET',
                success: function() {
                    // location.reload();
                }
            });
        });
        $(".mode-setting-btn-topbar").click(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "switch-theme-topbar/",
                method: 'GET',
                success: function() {
                    // location.reload();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.delete_all_img').click(function() {
            var id = $(this).data('id');
            <?php
            $last_word = Request::segment(3);
            Session::put('route', $last_word);
            ?>
            var routeSegment = "admin/" + "<?php echo Request::segment(3); ?>"; // Assuming the segment containing "admin/projects"
            var route = "/" + routeSegment + "/deleteAllIMages";
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('home.yes') . ', ' . __('home.delete_all') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
