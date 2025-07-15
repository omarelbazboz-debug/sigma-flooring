@extends('layouts.admin')

@section('meta')
<title>{{trans('home.add_menu')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.menu_items')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/menu-items')}}">{{trans('home.menu_items')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_menu')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('home.add_menu')}}</h4>
                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('menu-items.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">{{trans('home.name_en')}}</label>
                                            <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">{{trans('home.name_ar')}}</label>
                                            <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label for="choices-single-default" class="form-label font-size-13 text-muted">{{trans('home.parent')}}</label>
                                            <select class="form-control" name="parent" data-trigger id="choices-single-default">
                                                <option value="0">{{trans('home.no_parent')}}</option>
                                                @foreach($menuParents as $menuParent)
                                                <option value="{{$menuParent->id}}">@if(app()->getLocale() == 'en')
                                                    {{ $menuParent->name_en}} @else {{ $menuParent->name_ar}} @endif
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="order">{{trans('home.order')}}</label>
                                        <input type="number" min="1" class="form-control" placeholder="{{trans('home.order')}}" name="order" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="menu" class="form-label font-size-13 text-muted">{{trans('home.menu')}}</label>
                                        <select class="form-control menu" data-trigger name="menu_id">
                                            @foreach($menus as $menu)
                                            <option value="{{$menu->id}}">{{(app()->getLocale() == 'en')?$menu->name_en:$menu->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="menu_type" class="form-label font-size-13 text-muted">{{trans('home.menu_type')}}</label>
                                        <select class="form-control menu_type" data-trigger name="menu_type" required>
                                            <option></option>
                                            <option value="main-item">{{trans('home.main-item')}}</option>
                                            <option value="home">{{trans('home.home')}}</option>
                                            <option value="about-us">{{trans('home.about-us')}}</option>
                                            <option value="contact-us">{{trans('home.contact-us')}}</option>
                                            <!--<option value="board-of-members">{{trans('home.boardofmembers')}}</option>-->
                                            <option value="category">{{trans('home.category')}}</option>
                                            <option value="categories">{{trans('home.categories')}}</option>
                                            <option value="projects">{{trans('home.projects')}}</option>
                                             <option value="products">{{trans('home.products')}}</option>
                                            <option value="project">{{trans('home.project')}}</option>
                                            <option value="services">{{trans('home.services')}}</option>
                                            <option value="service">{{trans('home.service')}}</option>
                                            <option value="galleryImages">{{trans('home.galleryImages')}}</option>
                                            <option value="galleryVideos">{{trans('home.galleryVideos')}}</option>
                                            <option value="brand">{{trans('home.brand')}}</option>
                                            <option value="brands">{{trans('home.brands')}}</option>
                                            <option value="pages">{{trans('home.pages')}}</option>
                                            <option value="blogs">{{trans('home.blogs')}}</option>
                                            <option value="blog-category">{{trans('home.blog-category')}}</option>
                                            <option value="blog-item">{{trans('home.blog-item')}}</option>
                                            <option value="careers">{{trans('home.careers')}}</option>
                                            <option value="training">{{trans('home.trainings')}}</option>
                                            <option value="link">{{trans('home.link')}}</option>
                                            <option value="teams">{{trans('home.teams') ?? 'Teams'}}</option>
                                            <option value="profile">{{trans('home.profile') ?? 'profile'}}</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="type_values">

                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="menu" class="form-label font-size-13 text-muted">{{trans('home.meta_keywords')}}</label>
                                        <textarea class="form-control " name="meta_keywords" placeholder="{{trans('home.meta_keywords')}}"></textarea>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="menu" class="form-label font-size-13 text-muted">{{trans('home.meta_description')}}</label>
                                        <textarea class="form-control " name="meta_description" placeholder="{{trans('home.meta_description')}}"></textarea>
                                    </div>

                                </div>



                                <div class="form-group">

                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="status" id="switch" switch="success" checked />
                                        <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/menu-items')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                                </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('script')
<script>
    $('.menu_type').on('change', function() {
        var type = $('.menu_type option:selected').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('menuTypeValue')}}",
            method: 'POST',
            data: {
                type: type
            },
            success: function(html) {
                console.log(html);
                $('.type_values').html(html.html);
            }
        });
    });
</script>
@endsection
