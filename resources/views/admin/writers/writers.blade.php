@extends('layouts.admin')
<title>{{trans('home.writers')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.writers')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.writers')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/writers/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="checkAll"/></th>
                                <th>{{trans('home.id')}}</th>
                                <th class="wd-20p">{{trans('home.name')}}</th>
                                <th class="wd-25p">{{trans('home.email')}}</th>
                                <th class="wd-20p">{{trans('home.position')}}</th>
                                <th class="wd-15p">{{trans('home.phone')}}</th>
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
                            @foreach($writers as $writer)
                                <tr id="{{$writer->id}}">
                                    <td> <input type="checkbox" name="checkbox"  class="tableChecked form-check-input" value="{{$writer->id}}" /> </td>
                                    <td><a href="{{ route('writers.edit', $writer->id) }}">{{$writer->id}}</a></td>
                                    <td>{{$writer->name}}</td>
                                    <td>{{$writer->email}}</td>
                                    <td>{{$writer->position}}</td>
                                    <td>{{$writer->phone}}</td>
                                    <td> 
                                        <input class="btn_active" data-id="{{$writer->id}}" type="checkbox" id="switch-{{$writer->id}}" switch="success" {{$writer->status == 1?'checked':''}} />
                                        <label for="switch-{{$writer->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-info waves-effect waves-light " 
                                            href="{{ route('writers.edit',$writer->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                            data-id="{{$writer->id}}">{{__('home.delete')}}</a>
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
