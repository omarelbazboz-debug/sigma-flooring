@extends('layouts.admin')
<title>{{trans('home.faq')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.faq')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.faq')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <form method="POST" action="{{ route('faqs.store') }}" enctype="multipart/form-data" data-toggle="validator">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="field_wrapper">
                                    <div class="row">
                                        @if(count($questions) > 0)
                                        @foreach($questions as $key=>$question)
                                        <div class="col-md-5 mb-3">
                                            <label for="question">{{trans('home.question')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.question')}}" readonly value="{{$question->question}}">
                                        </div>

                                        <div class="col-md-5 mb-3">
                                            <label for="answer">{{trans('home.answer')}}</label>
                                            <textarea class="form-control" placeholder="{{trans('home.answer')}}" readonly>{{$question->answer}}</textarea>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <button type="button" style="margin-top: 28px;" class="btn" data-bs-toggle="modal" data-bs-target="#iconForm_{{$key}}"><i class="fas fa-edit"></i></button>
                                            <button type="button" style="margin-top: 28px;" class="btn rmv" data-faq_id="{{$question->id}}" id="type-error"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="form-group col-md-6">
                                            <label for="question">{{trans('home.question')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.question')}}" name="question[]">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="answer">{{trans('home.answer')}}</label>
                                            <textarea class="form-control" placeholder="{{trans('home.answer')}}" name="answer[]"></textarea>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="add_button btn mb-5" title="Add field"><i class="fas fa-plus-square"></i></a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                            <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                        </div>

                        </form>
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
                    <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <h5 class="modal-title" id="myModalLabel34">X</h5>
                    </a>
                </div>
                <form action="{{route('updateFaq')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="question">{{trans('home.question')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('home.question')}}" name="question" value="{{$question->question}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="answer">{{trans('home.answer')}}</label>
                                <textarea type="text" class="form-control" placeholder="{{trans('home.answer')}}" name="answer">{{$question->answer}}</textarea>
                            </div>

                            <input type="hidden" name="faq_id" value="{{$question->id}}" />

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}} </button>
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
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 100; // الحد الأقصى لعدد الحقول
        var addButton = $('.add_button'); // محدد زر الإضافة
        var wrapper = $('.field_wrapper'); // لف الحقول
        var fieldHTML = '<div class="row">' +
                        '<div class="col-md-5 mb-3">' +
                        '<label for="question">{{ trans("home.question") }}</label>' +
                        '<input type="text" class="form-control" placeholder="{{ trans("home.question") }}" name="question[]">' +
                        '</div>';
        fieldHTML += '<div class="col-md-5 mb-3">' +
                     '<label for="answer">{{ trans("home.answer") }}</label>' +
                     '<textarea class="form-control" placeholder="{{ trans("home.answer") }}" name="answer[]"></textarea>' +
                     '</div>';
        fieldHTML += '<div class="form-group col-md-2">' +
                     '<a href="javascript:void(0);" style="margin-top: 30px;" class="remove_button btn"><i class="fas fa-trash-alt"></i></a>' +
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

    $(document).ready(function() {
        $('.rmv').click(function() {
            var faq_id = $(this).data('faq_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('removeFaq') }}",
                method: 'POST',
                data: {
                    faq_id: faq_id
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    });
</script>
@endsection