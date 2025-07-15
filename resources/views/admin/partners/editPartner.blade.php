@extends('layouts.admin')
<title>{{trans('home.edit_company')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.Our partners')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/partners')}}">{{trans('home.companies')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_company')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- End Page Header -->
                            <form method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_logo') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="logo">
                                    </div>
                                    @if($partner->logo)
                                    <div class="form-group  col-md-3 m-2 mt-3">
                                        <img src="{{$partner->logo}}" width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif

                                    <div class="col-md-1 m-2 mt-3">
                                        <label for="order">{{ trans('home.order') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.order') }}" name="order" value="{{ $partner->order }}">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($partner->status == 1)? 'checked':''}} />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="meta_robots" id="switch2" switch="success" {{($partner->meta_robots == 1)? 'checked':''}} />
                                            <label for="switch2" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch2"> {{trans('home.meta_robots')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/partners')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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