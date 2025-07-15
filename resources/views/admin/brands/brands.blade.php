@extends('layouts.admin')
<title>{{trans('home.companies')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.clients')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.companies')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/brands/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="checkAll"/></th>
                                <th>{{trans('home.id')}}</th>
                                <th class="wd-20p">{{trans('home.order')}}</th>
                                <th class="wd-20p">{{trans('home.image')}}</th>
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
                            @foreach($brands as $brand)
                                <tr id="{{$brand->id}}">
                                    <td> <input type="checkbox" name="checkbox"  class="tableChecked form-check-input" value="{{$brand->id}}"/> </td>
                                    <td><a href="{{ route('brands.edit', $brand->id) }}">{{$brand->id}}</a></td>
                                    <td>{{$brand->order}}</td>
                                    <td>
                                        
                                            @if($brand->logo)
                                                <img src="{{url('/uploads/brands/source')}}/{{$brand->logo}}" width="70">
                                            @else
                                                <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                            @endif
                                    </td>
                                    <td> 
                                        <input class="btn_active" data-id="{{$brand->id}}" type="checkbox" id="switch-{{$brand->id}}" switch="success" {{$brand->status == 1?'checked':''}} />
                                        <label for="switch-{{$brand->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-info waves-effect waves-light " 
                                            href="{{ route('brands.edit',$brand->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                            data-id="{{$brand->id}}">{{__('home.delete')}}</a>
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
