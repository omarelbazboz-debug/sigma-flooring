@extends('layouts.admin')
@section('meta')
    <title>{{ trans('home.edit_head_headers') }}</title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ trans('home.head_headers') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/admin/titles') }}">{{ trans('home.head_headers') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('home.edit_head_headers') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('home.edit_head_headers') }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($errors->any())
                                    <script>
                                        let errorMessages = '';
                                        @foreach ($errors->all() as $error)
                                            errorMessages += '{{ $error }}\n';
                                        @endforeach
                                        alert(errorMessages);
                                    </script>
                                @endif
                                <form method="POST" action="{{ url('admin/titles/' . $title->id) }}"
                                    enctype="multipart/form-data" data-toggle="validator">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label class="">{{ trans('home.title_en') }}</label>
                                            <input class="form-control" name="title_en" type="text"
                                                placeholder="{{ trans('home.title_en') }}" value="{{ $title->title_en }}"
                                                required>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label class="">{{ trans('home.title_ar') }}</label>
                                            <input class="form-control" name="title_ar" type="text"
                                                placeholder="{{ trans('home.title_ar') }}" value="{{ $title->title_ar }}"
                                                required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="title_color">{{ trans('home.title_color') }}</label>
                                            <input type="color" class="form-control" name="title_color"
                                                value="{{ $title->title_color ?? '#000000' }}">
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label class="">{{ trans('home.title_en') }}</label>
                                            <input class="form-control" name="title1_en" type="text"
                                                placeholder="{{ trans('home.title_en') }}"
                                                value="{{ $title->title1_en }}">
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label class="">{{ trans('home.title_ar') }}</label>
                                            <input class="form-control" name="title1_ar" type="text"
                                                placeholder="{{ trans('home.title_ar') }}"
                                                value="{{ $title->title1_ar }}">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="title1_color">{{ trans('home.title1_color') }}</label>
                                            <input type="color" class="form-control" name="title1_color"
                                                value="{{ $title->title1_color ?? '#000000' }}">
                                        </div>
                                        <div class="col-md-5 mb-3 mt-3">
                                            <label for="formFile"
                                                class="form-label">{{ trans('home.choose_image') }}</label>
                                            <input class="form-control" type="file" id="formFile" name="image">
                                        </div>
                                        <div class="col-md-2 mb-3 mt-3">
                                            <label>{{ trans('home.alt_img') }}</label>
                                            <input class="form-control" name="alt_img" type="text"
                                                value="{{ $title->alt_img }}" placeholder="{{ trans('home.alt_img') }}" />
                                        </div>
                                        @if ($title->image)
                                            <div class="form-group  col-md-2 m-2 mt-3">
                                                <img src="{{ $title->image }}" width="200" height="150">
                                            </div>
                                        @else
                                            <div class="form-group  col-md-3 mt-3">
                                                <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                                    width="70">
                                            </div>
                                        @endif
                                        <div class="col-md-2 mb-3">
                                            <label for="order">{{ trans('home.order') }}</label>
                                            <input type="number" min="0" class="form-control"
                                                placeholder="{{ trans('home.order') }}" name="order"
                                                value="{{ $title->order }}">
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="text_en">{{ trans('home.text_en') }}</label>
                                            <textarea class="form-control ckeditor-classic" placeholder="{{ trans('home.text_en') }}" name="text_en">{!! $title->text_en !!}</textarea>
                                        </div>

                                        <div class="form-group col-md-6 ">
                                            <label for="text_ar">{{ trans('home.text_ar') }}</label>
                                            <textarea class="form-control ckeditor-classic" placeholder="{{ trans('home.text_ar') }}" name="text_ar">{!! $title->text_ar !!}</textarea>
                                        </div>
                                        {{-- <div class="col-md-6 mb-3">
                                        <label for="type">{{trans('home.parent')}}</label>
                                    <select class="form-control" data-trigger name="type" required>
                                        <option {{ $title->type == 'about' ? 'selected' : '' }} value="about">
                                            {{ trans('home.about-us') }}
                                        </option>
                                        <option {{ $title->type == 'services' ? 'selected' : '' }} value="services">
                                            {{ trans('home.services') }}
                                        </option>
                                        <option {{ $title->type == 'gallery' ? 'selected' : '' }} value="gallery">
                                            {{ trans('home.gallery') }}
                                        </option>
                                        <option {{ $title->type == 'contact' ? 'selected' : '' }} value="contact">
                                            {{ trans('home.contact-us') }}
                                        </option>
                                        <option {{ $title->type == 'blogs' ? 'selected' : '' }} value="blogs">
                                            {{ trans('home.blogs') }}
                                        </option>
                                        <option {{ $title->type == 'reviews' ? 'selected' : '' }} value="reviews">
                                            {{ trans('home.reviews') }}
                                        </option>
                                        <option {{ $title->type == 'whyus' ? 'selected' : '' }} value="whyus">
                                            {{ trans('home.whyus') }}
                                        </option>
                                        </option>
                                    </select>
                                </div> --}}

                                        <div class="col-md-6 mb-3">
                                            <label class="">{{ trans('home.number') }}</label>
                                            <input class="form-control" name="number" type="number"
                                                value="{{ $title->number }}" placeholder="{{ trans('home.number') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="">{{ trans('home.link') }}</label>
                                            <input class="form-control" name="link" type="link"
                                                value="{{ $title->link }}" placeholder="{{ trans('home.link') }}">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>{{ trans('home.parent') }}</label>
                                            <p class="form-control-static">{{ trans('home.' . $title->type) }}</p>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch"
                                                switch="success" {{ $title->status == 1 ? 'checked' : '' }} />
                                            <label for="switch" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch">
                                                {{ trans('home.publish') }}</label>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit"
                                            class="btn btn-primary w-md">{{ trans('home.save') }}</button>
                                        <a href="{{ url('/admin/titles') }}"><button type="button"
                                                class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                                {{ trans('home.cancel') }}</button></a>
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
