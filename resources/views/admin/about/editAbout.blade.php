@extends('layouts.admin')
@section('meta')
<title>{{ trans('home.edit_about') }}</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('home.about') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/about') }}">{{ trans('home.about') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('home.edit_about') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    @endif
    <!-- Row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('home.edit_slider') }}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('admin.about.update', $about->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title_en">{{ trans('home.title_en') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.title_en') }}" name="title_en"
                                            value="{{ $about->title_en }}">
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="title_ar">{{ trans('home.title_ar') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.title_ar') }}" name="title_ar"
                                            value="{{ $about->title_ar }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="title_en">{{ trans('home.title1_en') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.title1_en') }}" name="title1_en"
                                            value="{{ $about->title1_en }}">
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="title_ar">{{ trans('home.title1_ar') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.title1_ar') }}" name="title1_ar"
                                            value="{{ $about->title1_ar }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_img">{{ trans('home.alt_img') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.alt_img') }}" name="alt_img"
                                            value="{{ $about->alt_img }}">
                                    </div>
                                   
                                    <div class="form-group col-md-6 m-2">
                                        <img src="{{ $about->image}}"
                                            width="150">
                                    </div>
                                
                                    <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="img">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_img">{{ trans('home.alt_img') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.alt_img') }}" name="alt_img"
                                            value="{{ $about->alt_img }}">
                                    </div>
                                    @if ($about->img)
                                    <div class="form-group col-md-6 m-2">
                                        <img src="{{ $about->img}}" width="150">
                                    </div>
                                    @else
                                    <div class="form-group col-md-2 m-2 d-flex align-items-center">
                                        <img alt="Empty Image" width="150">
                                    </div>
                                    @endif

                                    <div class="col-md-6 mb-3">
                                        <label for="formFile"
                                            class="form-label">{{ trans('home.choose_image') . ' - ' . __('home.banner') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="banner">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_banner">{{ trans('home.alt_banner') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.alt_banner') }}" name="alt_banner"
                                            value="{{ $about->alt_banner }}">
                                    </div>
                                    @if ($about->banner)
                                    <div class="form-group col-md-2 m-2">
                                        <img src="{{ $about->banner}}"
                                            width="150">
                                    </div>
                                    @else
                                    <div class="form-group col-md-2 m-2 d-flex align-items-center">
                                        <img alt="Empty Image" width="150">
                                    </div>
                                    @endif
                                    <br>
                                    <div class="form-group col-md-6 ">
                                        <label for="text_en">{{ trans('home.hometext_en') }}</label>
                                        <textarea class="form-control ckeditor-classic" placeholder="{{ trans('home.shorttext_en') }}" name="text1_en">{!! $about->text1_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="text_ar">{{ trans('home.hometext_ar') }}</label>
                                        <textarea class="form-control ckeditor-classic" placeholder="{{ trans('home.shorttext_ar') }}" name="text1_ar">{!! $about->text1_ar !!}</textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group col-md-6 ">
                                        <label for="text_en">{{ trans('home.text_en') }}</label>
                                        <textarea class="form-control ckeditor-classic" placeholder="{{ trans('home.text_en') }}" name="text_en">{!! $about->text_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="text_ar">{{ trans('home.text_ar') }}</label>
                                        <textarea class="form-control ckeditor-classic" placeholder="{{ trans('home.text_ar') }}" name="text_ar">{!! $about->text_ar !!}</textarea>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{ trans('home.save') }}</button>
                                    <a href="{{ url('/admin') }}"><button type="button" class="btn btn-danger mr-1"><i
                                                class="icon-trash"></i> {{ trans('home.cancel') }}</button></a>
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