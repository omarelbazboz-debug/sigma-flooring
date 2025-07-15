@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.add_projects')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.projects')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/projects')}}">{{trans('home.projects')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_projects')}}</li>
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
                            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" data-toggle="validator">
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

                                    <div class="col-md-8 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="alt_img"> {{trans('home.alt_img')}}</label>
                                        <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="helperText">{{trans('home.category')}}</label>
                                        <select class="form-control choices-single-default" data-trigger name="category_id" required>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{(app()->getLocale() == 'en')?$category->name_en:$category->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save_and_continue')}}</button>
                                    <a href="{{url('/admin/projects')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

