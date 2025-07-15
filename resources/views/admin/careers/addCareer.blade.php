@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_head_headers')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.head_headers')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/careers')}}">{{trans('home.head_headers')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_head_headers')}}</li>
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
                    <h4 class="card-title">{{trans('home.add_head_headers')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('careers.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <div class="row">


                                    <div class="col-md-4 mb-3">
                                        <label class="">{{trans('home.title_en')}}</label>
                                        <input class="form-control" name="title_en" type="text" placeholder="{{trans('home.title_en')}}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="">{{trans('home.title_ar')}}</label>
                                        <input class="form-control" name="title_ar" type="text" placeholder="{{trans('home.title_ar')}}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="order">{{trans('home.order')}}</label>
                                        <input type="number" min="0" class="form-control" placeholder="{{trans('home.order')}}" name="order">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="icon">{{trans('home.icon')}}</label>
                                        <input type="text" min="0" class="form-control" placeholder="EXMP: fas fa-cogs" name="icon">
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="text_en">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}"></textarea>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="text_ar">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}"></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="type">{{trans('home.parent')}}</label>
                                        <select class="form-control" data-trigger name="type" required>
                                            <option value="statistics">{{trans('home.statistics')}}</option>
                                            <option value="header">{{trans('home.header')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.number')}}</label>
                                        <input class="form-control" name="number" type="number" placeholder="{{trans('home.number')}}">
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
                                    <a href="{{url('/admin/careers')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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