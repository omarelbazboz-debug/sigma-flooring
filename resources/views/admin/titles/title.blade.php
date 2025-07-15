@extends('layouts.admin')
<title>{{ trans('home.edit_sectiontitle') }}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ trans('home.edit_sectiontitle') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('home.edit_sectiontitle') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ url('admin/titles/create') }}"><button class="btn ripple btn-primary col-md-2"><i
                    class="fas fa-plus-circle"></i> {{ trans('home.add') }}</button></a>
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
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>{{ trans('home.id') }}</th>
                                        <th>{{ trans('home.title_en') }}</th>
                                        <th>{{ trans('home.title_ar') }}</th>
                                        <th>{{ trans('home.type') }}</th>
                                        <th>{{ trans('home.image') }}</th>
                                        <th>{{ __('home.publish/unpublish') }}</th>
                                        <th>{{ __('home.edit') }}</th>
                                        <th>{{ __('home.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($titles as $title)
                                        <tr id="{{ $title->id }}">
                                            <td><a href="{{ route('titles.edit', $title->id) }}">{{ $title->id }}</a>
                                            </td>
                                            <td><a>{{ $title->title_en }}</a></td>
                                            <td><a>{{ $title->title_ar }}</a></td>
                                            <td><a>{{ __('home.' . $title->type) }}</a></td>
                                            <td>
                                                <a>

                                                    <img src="{{ $title->image }}" width="70">

                                                </a>
                                            </td>
                                            <td>
                                                <input class="btn_active" data-id="{{ $title->id }}" type="checkbox"
                                                    id="switch-{{ $title->id }}" switch="success"
                                                    {{ $title->status == 1 ? 'checked' : '' }} />
                                                <label for="switch-{{ $title->id }}"
                                                    data-on-label="{{ trans('home.yes') }}"
                                                    data-off-label="{{ trans('home.no') }}"></label>
                                            </td>
                                            <td>
                                                <a type="button" class="btn btn-info waves-effect waves-light"
                                                    href="{{ route('titles.edit', $title->id) }}">
                                                    {{ __('home.edit') }} ({{ $title->id }} - {{ $title->type }})
                                                </a>
                                            </td>
                                            <td>
                                                <a type="button" class="btn btn-danger waves-effect waves-light btn_delete"
                                                    data-id="{{ $title->id }}">{{ __('home.delete') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection
