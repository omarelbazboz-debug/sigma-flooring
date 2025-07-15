@extends('layouts.admin')
<title>{{trans('home.head_headers')}}</title>
@section('content')
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.head_headers')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.head_headers')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/dates/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>{{trans('home.id')}}</th>
                                        <th>{{trans('home.title_en')}}</th>
                                        <th>{{trans('home.title_ar')}}</th>
                                        <th>{{trans('home.number')}}</th>
                                        <th>{{trans('home.order')}}</th>
                                        <th>{{__('home.publish/unpublish')}}</th>
                                        <th>{{__('home.edit')}}</th>
                                        <th>{{__('home.delete')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dates as $date)
                                        <tr id="{{$date->id}}">
                                            <td><a href="{{ route('dates.edit', $date->id) }}">{{$date->id}}</a></td>
                                            <td><a>{{$date->title_en}}</a></td>
                                            <td><a>{{$date->title_ar}}</a></td>
                                            <td><a>{{$date->number}}</a></td>
                                            <td><a>{{$date->order}}</a></td>
                                            <td> 
                                                <input class="btn_active" data-id="{{$date->id}}" type="checkbox" id="switch-{{$date->id}}" switch="success" {{$date->status == 1?'checked':''}} />
                                                    <label for="switch-{{$date->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            </td>
                                            <td> 
                                                <a type="button" class="btn btn-info waves-effect waves-light " 
                                                    href="{{ route('dates.edit',$date->id) }}" >{{__('home.edit')}}</a>
                                            </td>
                                            <td> 
                                                <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                    data-id="{{$date->id}}">{{__('home.delete')}}</a>
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
