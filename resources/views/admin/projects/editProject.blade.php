@extends('layouts.admin')
@section('meta')
<title>{{ trans('home.edit_product') }}</title>
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
                <h4 class="mb-sm-0 font-size-18">{{ trans('home.projects') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ url('/admin/projects') }}">{{ trans('home.projects') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('home.edit_product') }}</li>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('home.edit_category') }}</h4>
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
                            <form method="POST" action="{{ url('admin/projects/' . $project->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @method('PATCH')


                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label class="">{{ trans('home.name_en') }}</label>
                                        <input class="form-control" name="name_en" type="text"
                                            placeholder="{{ trans('home.name_en') }}" value="{{ $project->name_en }}"
                                            required>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label class="">{{ trans('home.name_ar') }}</label>
                                        <input class="form-control" name="name_ar" type="text"
                                            placeholder="{{ trans('home.name_ar') }}" value="{{ $project->name_ar }}">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="type">{{ trans('home.year') }}</label>
                                        <input class="form-control" name="year" type="text"
                                            placeholder="{{ trans('home.year') }}" value="{{ $project->year }}">
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label class="">{{ trans('home.location') }}</label>
                                        <input class="form-control" name="location" type="text"
                                            placeholder="{{ trans('home.location') }}" value="{{ $project->location }}">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="">{{ trans('home.type') }}</label>
                                        <input class="form-control" name="type" type="text"
                                            placeholder="{{ trans('home.type') }}" value="{{ $project->type }}">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label class="">{{ trans('home.order') }}</label>
                                        <input class="form-control" name="order" type="text"
                                            placeholder="{{ trans('home.order') }}" value="{{ $project->order }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{ trans('home.video_link') }}</label>
                                        <input class="form-control" name="video_link" type="text"
                                            placeholder="{{ trans('home.video_link') }}" value="{{ $project->video_link }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{ trans('home.map_url') }}</label>
                                        <input class="form-control" name="map_url" type="text"
                                            placeholder="{{ trans('home.map_url') }}" value="{{ $project->map_url }}">
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_img"> {{ trans('home.alt_img') }}</label>
                                        <input class="form-control" name="img_alt" type="text"
                                            placeholder="{{ trans('home.alt_img') }}" value="{{ $project->img_alt }}">
                                    </div>

                                    @if ($project->image)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{ $project->image }}"
                                            width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                            width="70">
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.plan') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="photo">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_img"> {{ trans('home.alt_img') }}</label>
                                        <input class="form-control" name="img_alt" type="text"
                                            placeholder="{{ trans('home.alt_img') }}" value="{{ $project->img_alt }}">
                                    </div>

                                    @if ($project->photo)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{ $project->photo }}"
                                            width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                            width="70">
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.location') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="img">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_img"> {{ trans('home.alt_img') }}</label>
                                        <input class="form-control" name="img_alt" type="text"
                                            placeholder="{{ trans('home.alt_img') }}" value="{{ $project->img_alt }}">
                                    </div>

                                    @if ($project->img)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{ $project->img }}"
                                            width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                            width="70">
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.banner') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="banner">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="alt_img"> {{ trans('home.alt_img') }}</label>
                                        <input class="form-control" name="img_alt" type="text"
                                            placeholder="{{ trans('home.alt_img') }}" value="{{ $project->img_alt }}">
                                    </div>

                                    @if ($project->banner)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{ $project->banner }}"
                                            width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                            width="70">
                                    </div>
                                    @endif

                                    <div class="col-md-6 mb-3">
                                        <label for="text_en"> {{ trans('home.text_en') }}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{ trans('home.text_en') }}">{{ $project->text_en }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="text_ar"> {{ trans('home.text_ar') }}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{ trans('home.text_ar') }}">{{ $project->text_ar }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="small_text_en"> {{ trans('home.small_text_en') }}</label>
                                        <textarea class="form-control ckeditor-classic" name="small_text_en" placeholder="{{ trans('home.small_text_en') }}">{{ $project->small_text_en }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="small_text_ar"> {{ trans('home.small_text_ar') }}</label>
                                        <textarea class="form-control ckeditor-classic" name="small_text_ar" placeholder="{{ trans('home.small_text_ar') }}">{{ $project->small_text_ar }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="text2_en"> {{ trans('home.location') }}</label>
                                        <textarea class="form-control ckeditor-classic" name="text2_en" placeholder="{{ trans('home.text2_en') }}">{{ $project->text2_en }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="text2_ar"> {{ trans('home.location') }}</label>
                                        <textarea class="form-control ckeditor-classic" name="text2_ar" placeholder="{{ trans('home.text2_ar') }}">{{ $project->text2_ar }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <label for="images">{{ trans('home.project_images') }}</label>
                                        <div class="dropzone col-md-12 upload_images">
                                        </div>
                                    </div>

                                    @if ($project->images()->count() > 0)
                                    <a href='#' data-id="{{ $project->id }}"
                                        class='delete_all_img btn btn-danger mt-2 col-4'>{{ trans('home.delete_all') }}</a>

                                    <div class="col-md-12 mt-3">
                                        <div id="" class="row mb-0">
                                            @foreach ($project->images() as $key => $image)
                                            <div class="col-xs-6 col-sm-2 col-md-2 col-xl-2 mb-2 pl-sm-2 pr-sm-2"
                                                data-responsive="{{ $image->image_url }}"
                                                data-src="{{ $image->image_url }}"
                                                data-sub-html="<h4> {{ trans('home.image') }} {{ $key + 1 }}</h4>">
                                                <a href="javascript:;">
                                                    <img class="img-responsive"
                                                        src="{{ $image->image_url }}"
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
                                    <!-- Row-->
                                    <div class="row">
                                        <h6 class="card-title mb-1 col-md-10">{{ trans('home.edit_category') }} <span
                                                class="badge badge-warning">{{ trans('home.changing category will change specifications values') }}</span>
                                        </h6>
                                        <a type="button" class="btn col-md-2" data-bs-toggle="modal"
                                            data-bs-target="#Modal1"><i class="fas fa-edit" color="black"></i></a>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <select class="form-control select2" disabled>
                                                        <option value="{{ $project->category_id }}">
                                                            {{ $project->category ? (app()->getLocale() == 'en' ? $project->category->name_en : $project->category->name_ar) : '' }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h6 class="card-title mb-1 col-md-10">
                                            {{ trans('home.edit_service') }}
                                            <span class="badge badge-warning">
                                                {{ trans('home.changing category will change specifications values') }}
                                            </span>
                                        </h6>
                                        <a type="button" class="btn col-md-2" data-bs-toggle="modal" data-bs-target="#Modal2">
                                            <i class="fas fa-edit" style="color: black;"></i>
                                        </a>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <select class="form-control select2" disabled>
                                                        <option value="{{ $project->service ? $project->service->id : '' }}">
                                                            {{ $project->service ? (app()->getLocale() == 'en' ? $project->service->name_en : $project->service->name_ar) : trans('home.no_service_selected') }}
                                                        </option>
                                                    </select>
                                                    <input type="hidden" name="service_id" value="{{ $project->service ? $project->service->id : '' }}">
                                                </div>
                                            </div>
                                        </div>
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
                                                                {{ isset($project) && $project->features->contains($feature->id) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="feature_{{ $feature->id }}">
                                                                {{ app()->getLocale() == 'ar' ? $feature->name_ar : $feature->name_en }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    <!-- End Row -->
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{ trans('home.seo_block') }}</h4>
                                        <span class="badge-soft-primary">{{ trans('home.en') }}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_en">{{ trans('home.slug') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.slug') }}" name="link_en"
                                            value="{{ $project->link_en }}">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{ trans('home.meta_title') }}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{ trans('home.meta_title') }}">{{ $project->meta_title_en }}</textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{ trans('home.meta_desc') }}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{ trans('home.meta_desc') }}">{{ $project->meta_desc_en }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge-soft-primary">{{ trans('home.ar') }}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_ar">{{ trans('home.slug') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.slug') }}" name="link_ar"
                                            value="{{ $project->link_ar }}">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{ trans('home.meta_title') }}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{{ trans('home.meta_title') }}">{{ $project->meta_title_ar }}</textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{ trans('home.meta_desc') }}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{{ trans('home.meta_desc') }}">{{ $project->meta_desc_ar }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch"
                                                switch="success" {{ $project->status == 1 ? 'checked' : '' }} />
                                            <label for="switch" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch">
                                                {{ trans('home.publish') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="recommended" id="switch1"
                                                switch="success" {{ $project->recommended == 1 ? 'checked' : '' }} />
                                            <label for="switch1" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch1">
                                                {{ trans('home.recommended') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="meta_robots" id="switch3"
                                                switch="success" {{ $project->meta_robots == 1 ? 'checked' : '' }} />
                                            <label for="switch3" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch3">
                                                {{ trans('home.meta_robots') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{ trans('home.save') }}</button>
                                    <a href="{{ url('/admin/projects') }}"><button type="button"
                                            class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                            {{ trans('home.cancel') }}</button></a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- modal1 -->
    <div class="modal fade text-left" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h3 class="modal-title" id="myModalLabel34">{{ trans('home.edit_category') }}</h3>
                    <a type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                        X
                    </a>
                </div>
                <form action="{{ url('admin/projects/changeCategory/' . $project->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <select class="form-control" data-trigger name="category_id" id="category" required>
                                    <option></option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $project->category_id == $category->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'en' ? $category->name_en : $category->name_ar }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary w-md"> {{ trans('home.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--=======================Model 2 -----=============================-->
    <div class="modal fade text-left" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h3 class="modal-title" id="myModalLabel34">{{ trans('home.service') }}</h3>
                    <a type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                        X
                    </a>
                </div>
                <form action="{{ url('admin/projects/changeService/' . $project->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <select class="form-control" name="service_id" id="service" required>
                                    <option></option>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ $project->service_id == $service->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'en' ? $service->name_en : $service->name_ar }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary w-md">
                                    {{ trans('home.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--=======================Model 2 -----=============================-->

</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

<script type="text/javascript">
    var token = "{{ csrf_token() }}";
    // تعطيل اكتشاف Dropzone التلقائي
    Dropzone.autoDiscover = false;

    $("div.upload_images").dropzone({
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
        url: "{{ URL::to('admin/projects/uploadImages') }}",

        init: function() {
            this.on("sending", function(file, xhr, formData) {
                formData.append("projectId", "{{ $project->id }}");
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
                url: "{{ URL::to('admin/projects/removeUploadImages') }}",
                data: {
                    type: 'project_image',
                    name: fileName,
                    request: 'delete'
                },
                success: function(data) {
                    console.log('success: ' + data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    });

    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", 
        maxFilesize: 5, 
        accept: function(file, done) {
            done(); 
        },
    };

    $('.delete_img_btn').on('click', function() {
        var image = $(this).data('image');
        var projectId = "{{ $project->id }}";
        var btn = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('admin/projects/deleteImege') }}",
            method: 'POST',
            data: {
                image: image,
                projectId: projectId
            },
            success: function(data) {
                location.href = "{{ route('projects.edit', $project->id) }}";
            }
        });
    });
</script>

@endsection