@extends('layouts.admin')
<title>{{ trans('home.services') }}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ trans('home.services') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('home.services') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ url('admin/services/create') }}"><button class="btn ripple btn-primary col-md-2"><i
                    class="fas fa-plus-circle"></i> {{ trans('home.add') }}</button></a>
        <a href="javascript:void(0)"><button class="copyButton btn ripple btn-info col-md-2"><i class="bx bx-copy-alt"></i>
                {{ trans('home.copy') }}</button></a>
        <!-- End Page Header -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        <div id="successmesg" style="display: none; margin-bottom: 10px;"
            class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div id="successmesg" style="display: none; margin-bottom: 10px;"
            class="alert alert-danger alert-dismissible fade show" role="alert">
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
                                <th><input type="checkbox" class="form-check-input" id="checkAll" /></th>
                                <th>{{ trans('home.id') }}</th>
                                <th>{{ trans('home.name_en') }}</th>
                                <th>{{ trans('home.name_ar') }}</th>
                                <th>{{ trans('home.order') }}</th>
                                <th>{{ trans('Parent Name') }}</th>
                                <th>{{ trans('album_for') }}</th>

                                <th>{{ trans('home.image') }}</th>
                                <th>{{ __('home.publish/unpublish') }}</th>
                                <th>{{ __('home.edit') }}</th>
                                <th>{{ __('home.delete') }}
                                    <div class="d-block">
                                        <a type="button" id="btn_delete"
                                            class="btn btn-danger waves-effect waves-light">{{ __('home.delete') }}</a>
                                        <div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr id="{{ $service->id }}">
                                    <td><input type="checkbox" name="checkbox" class="tableChecked form-check-input"
                                            value="{{ $service->id }}" /></td>
                                    <td><a href="{{ route('services.edit', $service->id) }}">{{ $service->id }}</a></td>
                                    <td><a>{{ $service->name_en }}</a></td>
                                    <td><a>{{ $service->name_ar }}</a></td>
                                    <td><a>{{ $service->order }}</a></td>
                                    <td><a>{{ $service->parent?->name ?? __('home.no_parent') }}</a> </td>
                                   
                                    <td><a>{{ $service->albumForService?->name  ?? __('home.not_album') }}</a> </td>
                                    <td>
                                        @if ($service->img)
                                            <img src="{{ $service->img }}"
                                                width="70">
                                        @else
                                            <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                                width="70">
                                        @endif
                                    </td>
                                    <td>
                                        <input class="btn_active" data-id="{{ $service->id }}" type="checkbox"
                                            id="switch-{{ $service->id }}" switch="success"
                                            {{ $service->status == 1 ? 'checked' : '' }} />
                                        <label for="switch-{{ $service->id }}" data-on-label="{{ trans('home.yes') }}"
                                            data-off-label="{{ trans('home.no') }}"></label>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-info waves-effect waves-light"
                                            href="{{ route('services.edit', $service->id) }}">{{ __('home.edit') }}</a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete"
                                            data-id="{{ $service->id }}">{{ __('home.delete') }}</a>
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
        $(document).on('click', '.copyButton', function() {
            var ids = [];
            $('.tableChecked:checked').each(function(i) {
                ids[i] = $(this).val();
            });
            if (ids.length === 0) //tell you if the array is empty
            {
                alert("Please Select atleast one checkbox");
            } else {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?php echo route('servicesCopy'); ?>",
                    type: 'POST',
                    data: {
                        ids: ids
                    },
                    success: function(data) {
                        // console.log(data);
                        location.reload();
                    }
                });
            }

        });
    </script>
@endsection
