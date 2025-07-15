@extends('layouts.admin')
@section('meta')
<title>{{trans('home.edit_writer')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.writers')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/writers')}}">{{trans('home.writers')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_writer')}}</li>
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
                    <h4 class="card-title">{{trans('home.edit_writer')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <form method="POST" action="{{ url('admin/writers/'.$writer->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @method('PATCH')
                                @csrf
                                <div class="row">

                                    <div class="col-md-3 mb-3">
                                        <label for="name">{{trans('home.name')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.name')}}" name="name" value="{{$writer->name}}" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="email">{{trans('home.email')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.email')}}" name="email" value="{{$writer->email}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="phone">{{trans('home.phone')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.phone')}}" name="phone" value="{{$writer->phone}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="position">{{trans('home.position')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.position')}}" name="position" value="{{$writer->position}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="facebook">{{trans('home.facebook')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.facebook')}}" name="facebook" value="{{$writer->facebook}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="linkedin">{{trans('home.linkedin')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.linkedin')}}" name="linkedin" value="{{$writer->linkedin}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="instgram">{{trans('home.instgram')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.instgram')}}" name="instgram" value="{{$writer->instgram}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="twitter">{{trans('home.twitter')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.twitter')}}" name="twitter" value="{{$writer->twitter}}">
                                    </div>

                                    <div class="col-md-8 mb-3 ">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>
                                    @if($writer->image)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{url('\uploads\aboutStrucs\resize200')}}\{{$writer->image}}" width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif

                                    <div class="form-group col-md-12 ">
                                        <label for="aboutWriter">{{trans('home.aboutWriter')}}</label>
                                        <textarea class="form-control ckeditor-classic" placeholder="{{trans('home.aboutWriter')}}" name="aboutWriter">{!! $writer->aboutWriter !!}</textarea>
                                        <br>
                                    </div>
                                </div>
                                <div class="form-group col-4">

                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($writer->status == 1)? 'checked':''}} />
                                        <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/writers')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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