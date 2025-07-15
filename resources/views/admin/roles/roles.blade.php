@extends('layouts.admin')
<title>{{trans('home.roles')}}</title>
@section('content')
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.roles')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.roles')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/roles/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
        <!-- End Page Header -->


        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div id="successmesg"  style="display: none; margin-bottom: 10px;"  class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="container-fluid">
            <!-- Row-->
            <div class="row">
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <div class="card-body">
                        <table class="table text-center" id="exportexample">
                            <thead>
                                <tr>
                                    <th>{{trans('home.id')}}</th>
                                    <th>{{trans('home.role_name')}}</th>
                                    <th>{{__('home.edit')}}</th>
                                    <th>{{__('home.delete')}}
                                        <div class="d-block">
                                            <a type="button" id="btn_delete" class="btn btn-danger waves-effect waves-light" >{{__('home.delete')}}</a>
                                        <div>                                 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr id="{{$role->id}}">
                                        <td><a href="{{ route('roles.edit', $role->id) }}">{{$role->id}}</a></td>
                                        <td><a href="{{ route('roles.edit', $role->id) }}">{{$role->name}}</a></td>
                                        <td> 
                                            <a type="button" class="btn btn-info waves-effect waves-light " 
                                                href="{{ route('roles.edit',$role->id) }}" >{{__('home.edit')}}</a>
                                        </td>
                                        <td> 
                                            @if ($role->id!=1)
                                                <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                    data-id="{{$role->id}}">{{__('home.delete')}}</a>
                                            @else
                                                <a class="m-auto">-</a>
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
    </div>
@endsection