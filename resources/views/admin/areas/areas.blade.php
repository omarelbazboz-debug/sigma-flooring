@extends('layouts.admin')
<title>{{trans('home.areas')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.areas')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.areas')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/areas/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
                    <table class="table text-center" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th>{{trans('home.id')}}</th>
                                <th class="wd-20p">{{trans('home.name_en')}}</th>
                                <th class="wd-25p">{{trans('home.name_ar')}}</th>
                                <th class="wd-25p">{{trans('home.region')}}</th>
                                <th>{{__('home.publish/unpublish')}}</th>
                                <th>{{__('home.edit')}}</th>
                                <th>{{__('home.delete')}}
                                    <div class="d-block">
                                        <a type="button" id="btn_delete" class="btn btn-danger waves-effect waves-light" >{{__('home.delete')}}</a>
                                    <div>                                 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($areas as $area)
                                <tr id="{{$area->id}}">
                                    <td> 
                                        @if ($area->id!=1)
                                            <input type="checkbox" name="checkbox"  class="tableChecked" value="{{$area->id}}" />
                                        @endif
                                    </td>
                                    <td><a href="{{ route('areas.edit', $area->id) }}">{{$area->id}}</a></td>
                                    <td>{{$area->name_en}}</td>
                                    <td>{{$area->name_ar}}</td>
                                    <td>{{(app()->getLocale() == 'en')?$area->region->name_en:$area->region->name_ar}}</td>
                                    <td> 
                                        <input class="btn_active" data-id="{{$area->id}}" type="checkbox" id="switch-{{$area->id}}" switch="success" {{$area->status == 1?'checked':''}} />
                                        <label for="switch-{{$area->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-info waves-effect waves-light " 
                                            href="{{ route('areas.edit',$area->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td> 
                                        @if ($area->id!=1)
                                            <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                data-id="{{$area->id}}">{{__('home.delete')}}</a>
                                        @else
                                            <a>-</a>
                                        @endif
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
