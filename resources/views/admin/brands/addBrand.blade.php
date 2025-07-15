@extends('layouts.admin')
<title>{{trans('home.add_company')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.clients')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/brands')}}">{{trans('home.companies')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_blog_item')}}</li>
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
                            <form method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <div class="row">
                                    {{-- <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.name_en')}}</label>
                                    <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="">{{trans('home.name_ar')}}</label>
                                    <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="text_en">{{trans('home.text_en')}}</label>
                                    <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}"></textarea>
                                </div>

                                <div class="col-md-6 mb-3 ">
                                    <label for="text_ar">{{trans('home.text_ar')}}</label>
                                    <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}"></textarea>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="facebook">{{trans('home.Facebook')}}</label>
                                    <input class="form-control " name="facebook" type="text" placeholder="{{trans('home.Facebook')}}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="instagram">{{trans('home.instagram')}}</label>
                                    <input class="form-control " name="instagram" type="text" placeholder="{{trans('home.instagram')}}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="pinterest">{{trans('home.pinterest')}}</label>
                                    <input class="form-control " name="pinterest" type="text" placeholder="{{trans('home.pinterest')}}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="youtube">{{trans('home.youtube')}}</label>
                                    <input class="form-control " name="youtube" type="text" placeholder="{{trans('home.youtube')}}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="twitter">{{trans('home.twitter')}}</label>
                                    <input class="form-control " name="twitter" type="text" placeholder="{{trans('home.twitter')}}">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="address">{{trans('home.address')}}</label>
                                    <input class="form-control " name="address" type="text" placeholder="{{trans('home.address')}}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="phone">{{trans('home.phone')}}</label>
                                    <input class="form-control " name="phone" type="text" placeholder="{{trans('home.phone')}}">
                                </div> --}}
                                <div class="col-md-10 mb-3 mt-3">
                                    <label for="formFile" class="form-label">{{ trans('home.logo') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="logo">
                                </div>
                                <div class="col-md-2 mb-3 mt-3">
                                    <label for="order">{{trans('home.order')}}</label>
                                    <input type="number" min="0" class="form-control" placeholder="{{trans('home.order')}}" name="order">
                                </div>
                                {{-- <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{trans('home.seo_block')}}</h4>
                                <span class="badge-soft-primary">{{trans('home.en')}}</span>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="link_en">{{trans('home.slug')}}</label>
                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                            <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}"></textarea>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                            <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <hr>
                            <span class="badge-soft-primary">{{trans('home.ar')}}</span>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="link_ar">{{trans('home.slug')}}</label>
                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                            <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}"></textarea>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                            <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}"></textarea>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="form-group col-4">

                            <div class="form-check d-flex">
                                <input type="checkbox" value="1" name="status" id="switch" switch="success" checked />
                                <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                            </div>
                        </div>
                        <div class="form-group col-4">

                            <div class="form-check d-flex">
                                <input type="checkbox" value="1" name="meta_robots" id="switch2" switch="success" checked />
                                <label for="switch2" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                <label class="form-check-label mx-3" for="switch2"> {{trans('home.meta_robots')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                        <a href="{{url('/admin/brands')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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