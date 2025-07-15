@extends('layouts.admin')
@section('meta')
<title>{{trans('home.edit_attribute')}}</title>
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
                        <li class="breadcrumb-item active">{{trans('home.edit_attribute')}}</li>
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
                            <form method="POST" action="{{ url('admin/attributes/' . $attribute->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @method('PATCH')
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
                                                <div class="card-body tab-content">
                                                    <div class="tab-pane active show" id="attribute">
                                                        <div class="row">

                                                            <div class="col-md-6 mb-3">
                                                                <label class="">{{trans('home.name_en')}}</label>
                                                                <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" value="{{$attribute->name_en}}" required>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="">{{trans('home.name_ar')}}</label>
                                                                <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" value="{{$attribute->name_ar}}">
                                                            </div>
                                                            <div class="col-md-8 mb-3">
                                                                <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                                                <input class="form-control" type="file" id="formFile" name="icon">
                                                            </div>

                                                            @if($attribute->icon)
                                                            <div class="form-group  col-md-2 m-2 mt-3">
                                                                <img src="{{url('\uploads\attribute\resize200')}}\{{$attribute->icon}}" width="200" height="150">
                                                            </div>
                                                            @else
                                                            <div class="form-group  col-md-3 mt-3">
                                                                <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                                            </div>
                                                            @endif

                                                            <div class="form-group col-md-12">
                                                                <label for="category">{{trans('home.categories')}}</label>
                                                                <div class="categories">
                                                                    <select class="form-control choices-multiple-remove-button" name="category_id[]" multiple>
                                                                        @foreach($categories as $categ)
                                                                        <option value="{{$categ->id}}" @foreach($categories_ids as $id)@if($categ->id == $id )selected @endif @endforeach>{{(app()->getLocale()=='en')? $categ->name_en:$categ->name_ar}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group col-md-4 m-4 mb-0">
                                                            <input type="checkbox" name="all_categories" value="1" class="form-check-input form-check-input" id="checkbox">
                                                            <label for="checkbox">{{trans('home.selectall')}}</label>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="values">
                                                        @foreach($values as $key=>$value)
                                                        <div class="row">
                                                            <div class="col-md-5 mb-3">
                                                                <label for="value_en">{{trans('home.value_en')}}</label>
                                                                <input type="text" class="form-control" placeholder="{{trans('home.value_en')}}" value="{{$value->value_en}}" readonly>
                                                            </div>

                                                            <div class="col-md-5 mb-3">
                                                                <label for="value_ar">{{trans('home.value_ar')}}</label>
                                                                <input type="text" class="form-control" placeholder="{{trans('home.value_ar')}}" value="{{$value->value_ar}}" readonly>
                                                            </div>

                                                            <div class="col-md-2 mb-3">
                                                                <button type="button" style="margin-top: 28px;" class="btn" data-bs-toggle="modal" data-bs-target="#iconForm_{{$key}}"><i class="fas fa-edit"></i></button>
                                                                <button type="button" style="margin-top: 28px;" class="btn rmv" data-value_id="{{$value->id}}" id="type-error"><i class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                        <div class="field_wrapper">
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="value_en">{{trans('home.value_en')}}</label>
                                                                    <input type="text" class="form-control" placeholder="{{trans('home.value_en')}}" name="value_en[]">
                                                                </div>

                                                                <div class="form-group col-md-6">
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
                                <!-- End Row -->
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

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach($values as $key=>$value)
    <div class="modal fade text-left" id="iconForm_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel34">{{trans('home.edit_attribute_value')}}</h3>
                    <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        X
                    </a>
                </div>
                <form action="{{route('updateAttributeValue')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="value_en">{{trans('home.value_en')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('home.value_en')}}" name="value_en" value="{{$value->value_en}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="value_ar">{{trans('home.value_ar')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('home.value_ar')}}" name="value_ar" value="{{$value->value_ar}}">
                            </div>

                            <input type="hidden" name="value_id" value="{{$value->id}}" />

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
        var fieldHTML = '<div class="row mt-4"><hr><div class="col-md-5 mb-3">' +
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

    // حذف قيمة
    $(document).ready(function() {
        $('.rmv').click(function() {
            var value_id = $(this).data('value_id');
            console.log(value_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('removeAttributeValue', app()->getLocale()) }}",
                method: 'POST',
                data: {
                    value_id: value_id
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    });
</script>

@endsection