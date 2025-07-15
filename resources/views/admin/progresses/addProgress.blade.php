@extends('layouts.admin')
@section('meta')
<title>{{ trans('home.number_progresses') }}</title>
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
                                href="{{ url('/admin/progresses') }}">{{ trans('home.head_headers') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('home.number_progresses') }}</li>
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
                    <h4 class="card-title">{{ trans('home.number_progresses') }}</h4>
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
                            <form method="POST" action="{{ route('progresses.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="">{{ trans('home.title_ar') }}</label>
                                        <input class="form-control" name="title_ar" type="text"
                                            placeholder="{{ trans('home.title_ar') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="">{{ trans('home.title_en') }}</label>
                                        <input class="form-control" name="title_en" type="text"
                                            placeholder="{{ trans('home.title_en') }}" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="">{{ trans('home.number_progress') }}</label>
                                        <input class="form-control" name="number" type="number"
                                            placeholder="{{ trans('home.number_progress') }}">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="order">{{ trans('home.order') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.order') }}" name="order">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{ trans('home.text_ar') }}</label>
                                        <input class="form-control" name="text_ar" type="text"
                                            placeholder="{{ trans('home.text_ar') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{ trans('home.text_en') }}</label>
                                        <input class="form-control" name="text_en" type="text"
                                            placeholder="{{ trans('home.text_en') }}">
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>{{ trans('home.alt_img') }}</label>
                                        <input class="form-control" name="alt_img" type="text"
                                            placeholder="{{ trans('home.alt_img') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="status" id="switch" switch="success"
                                            checked />
                                        <label for="switch" data-on-label="{{ trans('home.yes') }}"
                                            data-off-label="{{ trans('home.no') }}"></label>
                                        <label class="form-check-label mx-3" for="switch">
                                            {{ trans('home.publish') }}</label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{ trans('home.save') }}</button>
                                    <a href="{{ url('/admin/progresses') }}"><button type="button"
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
    <!-- End Row -->
</div>
@endsection