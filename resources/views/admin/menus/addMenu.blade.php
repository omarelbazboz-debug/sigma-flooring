@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_menu')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.menus')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/menus')}}">{{trans('home.menus')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_menu')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('home.add_menu')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.name_en')}}</label>
                                        <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.name_ar')}}</label>
                                        <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="status" id="switch" switch="success" checked />
                                        <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/menus')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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