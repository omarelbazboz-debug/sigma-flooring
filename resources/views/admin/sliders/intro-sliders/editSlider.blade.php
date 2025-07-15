@extends('layouts.admin')
<title>{{trans('home.edit_intro_sliders')}}</title>
@section('content')

<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.intro_sliders')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/intro-sliders')}}">{{trans('home.intro_sliders')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_slider')}}</li>
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
                    <h4 class="card-title">{{trans('home.edit_slider')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ url('admin/intro-sliders/'.$slider->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.title')}}</label>
                                        <input class="form-control" name="title" type="text" placeholder="{{trans('home.title')}}" value="{{$slider->title}}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="helperText">{{trans('home.lang')}}</label>
                                        <select class="form-control" col-md-6 mb-3 name="lang" required>
                                            <option value="en">{{trans('home.english')}}</option>
                                            <option value="ar">{{trans('home.arabic')}}</option>
                                        </select>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.link')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">http://www.google.com</span>
                                            </div>
                                            <input type="text" class="form-control" name="link" placeholder="{{trans('home.link')}}" value="{{$slider->link}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.order')}}</label>
                                        <input class="form-control" name="order" type="number" min="0" autocomplete="off" placeholder="{{trans('home.order')}}" value="{{$slider->order}}">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="">{{trans('home.text')}}</label>
                                        <textarea class="form-control" id="ckeditor-classic" name="text" placeholder="{{trans('home.text')}}">{!! $slider->text !!}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    @if($slider->image)
                                    <div class="form-group  col-md-12">
                                        <img src="{{url('\uploads\sliders\intro-sliders\source')}}\{{$slider->image}}" width="350" height="150">
                                    </div>
                                </div>
                                @endif

                        </div>
                        <div class="form-group">

                            <div class="form-check d-flex">
                                <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($slider->status == 1)? 'checked':''}} />
                                <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                            <a href="{{url('/admin/intro-sliders')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                        </div>
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