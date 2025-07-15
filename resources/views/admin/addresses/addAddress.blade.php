@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_address')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.addresses')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/addresses')}}">{{trans('home.addresses')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_address')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- End Page Header -->
                            <form method="POST" action="{{ route('addresses.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.title_en')}}</label>
                                        <input class="form-control" name="title_en" type="text" placeholder="{{trans('home.title_en')}}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.title_ar')}}</label>
                                        <input class="form-control" name="title_ar" type="text" placeholder="{{trans('home.title_ar')}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.address_en')}}</label>
                                        <input class="form-control" name="address_en" type="text" placeholder="{{trans('home.address_en')}}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.address_ar')}}</label>
                                        <input class="form-control" name="address_ar" type="text" placeholder="{{trans('home.address_ar')}}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{trans('home.phone')}}</label>
                                        <input class="form-control" name="tel" type="tel" placeholder="{{trans('home.phone')}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.email')}}</label>
                                        <input class="form-control" name="email" type="email" placeholder="{{trans('home.email')}}">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{trans('home.map_url')}}</label>
                                        <textarea class="form-control" name="map_url" type="text" placeholder="{{trans('home.map_url')}}"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>{{trans('home.Embed_map')}}</label>
                                        <textarea class="form-control" name="link" type="text" placeholder="{{trans('home.Embed_map')}}"></textarea>
                                    </div>
                                    <div class="col-md-4 mb-3 ">
                                        <label for="parent">{{trans('home.type')}}</label>
                                        <select class="form-control" data-trigger name="type">
                                            <option value="Office">Office</option>
                                            <option value="Studio">Studio</option>
                                            <option value="Shop">Shop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" checked />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-xl">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/addresses')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                                <!-- End Row -->

                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection