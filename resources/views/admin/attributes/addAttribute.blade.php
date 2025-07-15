@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_attribute')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.attributes')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/attributes')}}">{{trans('home.attributes')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_attribute')}}</li>
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
                            <form method="POST" action="{{ route('attributes.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf


                                <!-- Row-->
                                <div class="row">
                                    <div class="col-sm-12 col-xl-12 col-lg-12">
                                        <div class="chat-leftsidebar">
                                            <div class="chat-leftsidebar-nav">
                                                <ul class="nav nav-pills nav-justified bg-soft-light p-1">
                                                    <li class="nav-item">
                                                        <a href="#attribute" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                                            <span class="d-none d-sm-block">{{trans('home.attribute')}}</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#values" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                            <i class="bx bx-group font-size-20 d-sm-none"></i>
                                                            <span class="d-none d-sm-block">{{trans('home.values')}}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content mt-2">
                                                    <div class="tab-pane active show" id="attribute">
                                                        <div class="row ">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="">{{trans('home.name_en')}}</label>
                                                                <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" required>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="">{{trans('home.name_ar')}}</label>
                                                                <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}">
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                                                <input class="form-control" type="file" id="formFile" name="icon">
                                                            </div>

                                                            <div class="form-group col-md-8 ">
                                                                <label for="category">{{trans('home.categories')}}</label>
                                                                <div class="categories">
                                                                    <select class="form-control choices-multiple-remove-button " name="category_id[]" multiple>
                                                                        @foreach($categories as $categ)
                                                                        <option value="{{$categ->id}}">{{(app()->getLocale()=='en')? $categ->name_en:$categ->name_ar}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group col-md-4 m-4 mb-0">
                                                            <input type="checkbox" name="all_categories" value="1" class="form-check-input form-check-input" id="checkbox"> {{trans('home.selectall')}}
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="values">
                                                        <div class="field_wrapper">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="value_en">{{trans('home.value_en')}}</label>
                                                                    <input type="text" class="form-control" placeholder="{{trans('home.value_en')}}" name="value_en[]">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="value_ar">{{trans('home.value_ar')}}</label>
                                                                    <input type="text" class="form-control" placeholder="{{trans('home.value_ar')}}" name="value_ar[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="javascript:void(0);" class="add_button btn" title="Add field"><i class="fas fa-plus-square"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" checked />
                                            <label for="switch" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            <label class="form-check-label mx-3" for="switch"> {{trans('home.publish')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/attributes')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
    // عند تغيير حالة checkbox
    $("#checkbox").click(function() {
        if ($("#checkbox").is(':checked')) {
            $(".categories").addClass("d-none");
        } else {
            $(".categories").removeClass("d-none");
        }
    });

    $(document).ready(function() {
        var maxField = 100; // الحد الأقصى لعدد الحقول
        var addButton = $('.add_button'); // محدد زر الإضافة
        var wrapper = $('.field_wrapper'); // لف الحقول
        var fieldHTML = '<div class="row mb-2"><hr><div class="col-md-5 mb-3">' +
                        '<label for="value_en">{{ trans("home.value_en") }}</label>' +
                        '<input type="text" class="form-control" placeholder="{{ trans("home.value_en") }}" name="value_en[]"></div>';
        fieldHTML += '<div class="col-md-5 mb-3">' +
                     '<label for="value_ar">{{ trans("home.value_ar") }}</label>' +
                     '<input type="text" class="form-control" placeholder="{{ trans("home.value_ar") }}" name="value_ar[]"></div>';
        fieldHTML += '<div class="form-group col-md-2">' +
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

            // تفعيل select2 بعد إضافة الحقل
            $('.status').select2({
                'placeholder': 'Status',
            });
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