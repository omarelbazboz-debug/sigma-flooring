@extends('layouts.admin')
<title>{{trans('home.menus')}}</title>
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.menus')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.menus')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <a href="{{url('admin/menus/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                 <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="mb-0" data-pattern="priority-columns">

                            <table  id="tech-companies-1" class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>{{trans('home.id')}}</th>
                                        <th >{{trans('home.name_en')}}</th>
                                        <th >{{trans('home.name_ar')}}</th>
                                        <th >{{__('home.publish/unpublish')}}</th>
                                        <th >{{__('home.edit')}}</th>
                                        <th >{{__('home.delete')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $menu)
                                        <tr id="{{$menu->id}}">
                                            <td><a href="{{ route('menus.edit', $menu->id) }}">{{$menu->id}}</a></td>
                                            <td><a href="{{ route('menus.edit', $menu->id) }}">{{$menu->name_en}}</a></td>
                                            <td><a href="{{ route('menus.edit', $menu->id) }}">{{$menu->name_ar}}</a></td>
                                            <td> 
                                                <input class="btn_active" data-id="{{$menu->id}}" type="checkbox" id="switch-{{$menu->id}}" switch="success" {{$menu->status == 1?'checked':''}} />
                                                    <label for="switch-{{$menu->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            </td>
                                            <td> 
                                                <a type="button" class="btn btn-info waves-effect waves-light " 
                                                    href="{{ route('menus.edit',$menu->id) }}" >{{__('home.edit')}}</a>
                                            </td>
                                            <td> 
                                                <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                    data-id="{{$menu->id}}">{{__('home.delete')}}</a>
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
