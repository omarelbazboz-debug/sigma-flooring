@extends('layouts.admin')
<title>{{trans('home.edit_album')}}</title>
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
                            <form method="POST" action="{{ url('admin/albums/'.$album->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>{{ trans('home.name_en') }}</label>
                                        <input class="form-control" name="name_en" type="text" placeholder="{{ trans('home.name_en') }}" value="{{ $album->name_en }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ trans('home.name_ar') }}</label>
                                        <input class="form-control" name="name_ar" type="text" placeholder="{{ trans('home.name_ar') }}" value="{{ $album->name_ar }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ trans('home.text_en') }}</label>
                                        <input class="form-control" name="text_en" type="text" placeholder="{{ trans('home.text_en') }}" value="{{ $album->text_en }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ trans('home.text_ar') }}</label>
                                        <input class="form-control" name="text_ar" type="text" placeholder="{{ trans('home.text_ar') }}" value="{{ $album->text_ar }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="formFile">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>

                                    @if($album->image)
                                    <div class="col-md-2 mt-3">
                                        <img src="{{ asset('uploads/album_items/source/'.$album->image) }}" width="200" height="150" alt="Album Image">
                                    </div>
                                    @else
                                    <div class="col-md-3 mt-3">
                                        <img src="{{ asset('resources/assets/back/images/noimage.jpg') }}" width="70" alt="No Image">
                                    </div>
                                    @endif

                                    <div class="col-md-12 mb-3">
                                        <a href="javascript:void(0);" class="add_button btn btn-danger mr-1 col-md-1" title="Add field">
                                            <i class="fas fa-plus-square"></i>
                                        </a>

                                        @if(isset($album->images) && count($album->images) > 0)
                                        <div class="row mt-3">
                                            @foreach($album->images as $image)
                                            <div class="col-md-6 mb-3">
                                                <label>{{ trans('home.Link_Video') }}</label>
                                                <input class="form-control" name="video_link[]" type="text" placeholder="{{ trans('home.Link_Video') }}" value="{{ $image->name }}">
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" {{ $album->status ? 'checked' : '' }} />
                                            <label for="switch" data-on-label="{{ trans('home.yes') }}" data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch">{{ trans('home.publish') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{ trans('home.save') }}</button>
                                    <a href="{{ url('/admin/albums') }}" class="btn btn-danger"><i class="icon-trash"></i> {{ trans('home.cancel') }}</a>
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
<script>
    $(document).ready(function() {
        var maxField = 100; // الحد الأقصى لعدد الحقول
        var addButton = $('.add_button'); // زر الإضافة
        var wrapper = $('.field_wrapper'); // حاوية الحقول
        var fieldHTML = `
            <div class="row col-4">
                <div class="col-md-10 mb-3">
                    <label for="video_link">{{ trans('home.Link_Video') }}</label>
                    <input type="text" class="form-control" placeholder="{{ trans('home.Link_Video') }}" name="video_link[]">
                </div>
                <div class="form-group col-md-2">
                    <a href="javascript:void(0);" class="remove_button btn btn-danger" style="margin-top: 30px;">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </div>`;

        var x = 1; // عداد الحقول الافتراضي

        // عند الضغط على زر الإضافة
        $(addButton).click(function() {
            if (x < maxField) {
                x++; // زيادة العداد
                $(wrapper).append(fieldHTML); // إضافة الحقل
            }
        });

        // عند الضغط على زر الحذف
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.row').remove(); // حذف الحقل
            x--; // تقليل العداد
        });
    });
</script>


@endsection