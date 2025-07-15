@extends('layouts.admin')
<title>{{trans('home.add_galleryImage')}}</title>
@section('content')

<div class="container-fluid">
    <!-- Row-->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.galleryVideos')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/gallery-videos')}}">{{trans('home.galleryVideos')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_galleryImage')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- Row-->

    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                        <form method="POST" action="{{ route('gallery-videos.store') }}" enctype="multipart/form-data" data-toggle="validator">
                        @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <fieldset class="form-group">
                                            <label for="title_en">{{trans('home.title_en')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" >
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <fieldset class="form-group">
                                            <label for="title_ar">{{trans('home.title_ar')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar" >
                                        </fieldset>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <fieldset class="form-group">
                                            <label for="youtube_link">{{trans('home.youtube_link')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.youtube_link')}}" name="youtube_link" required>
                                        </fieldset>
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <fieldset class="form-group">
                                            <label for="order">{{trans('home.order')}}</label>
                                            <input type="number" min="1"  class="form-control" placeholder="{{trans('home.order')}}" name="order" required>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="text_en">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}" maxlength="50"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="text_ar">{{trans('home.text_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}" maxlength="50"></textarea>
                                    </div>
                                    <div class="col-md-8 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="form-group col-3">
                                        
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/gallery-videos')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
