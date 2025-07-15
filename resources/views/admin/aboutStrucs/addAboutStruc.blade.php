@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_aboutStruc')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.aboutStrucs')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/aboutStrucs')}}">{{trans('home.aboutStrucs')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_aboutStruc')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('home.add_aboutStruc')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('aboutStrucs.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <div class="row">

                                    <div class="col-md-5 mb-3">
                                        <label class="">{{trans('home.title_en')}}</label>
                                        <input class="form-control" name="title_en" type="text" placeholder="{{trans('home.title_en')}}" required>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label class="">{{trans('home.title_ar')}}</label>
                                        <input class="form-control" name="title_ar" type="text" placeholder="{{trans('home.title_ar')}}" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="">{{trans('home.order')}}</label>
                                        <input class="form-control" name="order" type="number" placeholder="{{trans('home.order')}}">
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>{{trans('home.alt_img')}}</label>
                                        <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{trans('home.text_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}"></textarea>
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
                                    <a href="{{url('/admin/aboutStrucs')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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