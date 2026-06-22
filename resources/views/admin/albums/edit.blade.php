@extends('layouts.admin')
@section('meta')
<title>{{trans('home.edit')}}</title>
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
                <h4 class="mb-sm-0 font-size-18">{{trans('home.albums')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/albums')}}">{{trans('home.albums')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit')}}</li>
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
                    <h4 class="card-title">{{trans('home.edit')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ url('admin/albums/' . $album->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @method('PATCH')

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label class="">{{trans('home.name_en')}}</label>
                                        <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" value="{{$album->name_en}}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="">{{trans('home.name_ar')}}</label>
                                        <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" value="{{$album->name_ar}}" required>
                                    </div>
              
                                    <div class="col-md-4 mb-3">
                                        <label for="parent">{{trans('home.parent')}}</label>
                                        <select class="form-control" data-trigger name="parent_id" style="position: relative; z-index: 10000000;">
                                            <option value="0">{{trans('home.no_parent')}}</option>
                                            @foreach($albums as $albumitem)
                                            <option value="{{$albumitem->id}}" {{($albumitem->id == $album->parent_id)?'selected':''}}>{{(app()->getLocale()=='en')? $albumitem->name_en:$albumitem->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>
                                    @if($album->image)
                                    <div class="form-group  col-md-2 m-2 mt-3">
                                        <img src="{{$album->image}}" width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-3 mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en"  placeholder="{{trans('home.text_en')}}" >{{$album->text_en}}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="">{{trans('home.text_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar"  placeholder="{{trans('home.text_ar')}}" >{{$album->text_ar}}</textarea>
                                    </div>
                                  

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <label for="images">{{trans('home.images')}}</label>
                                        <div class="dropzone col-md-12 upload_images">
                                        </div>
                                    </div>
                                    @if(isset($album->images))
                                    @foreach($album->images as $image)
                                    <div class="form-group col-md-4 mt-2">
                                        <img src="{{asset('uploads/album_items/source/'.$image->name)}}" width="150px" height="150px" />
                                        <a href='#' data-image='{{$image->id}}' class='btn btn-danger m-2 delete_img_btn px-5'>{{trans('home.delete')}}</a>
                                    </div>

                                    @endforeach
                                    <div class="d-flex justify-content-end">
                                        <a href='#' data-id="{{$album->id}}" class='delete_all_img btn btn-danger mt-2 col-2'>{{trans('home.delete_all')}}</a>
                                    </div>
                                    @endif


                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" {{$album->status?'checked':''}} />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{trans('home.seo_block')}}</h4>
                                        <span class="badge-soft-primary">{{trans('home.en')}}</span>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="link_en">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en" value="{{$album->link_en}}">
                                    </div>



                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge-soft-primary">{{trans('home.ar')}}</span>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="link_ar">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar" value="{{$album->link_ar}}">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/albums')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

<script type="text/javascript">
    var token = "{{ csrf_token() }}";
    Dropzone.autoDiscover = false;

    $("div.upload_images").dropzone({
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
        url: "{{ URL::to('admin/album-images/uploadImages') }}",

        init: function() {
            this.on("sending", function(file, xhr, formData) {
                // يمكنك إضافة معلمات إضافية هنا إذا كان ضروريًا
            });
        },

        params: {
            _token: token,
            type: 'gallery_image',
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
                url: "{{ URL::to('admin/album-images/removeUploadImages') }}",
                data: {
                    type: 'gallery_image',
                    name: fileName,
                    request: 'delete'
                },
                success: function(data) {
                    console.log('success: ' + data);
                },
                error: function(error) {
                    console.log('Error occurred: ' + error);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    });

    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // اسم الحقل الذي سيتم نقل الملف من خلاله
        maxFilesize: 10, // الحد الأقصى للحجم بالميغابايت
        accept: function(file, done) {
            // يمكن إضافة تحقق إضافي هنا إذا كان ضروريا
        },
    };

    $('.delete_img_btn').on('click', function() {
        var image = $(this).data('image');
        var albumId = "{{ $album->id }}"; // تأكد من أن هذه القيمة مضمنة بشكل صحيح في جافا سكربت
        var btn = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('admin/album-images/deleteImage') }}",
            method: 'POST',
            data: {
                image: image,
                albumId: albumId
            },
            success: function(data) {
                location.href = "{{ route('albums.edit', $album->id) }}";
            },
            error: function(error) {
                console.log('Error occurred: ' + error);
            }
        });
    });
</script>


@endsection
