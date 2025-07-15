@extends('layouts.admin')
<title>{{trans('home.seo_assistant')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.seo_assistant')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.seo_assistant')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card-body">
                <div class="table-rep-plugin">
                    <div class="mb-0" data-pattern="priority-columns">

                        <form method="POST" action="{{ url('admin/seo-assistant/' . $seo->id) }}" enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.home_page')}}</h6>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="home_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->home_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="home_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->home_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="home_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->home_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="home_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->home_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="home_meta_robots" id="switch0" switch="success" {{($seo->home_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch0" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch0"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">

                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.about_us')}}</h6>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="about_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->about_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="about_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->about_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="about_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->about_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="about_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->about_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="about_meta_robots" id="switch1" switch="success" {{($seo->about_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch1" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch1"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">

                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.contact_us')}}</h6>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="contact_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->contact_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="contact_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->contact_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="contact_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->contact_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="contact_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->contact_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="contact_meta_robots" id="switch2" switch="success" {{($seo->contact_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch2" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch2"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">

                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.galleryImages')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="gallery_images_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_images_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="gallery_images_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_images_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="gallery_images_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_images_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="gallery_images_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_images_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="gallery_images_meta_robots" id="switch3" switch="success" {{($seo->gallery_images_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch3" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch3"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">

                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.galleryVideos')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="gallery_videos_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_videos_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="gallery_videos_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_videos_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="gallery_videos_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_videos_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="gallery_videos_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_videos_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="gallery_videos_meta_robots" id="switch4" switch="success" {{($seo->gallery_videos_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch4" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch4"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">

                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.services')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="services_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->services_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="services_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->services_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="services_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->services_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="services_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->services_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="services_meta_robots" id="switch5" switch="success" {{($seo->services_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch5" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch5"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">

                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.blogs')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="blogs_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->blogs_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="blogs_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->blogs_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="blogs_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->blogs_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="blogs_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->blogs_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="blogs_meta_robots" id="switch6" switch="success" {{($seo->blogs_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch6" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch6"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">
                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.categories')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="categories_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->categories_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="categories_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->categories_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="categories_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->categories_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="categories_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->categories_meta_desc_ar}}</textarea>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="categories_meta_robots" id="switch7" switch="success" {{($seo->categories_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch7" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch7"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <hr class="text-success">
                            <!-- Row-->
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.brands')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="brands_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->brands_meta_title}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="brands_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->brands_meta_desc}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="brands_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->brands_meta_title_ar}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="brands_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->brands_meta_desc_ar}}</textarea>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-check d-flex">
                                        <input type="checkbox" value="1" name="brands_meta_robots" id="switch8" switch="success" {{($seo->brands_meta_robots == 1)? 'checked':''}} />
                                        <label for="switch8" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        <label class="form-check-label mx-3" for="switch8"> {{trans('home.publish')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-xl">{{trans('home.save')}}</button>
                                <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                            </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection