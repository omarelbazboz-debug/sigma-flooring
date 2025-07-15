@extends('layouts.admin')
@section('meta')
<title>{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ url('admin/configrations/' . $configrations->lang) }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @method('PATCH')


                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <label for="app_name">{{trans('home.app_name')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.app_name')}}" name="app_name" value="{{ $configrations->app_name }}">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <fieldset class="form-group">
                                            <label for="about_app">{{trans('home.about_app')}}</label>
                                            <textarea class="form-control ckeditor-classic" placeholder="{{trans('home.about_app')}}" name="about_app"> {!! $configrations->about_app !!}</textarea>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 mb-3 ">
                                        <label for="formFile" class="form-label">{{ trans('home.app_logo') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="app_logo">
                                    </div>
                                    <div class="col-md-3 mb-3 ">
                                        <label for="formFile" class="form-label">{{ trans('home.footer_logo') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="footer_logo">
                                    </div>

                                    <div class="col-md-3 mb-3 ">
                                        <label for="formFile" class="form-label">{{ trans('home.about_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="about_image">
                                    </div>
                                    <div class="col-md-3 mb-3 ">
                                        <label for="formFile" class="form-label">{{ trans('home.fav_icon') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="fav_icon">
                                    </div>

                                    <div class="form-group col-md-3">
                                        @if($configrations->app_logo)
                                        <img src="{{url('\uploads\settings\source')}}\{{$configrations->app_logo}}" width="200" height="150">
                                        @else
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        @if($configrations->footer_logo)
                                        <img src="{{url('\uploads\settings\source')}}\{{$configrations->footer_logo}}" width="200" height="150">
                                        @else
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        @if($configrations->about_image)
                                        <img src="{{url('\uploads\settings\source')}}\{{$configrations->about_image}}" width="200" height="150">
                                        @else
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        @if($configrations->fav_icon)
                                        <img src="{{url('\uploads\settings\source')}}\{{$configrations->fav_icon}}" width="200" height="150">
                                        @else
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <fieldset class="form-group">
                                            <label for="address1">{{trans('home.address1')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.address1')}}" name="address1" value="{{ $configrations->address1 }}">
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <fieldset class="form-group">
                                            <label for="address2">{{trans('home.address2')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.address2')}}" name="address2" value="{{ $configrations->address2 }}">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <fieldset class="form-group">
                                            <label for="time">{{trans('home.dates')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.dates')}}" name="time" value="{{ $configrations->time }}">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>

@endsection