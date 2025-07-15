@extends('layouts.admin')
<title>{{trans('home.edit_galleryVideo')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.edit_galleryVideo')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/gallery-videos')}}">{{trans('home.galleryVideos')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_galleryVideo')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">

                    <form method="POST" action="{{ url('admin/gallery-videos/' . $galleryVideo->id) }}" enctype="multipart/form-data" data-toggle="validator">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <fieldset class="form-group">
                                    <label for="title_en">{{trans('home.title_en')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" value="{{$galleryVideo->title_en}}" >
                                </fieldset>
                            </div>
                            <div class="col-md-6 mb-3">
                                <fieldset class="form-group">
                                    <label for="title_ar">{{trans('home.title_ar')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar" value="{{$galleryVideo->title_ar}}" >
                                </fieldset>
                            </div>
                            <div class="col-md-9 mb-3">
                                <fieldset class="form-group">
                                    <label for="youtube_link">{{trans('home.youtube_link')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.youtube_link')}}" name="youtube_link" value="{{$galleryVideo->youtube_link}}" required>
                                </fieldset>
                            </div>

                            <div class="col-md-3 mb-3">
                                <fieldset class="form-group">
                                    <label for="order">{{trans('home.order')}}</label>
                                    <input type="number" min="1" class="form-control" placeholder="{{trans('home.order')}}" name="order" value="{{$galleryVideo->order}}">
                                </fieldset>
                            </div>

                            @if($galleryVideo->youtube_link)
                            <div class=" col-md-12 m-2 mt-3">
                                <iframe width="986" height="350"
                                    src="{{$galleryVideo->youtube_link}}">
                                </iframe>
                            </div>
                            @else
                            <div class=" col-md-3 mt-3">
                                <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                            </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <label for="text_en">{{trans('home.text_en')}}</label>
                                <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}" maxlength="50">{{$galleryVideo->text_en}}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="text_ar">{{trans('home.text_ar')}}</label>
                                <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}" maxlength="50">{{$galleryVideo->text_ar}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3 mt-3">
                                <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>

                            <div class="col-md-2 mb-3 mt-3">
                                <label>{{trans('home.alt_img')}}</label>
                                <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}" value="{{$galleryVideo->alt_img}}" />
                            </div>

                            @if($galleryVideo->image)
                            <div class=" col-md-2 m-2 mt-3">
                                <img src="{{url('\uploads\galleryVideo\source')}}\{{$galleryVideo->image}}" width="200" height="150">
                            </div>
                            @else
                            <div class=" col-md-3 mt-3">
                                <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-3">

                            <div class="form-check d-flex">
                                <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($galleryVideo->status == 1)? 'checked':''}} />
                                <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
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
    <!-- End Row -->
</div>

@endsection