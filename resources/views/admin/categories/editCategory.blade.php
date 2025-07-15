@extends('layouts.admin')
<title>{{trans('home.edit_category')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.categories')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/categories')}}">{{trans('home.categories')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_category')}}</li>
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
                    <h4 class="card-title">{{trans('home.edit_category')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <form method="POST" action="{{ url('admin/categories/' . $category->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @method('PATCH')

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label class="">{{trans('home.name_en')}}</label>
                                        <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" value="{{$category->name_en}}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="">{{trans('home.name_ar')}}</label>
                                        <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" value="{{$category->name_ar}}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="parent">{{trans('home.parent')}}</label>
                                        <select class="form-control" data-trigger name="parent_id">
                                            <option value="0">{{trans('home.no_parent')}}</option>
                                            @foreach($categories as $categ)
                                            <option value="{{$categ->id}}" {{($categ->id == $category->parent_id)?'selected':''}}>{{(app()->getLocale()=='en')? $categ->name_en:$categ->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    @if($category->image)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{url('\uploads\categories\source')}}\{{$category->image}}" width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif

                                    <div class="form-group col-md-6">
                                        <label class="">{{trans('home.desc_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="desc_en" type="text" placeholder="{{trans('home.desc_en')}}" required>{{$category->desc_en}}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="">{{trans('home.desc_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="desc_ar" type="text" placeholder="{{trans('home.desc_ar')}}">{{$category->desc_ar}}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{trans('home.seo_block')}}</h4>
                                        <span class="badge-soft-primary">{{trans('home.en')}}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_en">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en" value="{{$category->link_en}}">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}">{{$category->meta_title_en}}</textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}">{{$category->meta_desc_en}}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge-soft-primary">{{trans('home.ar')}}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_ar">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar" value="{{$category->link_ar}}">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$category->meta_title_ar}}</textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$category->meta_desc_ar}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($category->status == 1)? 'checked':''}} />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="home" id="switch1" switch="success" {{($category->home == 1)? 'checked':''}} />
                                            <label for="switch1" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch1"> {{trans('home.home')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="menu" id="switch2" switch="success" {{($category->menu == 1)? 'checked':''}} />
                                            <label for="switch2" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch2"> {{trans('home.menu')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="meta_robots" id="switch3" switch="success" {{($category->meta_robots == 1)? 'checked':''}} />
                                            <label for="switch3" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch3"> {{trans('home.meta_robots')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/categories')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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