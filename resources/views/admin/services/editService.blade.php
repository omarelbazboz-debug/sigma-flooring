@extends('layouts.admin')
@section('meta')
    <title>{{ trans('home.edit_service') }}</title>
@endsection

@section('style')
    <style>
        img {
            display: block !important;
        }

        .dz-hidden-input {
            position: absolute !important;
            top: 0px !important;
            left: 250px !important;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ trans('home.edit_service') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/admin/services') }}">{{ trans('home.services') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('home.edit_service') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <script>
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}\n';
                @endforeach
                alert(errorMessages);
            </script>
        @endif

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">

                    <div class="card-body">
                        <div>
                            <h6 class="card-title ">{{ trans('home.edit_service') }}</h6>
                        </div>
                        <form method="POST" action="{{ url('admin/services/' . $service->id) }}"
                            enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                            <div class="row">

                                <div class="col-md-5 mb-3">
                                    <label for="name_en">{{ trans('home.name_en') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ trans('home.name_en') }}"
                                        name="name_en" value="{{ $service->name_en }}" required>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="name_ar">{{ trans('home.name_ar') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ trans('home.name_ar') }}"
                                        name="name_ar" value="{{ $service->name_ar }}">
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="name_color">{{ trans('home.name_color') }}</label>
                                    <input type="color" class="form-control" name="name_color"
                                        value="{{ $service->name_color ?? '#000000' }}">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="helperText">{{ trans('home.parent') }}</label>
                                    <select class="form-control" data-trigger name="parent_id" required>
                                        <option value="0" {{ $service->parent_id == 0 ? 'selected' : '' }}>
                                            {{ trans('home.no_parent') }}
                                        </option>
                                        @foreach ($services as $serv)
                                            <option value="{{ $serv->id }}"
                                                {{ $serv->id == $service->parent_id ? 'selected' : '' }}>
                                                {{ app()->getLocale() == 'en' ? $serv->name_en : $serv->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="youtube_link">{{ trans('home.youtube_link') }}</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ trans('home.youtube_link') }}" name="youtube_link"
                                        value="{{ $service->youtube_link }}">
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="order">{{ trans('home.order') }}</label>
                                    <input type="number" min="0" class="form-control"
                                        placeholder="{{ trans('home.order') }}" name="order"
                                        value="{{ $service->order }}">
                                </div>

                                <div class="col-md-6 mb-3 mt-3">
                                    <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="img">
                                </div>

                                <div class="col-md-2 mb-3 mt-3">
                                    <label>{{ trans('home.alt_img') }}</label>
                                    <input class="form-control" name="alt_img" type="text"
                                        placeholder="{{ trans('home.alt_img') }}" value="{{ $service->alt_img }}" />
                                </div>

                                @if ($service->img)
                                    <div class=" col-md-2 m-2 mt-3">
                                        <img src="{{ $service->img }}" width="200" height="150">
                                    </div>
                                @else
                                    <div class=" col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}" width="70">
                                    </div>
                                @endif
                                <div class="col-md-6 mb-3 mt-3">
                                    <label for="formFile" class="form-label">{{ trans('home.pdf') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="file">
                                </div>
                                @if ($service->file)
                                    <div class=" col-md-2 m-2 mt-3">
                                        <img src="{{ $service->file }}" width="200" height="150">
                                    </div>
                                @else
                                    <div class=" col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}" width="70">
                                    </div>
                                @endif

                                <div class="col-md-8 mb-3 mt-3">
                                    <label for="formFile" class="form-label">{{ trans('home.icon') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="icon">
                                </div>

                                @if ($service->icon)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{ $service->icon }}" width="200" height="150">
                                    </div>
                                @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}" width="70">
                                    </div>
                                @endif
                                <div class="col-md-8 mb-3 mt-3">
                                    <label for="formFile" class="form-label">{{ trans('home.banner') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="banner">
                                </div>

                                @if ($service->banner)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{ $service->banner }}" width="200" height="150">
                                    </div>
                                @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}" width="70">
                                    </div>
                                @endif
                                <div class="form-group col-md-6">
                                    <label for="text1_en">{{ trans('home.hometext_en') }}</label>
                                    <textarea class="form-control ckeditor-classic" name="text1_en" placeholder="{{ trans('home.hometext_en') }}">{!! $service->text1_en !!}</textarea>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="text1_ar">{{ trans('home.hometext_ar') }}</label>
                                    <textarea class="form-control ckeditor-classic" name="text1_ar" placeholder="{{ trans('home.hometext_ar') }}">{!! $service->text1_ar !!}</textarea>
                                </div>
                                <br>
                                <hr>
                                <tr></tr>
                                <div class="form-group col-md-6">
                                    <label for="text_en">{{ trans('home.text_en') }}</label>
                                    <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{ trans('home.text_en') }}">{!! $service->text_en !!}</textarea>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="text_ar">{{ trans('home.text_ar') }}</label>
                                    <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{ trans('home.text_ar') }}">{!! $service->text_ar !!}</textarea>
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
                                                        <input type="text" class="form-control" name="faqs[0][title_en]" placeholder="Title (EN)" >
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
                                    <label for="images">{{ trans('home.service_images') }}</label>
                                    <div class="dropzone col-md-12 upload_images">
                                    </div>
                                </div>
                                @if ($service->images()->count() > 0)
                                    <a href='#' data-id="{{ $service->id }}"
                                        class='delete_all_img btn btn-danger mt-2 col-4'>{{ trans('home.delete_all') }}</a>

                                    <div class="col-md-12 mt-3">
                                        <div id="" class="row mb-0">
                                            @foreach ($service->images as $key => $image)
                                                <div class="col-xs-6 col-sm-2 col-md-2 col-xl-2 mb-2 pl-sm-2 pr-sm-2"
                                                    data-responsive="{{ $image->image_url }}"
                                                    data-src="{{ $image->image_url }}"
                                                    data-sub-html="<h4> {{ trans('home.image') }} {{ $key + 1 }}</h4>">
                                                    <a href="javascript:;">
                                                        <img class="img-responsive" src="{{ $image->image }}"
                                                            width="150px" height="150px">
                                                    </a>
                                                    <div>

                                                        <br>
                                                        <a href='#' data-image='{{ $image->id }}'
                                                            class='delete_img_btn btn btn-danger'>{{ trans('home.delete') }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <br>
                                    <hr>
                                </div>
                                <!-- مواصفات المشروع -->
                                        <div class="form-group">
                                            <label for="features">مواصفات المشروع:</label>
                                            <div class="row">
                                                @foreach ($features as $feature)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="features[]" value="{{ $feature->id }}"
                                                                id="feature_{{ $feature->id }}"
                                                                {{ isset($service) && $service->features->contains($feature->id) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="feature_{{ $feature->id }}">
                                                                {{ app()->getLocale() == 'ar' ? $feature->name_ar : $feature->name_en }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{ trans('home.en') }}</span>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="link_en">{{ trans('home.slug-en') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ trans('home.slug') }}" name="link_en"
                                                value="{{ $service->link_en }}">
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{ trans('home.meta_title') }}</label>
                                            <textarea class="form-control" name="meta_title_en" placeholder="{{ trans('home.meta_title') }}">{{ $service->meta_title_en }}</textarea>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{ trans('home.meta_desc') }}</label>
                                            <textarea class="form-control" name="meta_desc_en" placeholder="{{ trans('home.meta_desc') }}">{{ $service->meta_desc_en }}</textarea>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{ trans('home.ar') }}</span>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="link_ar">{{ trans('home.slug-ar') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ trans('home.slug') }}" name="link_ar"
                                                value="{{ $service->link_ar }}">
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{ trans('home.meta_title') }}</label>
                                            <textarea class="form-control" name="meta_title_ar" placeholder="{{ trans('home.meta_title') }}">{{ $service->meta_title_ar }}</textarea>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{ trans('home.meta_desc') }}</label>
                                            <textarea class="form-control" name="meta_desc_ar" placeholder="{{ trans('home.meta_desc') }}">{{ $service->meta_desc_ar }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch_status"
                                                switch="success" {{ $service->status == 1 ? 'checked' : '' }} />
                                            <label for="switch_status" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3"
                                                for="switch_status">{{ trans('home.publish') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="home" id="switch_home"
                                                switch="success" {{ $service->home == 1 ? 'checked' : '' }} />
                                            <label for="switch_home" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3"
                                                for="switch_home">{{ trans('home.home') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="menu" id="switch_menu"
                                                switch="success" {{ $service->menu == 1 ? 'checked' : '' }} />
                                            <label for="switch_menu" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3"
                                                for="switch_menu">{{ trans('home.menu') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="meta_robots"
                                                id="switch_meta_robots" switch="success"
                                                {{ $service->meta_robots == 1 ? 'checked' : '' }} />
                                            <label for="switch_meta_robots" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3"
                                                for="switch_meta_robots">{{ trans('home.meta_robots') }}</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary w-md"><i class="image-note"></i>
                                        {{ trans('home.save') }} </button>
                                    <a href="{{ url('/admin/services') }}"><button type="button"
                                            class="btn btn-danger mr-1"><i class="image-trash"></i>
                                            {{ trans('home.cancel') }}</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
    <script type="text/javascript">
        var token = "{{ csrf_token() }}";
        Dropzone.autoDiscover = false;

        $("div.upload_images").dropzone({
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg.webp",
            maxFilesize: 3, // MB
            url: "{{ URL::to('admin/services/uploadImages') }}",

            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("serviceId", "{{ $service->id }}");
                });
            },

            params: {
                _token: token,
                type: 'product_image',
            },

            removedfile: function(file) {
                var fileName = file.name;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/services/removeUploadImages') }}",
                    data: {
                        type: 'service_image',
                        name: fileName,
                        request: 'delete'
                    },
                    success: function(data) { // تم تصحيح "sucess" إلى "success"
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
                    void 0;
            }
        });

        Dropzone.options.myAwesomeDropzone = {
            paramName: "file",
            maxFilesize: 3, // MB
            accept: function(file, done) {
                done();
            }
        };

        $('.delete_img_btn').on('click', function() {
            var image = $(this).data('image');
            var serviceId = "{{ $service->id }}"; // تصحيح المشكلة هنا
            var btn = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('admin/services/deleteImege') }}",
                method: 'POST',
                data: {
                    image: image,
                    serviceId: serviceId
                },
                success: function(data) {
                    location.href = "{{ route('services.edit', $service->id) }}";
                }
            });
        });

        $.ajax({
            url: '/admin/services/deleteImage',
            method: 'POST',
            data: {
                image: 'example.jpg',
                serviceId: 1
            },
            success: function(response) {
                console.log('Image deleted successfully');
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
