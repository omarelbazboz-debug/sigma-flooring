@extends('layouts.admin')

@section('meta')
<title>{{trans('home.edit_blog_item')}}</title>
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
                        <li class="breadcrumb-item active">{{trans('home.edit_blog_item')}}</li>
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
                            @if ($errors->any())
                            <script>
                                let errorMessages = '';
                                @foreach ($errors->all() as $error)
                                    errorMessages += '{{ $error }}\n';
                                @endforeach
                                alert(errorMessages);
                            </script>
                        @endif
                            <!-- End Page Header -->
                            <form method="POST" action="{{ url('admin/blog-items/' . $blogItem->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @method('PATCH')
                                @csrf
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label for="title_en">{{trans('home.title_en')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" value="{{$blogItem->title_en}}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="title_ar">{{trans('home.title_ar')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar" value="{{$blogItem->title_ar}}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="parent">{{trans('home.blogCategory')}}</label>
                                        <select class="form-control" data-trigger name="blogcategory_id">
                                            @foreach($blogCategories as $blogCategory)
                                            <option value="{{$blogCategory->id}}" {{($blogCategory->id == $blogItem->blogcategory_id)?'selected':''}}>{{(app()->getLocale()=='en')? $blogCategory->title_en:$blogCategory->title_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="type">{{trans('home.writers')}}</label>
                                        <select class="form-control select2 type" name="writer_id">
                                            @foreach ($writers as $writer)
                                            <option value="{{$writer->id}}" @if($writer->id == $blogItem->writer_id)selected @endif>{{$writer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="code">{{trans('home.date')}}</label>
                                        <div class="input-group">
                                            <input type='date' class="form-control" name="date" placeholder="{{trans('home.date')}}" id="datepicker" value="{{$blogItem->date}}" required />
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

                                    <div class="col-md-3 mb-3 mt-3">
                                        <label>{{trans('home.alt_img')}}</label>
                                        <input class="form-control" name="alt_img" type="text" value="{{$blogItem->alt_img}}" placeholder="{{trans('home.alt_img')}}" />
                                    </div>


                                    @if($blogItem->image)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{$blogItem->image}}" width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif

                                    <div class="col-md-6 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.banner') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="banner">
                                    </div>

                                    <div class="col-md-3 mb-3 mt-3">
                                        <label>{{trans('home.alt_banner')}}</label>
                                        <input class="form-control" name="alt_banner" type="text" value="{{$blogItem->alt_banner}}" placeholder="{{trans('home.alt_banner')}}" />
                                    </div>


                                    @if($blogItem->banner)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{url('\uploads\blogitems\source')}}\{{$blogItem->banner}}" width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif

                                    <div class="form-group col-md-6 ">
                                        <label for="shorttext_en">{{trans('home.shorttext_en')}}</label>
                                        <textarea class="form-control" name="shorttext_en" placeholder="{{trans('home.shorttext_en')}}">{!! $blogItem->shorttext_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="shorttext_ar">{{trans('home.shorttext_ar')}}</label>
                                        <textarea class="form-control" name="shorttext_ar" placeholder="{{trans('home.shorttext_ar')}}">{!! $blogItem->shorttext_ar !!}</textarea>
                                    </div>

                                    <hr>

                                    <div class="form-group col-md-6 ">
                                        <label for="text_en">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}">{!! $blogItem->text_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="text_ar">{{trans('home.text_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}">{!! $blogItem->text_ar !!}</textarea>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{trans('home.faq')}}</h4>
                                    </div>
                                   <div class="col-md-12">
                                        <div class="field_wrapper">
                                            <div class="row">
                                                @if(count($questions) > 0)
                                                @foreach($questions as $key=>$question)
                                                <div class="row faq-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_title_en')}}</label>
                                                        <input type="text" class="form-control" name="faqs[{{ $key }}][title_en]" placeholder="Title (EN)" value="{{$question->title_en}}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_title_ar')}}</label>
                                                        <input type="text" class="form-control" name="faqs[{{ $key }}][title_ar]" placeholder="العنوان (عربي)" value="{{$question->title_ar}}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_text_en')}}</label>
                                                        <textarea class="form-control ckeditor-classic" name="faqs[{{ $key }}][text_en]" placeholder="Text (EN)">{{$question->text_en}}</textarea>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_text_ar')}}</label>
                                                        <textarea class="form-control ckeditor-classic" name="faqs[{{ $key }}][text_ar]" placeholder="النص (عربي)">{{$question->text_ar}}</textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label>{{ trans('home.faq_image') }}</label>
                                                        <input type="file" name="faqs[{{ $key }}][image]" class="form-control">
                                                        @if($question->image)
                                                            <img src="{{ asset('uploads/faqs/' . $question->image) }}" width="60" class="mt-2">
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <button type="button" style="margin-top: 28px;" class="btn" data-bs-toggle="modal" data-bs-target="#iconForm_{{$key}}"><i class="fas fa-edit"></i></button>
                                                        <button type="button" style="margin-top: 28px;" class="btn rmv" data-faq_id="{{$question->id}}" id="type-error"><i class="fas fa-trash-alt"></i></button>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="row faq-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_title_en')}}</label>
                                                        <input type="text" class="form-control" name="faqs[0][title_en]" placeholder="Title (EN)">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_title_ar')}}</label>
                                                        <input type="text" class="form-control" name="faqs[0][title_ar]" placeholder="العنوان (عربي)">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_text_en')}}</label>
                                                        <textarea class="form-control ckeditor-classic" name="faqs[0][text_en]" placeholder="Text (EN)"></textarea>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>{{trans('home.faq_text_ar')}}</label>
                                                        <textarea class="form-control ckeditor-classic" name="faqs[0][text_ar]" placeholder="النص (عربي)"></textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label>{{ trans('home.faq_image') }}</label>
                                                        <input type="file" name="faqs[0][image]" class="form-control">
                                                    </div>
                                                </div>
                                                @endif
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
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en" value="{{$blogItem->link_en}}">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}">{{$blogItem->meta_title_en}}</textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}">{{$blogItem->meta_desc_en}}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge-soft-primary">{{trans('home.ar')}}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_ar">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar" value="{{$blogItem->link_ar}}">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$blogItem->meta_title_ar}}</textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$blogItem->meta_desc_ar}}</textarea>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" {{($blogItem->status == 1)? 'checked':''}} />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="home" id="switch1" switch="success" {{($blogItem->home == 1)? 'checked':''}} />
                                            <label for="switch1" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch1"> {{trans('home.home')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="meta_robots" id="switch2" switch="success" {{($blogItem->meta_robots == 1)? 'checked':''}} />
                                            <label for="switch2" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch2"> {{trans('home.meta_robots')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/blog-items')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach($questions as $key=>$question)
    <div class="modal fade text-left" id="iconForm_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel34">{{trans('home.edit_faq')}}</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('updateFaq')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="question">{{trans('home.question')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('home.question')}}" name="question" value="{{$question->question}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="answer">{{trans('home.answer')}}</label>
                                <textarea type="text" class="form-control" placeholder="{{trans('home.answer')}}" name="answer">{{$question->answer}}</textarea>
                            </div>

                            <input type="hidden" name="faq_id" value="{{$question->id}}" />

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success">{{trans('home.save')}} </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

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
 <script>
    $(document).ready(function() {
        var maxField = 100; // الحد الأقصى لعدد الحقول
        var addButton = $('.add_button'); // محدد زر الإضافة
        var wrapper = $('.field_wrapper'); // لف الحقول
        var x = $(wrapper).find('.faq-row').length; // عداد الحقول المبدئي بناءً على الأسئلة فقط

        function getFieldHTML(index) {
            return '<div class="row faq-row"><hr>' +
                '<div class="form-group col-md-6">' +
                    '<label>{{ trans('home.faq_title_en') }}</label>' +
                    '<input type="text" class="form-control" name="faqs['+index+'][title_en]" placeholder="Title (EN)">' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                    '<label>{{ trans('home.faq_title_ar') }}</label>' +
                    '<input type="text" class="form-control" name="faqs['+index+'][title_ar]" placeholder="العنوان (عربي)">' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                    '<label>{{ trans('home.faq_text_en') }}</label>' +
                    '<textarea class="form-control ckeditor-classic" name="faqs['+index+'][text_en]" placeholder="Text (EN)"></textarea>' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                    '<label>{{ trans('home.faq_text_ar') }}</label>' +
                    '<textarea class="form-control ckeditor-classic" name="faqs['+index+'][text_ar]" placeholder="النص (عربي)"></textarea>' +
                '</div>' +
                '<div class="form-group col-md-12">' +
                    '<label>{{ trans('home.faq_image') }}</label>' +
                    '<input type="file" name="faqs['+index+'][image]" class="form-control">' +
                '</div>' +
                '<div class="form-group col-md-1">' +
                    '<a href="javascript:void(0);" style="margin-top: 30px;" class="remove_button btn">' +
                    '<i class="fas fa-trash-alt"></i></a>' +
                '</div></div>';
        }

        // عند الضغط على زر الإضافة
        $(addButton).click(function() {
            if (x < maxField) {
                $(wrapper).append(getFieldHTML(x));
                x++;
            }
        });

        // عند الضغط على زر الحذف
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.faq-row').remove();
            x = $(wrapper).find('.faq-row').length;
            // إعادة ترتيب الفهارس
            $(wrapper).find('.faq-row').each(function(idx, el){
                $(el).find('input, textarea, select').each(function(){
                    var name = $(this).attr('name');
                    if(name) {
                        var newName = name.replace(/faqs\[[0-9]+\]/, 'faqs['+idx+']');
                        $(this).attr('name', newName);
                    }
                });
            });
        });

        // حذف سؤال FAQ عبر AJAX
        $('.field_wrapper').on('click', '.rmv', function(e) {
            e.preventDefault();
            var btn = $(this);
            var faqId = btn.data('faq_id');
            if (!faqId) {
                // إذا كان السؤال جديد ولم يُحفظ بعد فقط احذفه من الصفحة
                btn.closest('.faq-row').remove();
                return;
            }
            if(confirm('هل أنت متأكد من حذف هذا السؤال؟')){
                $.ajax({
                    url: '/admin/faqs/' + faqId,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: token
                    },
                    success: function(response) {
                        btn.closest('.faq-row').remove();
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء الحذف!');
                    }
                });
            }
        });
    });
</script>
@endsection