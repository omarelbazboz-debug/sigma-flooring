@extends('layouts.admin')
<title>{{trans('home.edit_testimonial')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.testimonials')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/testimonials')}}">{{trans('home.testimonials')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_testimonial')}}</li>
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
                    <form method="POST" action="{{ url('admin/testimonials/' . $testimonial->id) }}" enctype="multipart/form-data" data-toggle="validator">
                        @csrf
                        @method('PATCH')

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="">{{trans('home.name')}}</label>
                                <input class="form-control" name="name" type="text" placeholder="{{trans('home.name')}}" value="{{$testimonial->name}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="">{{trans('home.position')}}</label>
                                <input class="form-control" name="position" type="text" placeholder="{{trans('home.position')}}" value="{{$testimonial->position}}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="helperText">{{trans('home.lang')}}</label>
                                <select class="form-control" data-trigger name="lang" required>
                                    <option value="en">{{trans('home.english')}}</option>
                                    <option value="ar">{{trans('home.arabic')}}</option>
                                </select>
                            </div>

                            <div class="col-md-8 mb-3 mt-3">
                                <label for="formFile" class="form-label">{{ trans('home.image') }}</label>
                                <input class="form-control" type="file" id="formFile" name="img">
                            </div>

                            @if($testimonial->img)
                            <div class="form-group  col-md-2 m-2 mt-3">
                                <img src="{{url('\uploads\testimonials\source')}}\{{$testimonial->img}}" width="200" height="150">
                            </div>
                            @else
                            <div class=" col-md-3 mt-3">
                                <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                            </div>
                            @endif


                            <div class="form-group col-md-12">
                                <label class="">{{trans('home.text')}}</label>
                                <textarea class="form-control" name="text" placeholder="{{trans('home.text')}}">{!! $testimonial->text !!}</textarea>
                                <br>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-4">

                                <div class="form-check d-flex">
                                    <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($testimonial->status == 1)? 'checked':''}} />
                                    <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                            <a href="{{url('/admin/testimonials')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>

@endsection