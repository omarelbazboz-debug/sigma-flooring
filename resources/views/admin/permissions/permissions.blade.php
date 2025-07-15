@extends('layouts.admin')
<title>{{trans('home.permissions')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.permissions')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.permissions')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/permissions/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
        <!-- End Page Header -->


        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container-fluid">
            <!-- Row-->
            <div class="row">
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>{{trans('home.id')}}</th>
                                    <th>{{trans('home.permission_name')}}</th>
                                    <th>{{__('home.edit')}}</th>
                                    <th>{{__('home.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr id="{{$permission->id}}">
                                        <td><a href="{{ route('permissions.edit', $permission->id) }}">{{$permission->id}}</a></td>
                                        <td><a href="{{ route('permissions.edit', $permission->id) }}">{{$permission->name}}</a></td>
                                        <td> 
                                            <a type="button" class="btn btn-info waves-effect waves-light " 
                                                href="{{ route('permissions.edit',$permission->id) }}" >{{__('home.edit')}}</a>
                                        </td>
                                        <td> 
                                            <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                data-id="{{$permission->id}}">{{__('home.delete')}}</a>
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
@endsection
