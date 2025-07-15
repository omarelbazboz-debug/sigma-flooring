@extends('layouts.admin')
<title>{{trans('home.users')}}</title>
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.users')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.users')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/users/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
                    <div class="table-rep-plugin">
                        <div class="mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"/></th>
                                        <th>{{trans('home.id')}}</th>
                                        <th>{{trans('home.image')}}</th>
                                        <th>{{trans('home.name')}}</th>
                                        <th>{{trans('home.email')}}</th>
                                        <th>{{trans('home.phone')}}</th>
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
                                    @foreach($users as $user)
                                        <tr id="{{$user->id}}">
                                            <td> 
                                                @if ($user->id!=1)
                                                    <input type="checkbox" name="checkbox"  class="tableChecked" value="{{$user->id}}"/>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('users.edit', $user->id) }}">{{$user->id}}</a></td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}">
                                                    @if($user->image)
                                                        <img src="{{url('\uploads\users\resize200')}}\{{$user->image}}" width="50" height="50">
                                                    @else
                                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="50" height="50">
                                                    @endif
                                                </a>
                                            </td>
                                            <td><a href="{{ route('users.edit', $user->id) }}">{{$user->f_name.' '.$user->l_name}}</a></td>
                                            <td><a href="{{ route('users.edit', $user->id) }}">{{$user->email}}</a></td>
                                            <td><a href="{{ route('users.edit', $user->id) }}">{{$user->phone}}</a></td>
                                            <td><a href="{{ route('users.edit', $user->id) }}">{{trans("home.$user->status")}}</a></td>                                        
                                            <td> 
                                                <a type="button" class="btn btn-info waves-effect waves-light " 
                                                    href="{{ route('users.edit',$user->id) }}" >{{__('home.edit')}}</a>
                                            </td>
                                            <td> 
                                                @if ($user->id!=1)
                                                    <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                        data-id="{{$user->id}}">{{__('home.delete')}}</a>
                                                @endif
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