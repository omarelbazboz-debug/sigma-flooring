@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_blog_item')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.blogItems')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/blog-items')}}">{{trans('home.blogItems')}}</a></li>
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
                            @if ($errors->any())
                                <script>
                                    let errorMessages = '';
                                    @foreach ($errors->all() as $error)
                                        errorMessages += '{{ $error }}\n';
                                    @endforeach
                                    alert(errorMessages);
                                </script>
                            @endif
                            <form method="POST" action="{{ route('blog-items.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="title_en">{{trans('home.title_en')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="title_ar">{{trans('home.title_ar')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="parent">{{trans('home.blogCategory')}}</label>
                                        <select class="form-control" data-trigger name="blogcategory_id">
                                            @foreach($blogCategories as $blogCategory)
                                            <option value="{{$blogCategory->id}}">{{(app()->getLocale()=='en')? $blogCategory->title_en:$blogCategory->title_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="type">{{trans('home.writers')}}</label>
                                        <select class="form-control select2 type" name="writer_id">
                                            @foreach ($writers as $writer)
                                            <option value="{{$writer->id}}">{{$writer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="code">{{trans('home.date')}}</label>
                                        <div class="input-group">
                                            <input type='date' class="form-control" name="date" placeholder="{{trans('home.date')}}" id="datepicker"   />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>
                                    <div class="col-md-4 mb-3 mt-3">
                                        <label>{{trans('home.alt_img')}}</label>
                                        <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}" />
                                    </div>

                                    <div class="col-md-6 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.banner') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="banner">
                                    </div>

                                    <div class="col-md-4 mb-3 mt-3">
                                        <label>{{trans('home.alt_banner')}}</label>
                                        <input class="form-control" name="alt_banner" type="text" placeholder="{{trans('home.alt_banner')}}" />
                                    </div>
                                    <hr>
                                    <div class="form-group col-md-6 ">
                                        <label for="shorttext_en">{{trans('home.hometext_en')}}</label>
                                        <textarea class="form-control" name="shorttext_en" placeholder="{{trans('home.hometext_en')}}"></textarea>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="shorttext_ar">{{trans('home.hometext_ar')}}</label>
                                        <textarea class="form-control" name="shorttext_ar" placeholder="{{trans('home.hometext_ar')}}"></textarea>
                                    </div>

                                    <hr>

                                    <div class="form-group col-md-6 ">
                                        <label for="text_en">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}"></textarea>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="text_ar">{{trans('home.text_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}"></textarea>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{trans('home.faq')}}</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="field_wrapper">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="question">{{trans('home.writer')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{trans('home.writer')}}" name="question[]">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="answer">{{trans('home.answer')}}</label>
                                                    <textarea class="form-control" placeholder="{{trans('home.answer')}}" name="answer[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="add_button btn m-2" title="Add field"><i class="fas fa-plus-square"></i></a>
                                    </div>

                                    <div class="form-group col-md-12">
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
                                    </div>

                                </div>
                                <!-- Row-->
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
                                            <input type="checkbox" value="1" name="home" id="switch1" switch="success" checked />
                                            <label for="switch1" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch1"> {{trans('home.home')}}</label>
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
                                    <a href="{{url('/admin/blog-items')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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


@section('script')
<script>
    $(document).ready(function() {
        var maxField = 100; // الحد الأقصى لعدد الحقول
        var addButton = $('.add_button'); // محدد زر الإضافة
        var wrapper = $('.field_wrapper'); // لف الحقول
        var fieldHTML = '<div class="row"><hr><div class="form-group col-md-6">' +
            '<label for="question">{{ trans("home.question") }}</label>' +
            '<input type="text" class="form-control" placeholder="{{ trans("home.question") }}" name="question[]">' +
            '</div>';
        fieldHTML += '<div class="form-group col-md-5">' +
            '<label for="answer">{{ trans("home.answer") }}</label>' +
            '<textarea class="form-control" placeholder="{{ trans("home.answer") }}" name="answer[]"></textarea>' +
            '</div>';
        fieldHTML += '<div class="form-group col-md-1">' +
            '<a href="javascript:void(0);" style="margin-top: 30px;" class="remove_button btn">' +
            '<i class="fas fa-trash-alt"></i></a>' +
            '</div></div>';

        var x = 1; // عداد الحقول المبدئي

        // عند الضغط على زر الإضافة
        $(addButton).click(function() {
            // تحقق من الحد الأقصى لعدد الحقول
            if (x < maxField) {
                x++; // زيادة عداد الحقول
                $(wrapper).append(fieldHTML); // إضافة الحقل
            }
        });

        // عند الضغط على زر الحذف
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent().parent('div').remove(); // حذف الحقل
            x--; // تقليل عداد الحقول
        });
    });
</script>

@endsection