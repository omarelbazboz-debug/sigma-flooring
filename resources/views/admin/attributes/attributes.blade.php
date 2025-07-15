@extends('layouts.admin')
<title>{{trans('home.attributes')}}</title>
@section('content')
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.attributes')}}</h4>
    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.attributes')}}</li>
                        </ol>
                    </div>
    
                </div>
            </div>
        </div>
        <a href="{{url('admin/attributes/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="mb-0" data-pattern="priority-columns">
                        <table  id="tech-companies-1" class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="form-check-input" id="checkAll"/></th>
                                    <th>{{trans('home.id')}}</th>
                                    <th class="wd-20p">{{trans('home.name_en')}}</th>
                                    <th class="wd-25p">{{trans('home.name_ar')}}</th>
                                    <th class="wd-25p">{{trans('home.icon')}}</th>
                                    <th>{{__('home.publish/unpublish')}}</th>
                                    <th>{{__('home.edit')}}</th>
                                    <th>{{__('home.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attributes as $attribute)
                                    <tr id="{{$attribute->id}}">
                                        <td> <input type="checkbox" name="checkbox"  class="tableChecked form-check-input" value="{{$attribute->id}}" /> </td>
                                        <td><a href="{{ route('attributes.edit', $attribute->id) }}">{{$attribute->id}}</a></td>
                                        <td>{{$attribute->name_en}}</td>
                                        <td>{{$attribute->name_ar}}</td>
                                        <td>
                                            <a href="{{ route('attributes.edit', $attribute->id) }}">
                                                @if($attribute->icon)
                                                    <img src="{{url('/uploads/attribute/resize200')}}/{{$attribute->icon}}" width="70">
                                                @else
                                                    <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                                @endif
                                            </a>
                                        </td>
                                        <td> 
                                            <input class="btn_active" data-id="{{$attribute->id}}" type="checkbox" id="switch-{{$attribute->id}}" switch="success" {{$attribute->status == 1?'checked':''}} />
                                                <label for="switch-{{$attribute->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        </td>
                                        <td> 
                                            <a type="button" class="btn btn-info waves-effect waves-light " 
                                                href="{{ route('attributes.edit',$attribute->id) }}" >{{__('home.edit')}}</a>
                                        </td>
                                        <td> 
                                            <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                                data-id="{{$attribute->id}}">{{__('home.delete')}}</a>
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

