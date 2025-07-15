@extends('layouts.admin')

@section('meta')
<title>{{trans('home.edit_teams')}}</title>
@endsection
@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.teams')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/teams')}}">{{trans('home.teams')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_team')}}</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">

                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">{{trans('home.edit_team')}}</h6>
                    </div>

                    <form method="POST" action="{{ url('admin/teams/' . $team->id) }}" enctype="multipart/form-data" data-toggle="validator">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.name_en')}}</label>
                                <input class="form-control" name="name_en" type="text" value="{{$team->name_en}}" >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.name_ar')}}</label>
                                <input class="form-control" name="name_ar" type="text" value="{{$team->name_ar}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.position_en')}}</label>
                                <input class="form-control" name="position_en" type="text"  value="{{$team->position_en}}">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.position_ar')}}</label>
                                <input class="form-control" name="position_ar" type="text"  value="{{$team->position_ar}}">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="">{{trans('home.text_en')}}</label>
                                <textarea class="form-control  ckeditor-classic" name="text_en"  placeholder="{{trans('home.text')}}">{!! $team->text_en !!}</textarea>
                                <br>
                            </div>
                              <div class="form-group col-md-6">
                                <label class="">{{trans('home.text_ar')}}</label>
                                <textarea class="form-control ckeditor-classic" name="text_ar"  placeholder="{{trans('home.text_ar')}}">{!! $team->text_ar !!}</textarea>
                                <br>
                            </div>
                            

                            <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="img">
                            </div>

                       
                            <div class="form-group  col-md-12">
                                <img src="{{$team->img}}" width="200" height="150">
                            </div>
                         

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.mobile')}}</label>
                                <input class="form-control" name="mobile" type="text" placeholder="{{trans('home.mobile')}}" value="{{$team->mobile}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.facebook')}}</label>
                                <input class="form-control" name="facebook" type="text" placeholder="{{trans('home.facebook')}}" value="{{$team->facebook}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.instagram')}}</label>
                                <input class="form-control" name="instgram" type="text" placeholder="{{trans('home.instagram')}}" value="{{$team->instgram}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.linkedin')}}</label>
                                <input class="form-control" name="linkedin" type="text" placeholder="{{trans('home.linkedin')}}" value="{{$team->linkedin}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="ckbox">
                                    <input name="status" value="1" {{($team->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                </label>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                <a href="{{url('/admin/teams')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                            </div>

                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>

@endsection