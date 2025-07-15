@extends('layouts.admin')
<title>{{trans('home.beforeAfters')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.beforeAfters')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.beforeAfters')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/beforeAfters/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add-single')}}</button></a>
        <!-- End Page Header -->

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div id="successmesg"  style="display: none; margin-bottom: 10px;"  class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- Row-->
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="checkAll"/></th>
                                <th>{{trans('home.id')}}</th>
                                <th>{{trans('home.image')}}</th>
                                <th>{{trans('home.order')}}</th>
                                <th>{{__('home.publish/unpublish')}}</th>
                                <th>{{__('home.edit')}}</th>
                                <th>{{__('home.delete')}}
                                    <div class="d-block">
                                        <a type="button" id="btn_delete" class="btn btn-danger waves-effect waves-light" >{{__('home.delete')}}</a>
                                    <div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="sortable">
                            @foreach($beforeAfters as $beforeAfter)
                                <tr id="{{$beforeAfter->id}}" data-id="{{ $beforeAfter->id }}"  class="image">
                                    <td> <input type="checkbox" name="checkbox"  class="tableChecked form-check-input" value="{{$beforeAfter->id}}" /> </td>
                                    <td><a href="{{ route('beforeAfters.edit', $beforeAfter->id) }}">{{$beforeAfter->id}}</a></td>
                                    <td>
                                        <a href="{{ route('beforeAfters.edit', $beforeAfter->id) }}">
                                            @if($beforeAfter->after_img)
                                                <img src="{{asset('uploads/beforeAfters/source/'.$beforeAfter->after_img)}}" width="150">
                                            @else
                                                <img src="{{asset('assets/back/images/noimage.jpg')}}" width="150">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="order">{{$beforeAfter->order}}</td>
                                    <td>
                                        <input class="btn_active" data-id="{{$beforeAfter->id}}" type="checkbox" id="switch-{{$beforeAfter->id}}" switch="success" {{$beforeAfter->status == 1?'checked':''}} />
                                        <label for="switch-{{$beforeAfter->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-info waves-effect waves-light "
                                            href="{{ route('beforeAfters.edit',$beforeAfter->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete"
                                            data-id="{{$beforeAfter->id}}">{{__('home.delete')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
        <!-- End Row -->
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        var $images = $('.sortable');

        $images.sortable({
            connectWith: '.sortable',
            items: 'tr.image',
            stop: function (event, ui) {
                var $parent = $(ui.item).parent();
                sendReorderImagesRequest($parent);

                if ($(event.target).data('id') !== $parent.data('id')) {
                    if ($(event.target).find('tr.image').length) {
                        sendReorderImagesRequest($(event.target));
                    } else {
                        $(event.target).find('.empty-message').show();
                    }
                }
            }
        });

        // تعطيل تحديد النص داخل الـ <tr> أثناء السحب
        $(".sortable tr.image").on("selectstart", function (event) {
            event.preventDefault();
        });
    });

    ////// إرسال طلب إعادة الترتيب //////////////
    function sendReorderImagesRequest($image) {
        var items = $image.sortable('toArray', { attribute: 'data-id' });
        var ids = items.filter(item => item !== ""); // التأكد من عدم إرسال قيم فارغة
        var _token = $('meta[name="csrf-token"]').attr('content');

        if ($image.find('tr.image').length) {
            $image.find('.empty-message').hide();
        }

        $.ajax({
            url: '{{ url('admin/beforeAfters/reorder') }}',
            type: 'POST',
            data: {
                _token: _token,
                ids: ids
            },
            success: function (response) {
                $image.children('tr.image').each(function (index, image) {
                    var id = $(image).data('id');
                    if (response.positions && response.positions[id]) {
                        $(image).children('.order').text(response.positions[id]);
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                alert('حدث خطأ أثناء إعادة ترتيب الصور. يرجى المحاولة مرة أخرى.');
            }
        });
    }
</script>

@endsection
