@extends('layouts.admin')
<title>{{trans('home.menu_items')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.menu_items')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.menu_items')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/menu-items/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
                                        <th >{{trans('home.id')}}</th>
                                        <th >{{trans('home.menu_name')}} {{ trans('home.en') }}</th>
                                        <th >{{trans('home.menu_parent')}}</th>
                                        <th >{{trans('home.menu_order')}}</th>
                                        <th >{{trans('home.menu_type')}}</th>
                                        <th >{{trans('home.menu')}}</th>
                                        <th >{{trans('home.menu_status')}}</th>
                                        <th >{{__('home.publish/unpublish')}}</th>
                                        <th >{{__('home.edit')}}</th>
                                        <th >{{__('home.delete')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menuItems as $menuItem)
                                        <tr id="{{$menuItem->id}}">
                                            <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">{{ $menuItem->id }}</td>
                                            <td><a>{!! $menuItem->name_en !!}</a></td>
                                            <td><a>@if($menuItem->parent) {{(app()->getLocale() == 'en')?$menuItem->parent->name_en:$menuItem->parent->name_ar }} @else {{trans('home.main_menu_item')}} @endif </td>
                                            <td><a>{{ $menuItem->order }}</td>
                                            <td><a>{{ $menuItem->type }}</td>
                                            <td><a>@if($menuItem->Menu){{(app()->getLocale() == 'en')? $menuItem->Menu->name_en:$menuItem->Menu->name_ar }} @endif</td>
                                            <td> 
                                                <input class="btn_active" data-id="{{$menuItem->id}}" type="checkbox" id="switch-{{$menuItem->id}}" switch="success" {{$menuItem->status == 1?'checked':''}} />
                                                    <label for="switch-{{$menuItem->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                            </td>
                                            <td> 
                                                <a type="button" class="btn btn-info waves-effect waves-light " 
                                                    href="{{ route('menu-items.edit',$menuItem->id) }}" >{{__('home.edit')}}</a>
                                            </td>
                                            <td> 
                                                <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                    data-id="{{$menuItem->id}}">{{__('home.delete')}}</a>
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
