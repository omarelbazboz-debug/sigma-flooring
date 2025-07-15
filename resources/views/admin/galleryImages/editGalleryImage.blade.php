@extends('layouts.admin')
<title>{{ trans('home.edit_galleryImage') }}</title>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('home.edit_galleryImage') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ url('/admin/gallery-images') }}">{{ trans('home.galleryImages') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('home.edit_galleryImage') }}</li>
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
                    <form method="POST" action="{{ url('admin/gallery-images/' . $galleryImage->id) }}" enctype="multipart/form-data" data-toggle="validator">
                        @method('PATCH')
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="">{{ trans('home.image') }}</label>
                                <input class="form-control" name="img" type="file">
                            </div>

                            <div class="col-md-3 mb-3">
                                <fieldset class="form-group">
                                    <label for="order">{{ trans('home.order') }}</label>
                                    <input type="number" min="1" class="form-control"
                                        placeholder="{{ trans('home.order') }}" name="order"
                                        value="{{ $galleryImage->order }}">
                                </fieldset>
                            </div>
                            @if ($galleryImage->img)
                            <div class=" col-md-2 m-2 mt-3">
                                <img src="{{ $galleryImage->img }}"
                                    width="200" height="150">
                            </div>
                            @else
                            <div class=" col-md-3 mt-3">
                                <img src="{{ asset('assets/back/images/noimage.jpg') }}" width="70">
                            </div>
                            @endif


                            <div class="col-md-6 mb-3">
                                <label for="text_en">{{ trans('home.text_en') }}</label>
                                <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{ trans('home.text_en') }}"
                                    maxlength="50">{{ $galleryImage->text_en }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="text_ar">{{ trans('home.text_ar') }}</label>
                                <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{ trans('home.text_ar') }}"
                                    maxlength="50">{{ $galleryImage->text_ar }}</textarea>
                            </div>

                        </div>
                        <div class="form-group col-3">

                            <div class="form-check d-flex">
                                <input type="checkbox" value="1" name="status" id="switch" switch="success"
                                    {{ $galleryImage->status == 1 ? 'checked' : '' }} />
                                <label for="switch" data-on-label="{{ trans('home.yes') }}"
                                    data-off-label="{{ trans('home.no') }}"></label>
                                <label class="form-check-label mx-3" for="switch"> {{ trans('home.publish') }}</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary w-md"><i class="image-note"></i>
                                {{ trans('home.save') }} </button>
                            <a href="{{ url('/admin/gallery-images') }}"><button type="button"
                                    class="btn btn-danger mr-1"><i class="image-trash"></i>
                                    {{ trans('home.cancel') }}</button></a>
                        </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>
@endsection