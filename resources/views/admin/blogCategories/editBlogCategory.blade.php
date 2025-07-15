<div class="row">
    <div class="col-md-2 mb-3">

        <div class="form-check d-flex">
            <input type="checkbox" value="1" name="status" id="switch" switch="success" checked />
            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
        </div>
    </div> @extends('layouts.admin')
    @section('meta')
    <title>{{trans('home.edit_blog_category')}}</title>
    @endsection
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.blogCategories')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/admin/blog-categories')}}">{{trans('home.blogCategories')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.edit_blog_category')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('home.edit_blog_category')}}</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- End Page Header -->
                                <form method="POST" action="{{ url('admin/blog-categories/' . $blogCategory->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                    @method('PATCH')
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="title_en">{{trans('home.title_en')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" value="{{$blogCategory->title_en}}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="title_ar">{{trans('home.title_ar')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar" value="{{$blogCategory->title_ar}}">
                                        </div>


                                        <div class="col-md-6 mb-3 ">
                                            <label for="text_en">{{trans('home.text_en')}}</label>
                                            <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}">{{$blogCategory->text_en}}</textarea>
                                        </div>

                                        <div class="col-md-6 mb-3 ">
                                            <label for="text_ar">{{trans('home.text_ar')}}</label>
                                            <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}">{{$blogCategory->text_ar}}</textarea>
                                        </div>

                                        <div class="col-md-2 mb-3 ">
                                            <label for="link_en">{{trans('home.slug').' '.trans('home.en')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en" value="{{$blogCategory->link_en}}">
                                        </div>

                                        <div class="col-md-5 mb-3 ">
                                            <label for="meta_title"> {{trans('home.meta_title').' '.trans('home.en')}}</label>
                                            <textarea class="form-control" name="meta_title_en" value="{{$blogCategory->meta_title_en}}" placeholder="{{trans('home.meta_title')}}"></textarea>
                                        </div>

                                        <div class="col-md-5 mb-3 ">
                                            <label for="meta_desc"> {{trans('home.meta_desc').' '.trans('home.en')}}</label>
                                            <textarea class="form-control" name="meta_desc_en" value="{{$blogCategory->meta_desc_en}}" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                        </div>


                                        <div class="col-md-2 mb-3 ">
                                            <label for="link_ar">{{trans('home.slug').' '.trans('home.ar')}}</label>
                                            <input type="text" class="form-control" value="{{$blogCategory->link_ar}}" placeholder="{{trans('home.slug')}}" name="link_ar">
                                        </div>

                                        <div class="col-md-5 mb-3 ">
                                            <label for="meta_title"> {{trans('home.meta_title').' '.trans('home.ar')}}</label>
                                            <textarea class="form-control" name="meta_title_ar" value="{{$blogCategory->meta_title_ar}}" placeholder="{{trans('home.meta_title')}}"></textarea>
                                        </div>

                                        <div class="col-md-5 mb-3 ">
                                            <label for="meta_desc"> {{trans('home.meta_desc').' '.trans('home.ar')}}</label>
                                            <textarea class="form-control" name="meta_desc_ar" value="{{$blogCategory->meta_desc_ar}}" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2 mb-3">

                                                <div class="form-check d-flex">
                                                    <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($blogCategory->status == 1)? 'checked':''}} />
                                                    <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                                    <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">

                                                <div class="form-check d-flex">
                                                    <input type="checkbox" value="1" name="meta_robots" id="meta_robots" switch="success" {{($blogCategory->meta_robots == 1)? 'checked':''}} />
                                                    <label for="meta_robots" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                                    <label class="form-check-label mx-3" for="meta_robots"> {{trans('home.meta_robots')}}(index)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-xl">{{trans('home.save')}}</button>
                                        <a href="{{url('/admin/blog-categories')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

    @section('script')
    <script>
        $(document).ready(function() {
            $('#switch, #meta_robots').change(function() {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    $(this).attr('checked', 'checked');
                } else {
                    $(this).removeAttr('checked');
                }
            });
        });
    </script>
    @endsection