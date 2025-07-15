@extends('layouts.admin')
<title>{{trans('home.pages')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.pages')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.pages')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/pages/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
        <!-- End Page Header -->


        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card-body">
                    <table class="table" id="exportexample">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th>{{trans('home.id')}}</th>
                                <th class="wd-20p">{{trans('home.title')}}</th>
                                <th class="wd-25p">{{trans('home.text')}}</th>
                                <th>{{__('home.publish/unpublish')}}</th>
                                <th>{{__('home.edit')}}</th>
                                <th>
                                    <div class="d-block">
                                        <a type="button" id="btn_delete" class="btn btn-danger waves-effect waves-light" >{{__('home.delete')}}</a>
                                    <div>                                 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr id="{{$page->id}}">
                                    <td> <input type="checkbox" name="checkbox"  class="tableChecked" value="{{$page->id}}" /> </td>
                                    <td><a href="{{ route('pages.edit', $page->id) }}">{{$page->id}}</a></td>
                                    <td>{{(app()->getLocale() == 'en')?$page->title_en:$page->title_ar}}</td>
                                    <td><a href="{{ route('pages.edit', $page->id) }}">{!! ($lang == 'en')?substr($page->text_en,0,150).' ...':substr($page->text_ar,0,150).' ...'!!}</a></td>
                                    <td> 
                                        <input class="btn_active" data-id="{{$page->id}}" type="checkbox" id="switch-{{$page->id}}" switch="success" {{$page->status == 1?'checked':''}} />
                                        <label for="switch-{{$page->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-info waves-effect waves-light " 
                                            href="{{ route('pages.edit',$page->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                            data-id="{{$page->id}}">{{__('home.delete')}}</a>
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
