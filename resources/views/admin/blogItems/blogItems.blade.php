@extends('layouts.admin')
<title>{{trans('home.blogitems')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.blogitems')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.blogitems')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/blog-items/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
        <a href="javascript:void(0)"><button class="copyButton btn ripple btn-info col-md-2"><i class="bx bx-copy-alt"></i> {{trans('home.copy')}}</button></a>
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
                                <th>{{trans('home.title_en')}}</th>
                                <th>{{trans('home.title_ar')}}</th>
                                <th>{{trans('home.date')}}</th>
                                <th>{{trans('home.writer')}}</th>
                                <th>{{trans('home.blog_preview')}}</th>
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
                            @foreach($blogItems as $blogItem)
                                <tr id="{{$blogItem->id}}">
                                    <td> <input type="checkbox" name="checkbox"  class="tableChecked form-check-input" value="{{$blogItem->id}}" /> </td>
                                    <td><a href="{{ route('blog-items.edit', $blogItem->id) }}">{{$blogItem->id}}</a></td>
                                    <td><a href="{{ route('blog-items.edit', $blogItem->id) }}">{{$blogItem->title_en}}</a></td>
                                    <td><a href="{{ route('blog-items.edit', $blogItem->id) }}">{{$blogItem->title_ar}}</a></td>
                                    <td><a href="{{ route('blog-items.edit', $blogItem->id) }}">{{$blogItem->date}}</a></td>
                                    <td><a href="{{ route('blog-items.edit', $blogItem->id) }}">{{$blogItem->writers->name??'No Writer'}}</a></td>
                                    <td><a href='{{($lang == "en")?LaravelLocalization::localizeUrl("/blog/$blogItem->link_en"):LaravelLocalization::localizeUrl("/blog/$blogItem->link_ar")}}' target="_blank"><i class="fas fa-eye"></i> {{trans('home.blog_preview')}}</a></td>
                                    <td> 
                                        <input class="btn_active" data-id="{{$blogItem->id}}" type="checkbox" id="switch-{{$blogItem->id}}" switch="success" {{$blogItem->status == 1?'checked':''}} />
                                        <label for="switch-{{$blogItem->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-info waves-effect waves-light " 
                                            href="{{ route('blog-items.edit',$blogItem->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                            data-id="{{$blogItem->id}}">{{__('home.delete')}}</a>
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
@section('script')
    <script>
        $(document).on('click', '.copyButton', function() {
            var ids = [];
            $('.tableChecked:checked').each(function(i){
                ids[i] = $(this).val();
            });
            if(ids.length === 0) //tell you if the array is empty
            {
                alert("Please Select atleast one checkbox");
            }
            else{
              
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"<?php echo route('BlogItemCopy') ?>",
                    type:'POST',
                    data:{ids:ids},
                    success:function(data)
                    {
                        // console.log(data);
                        location.reload();
                    }
                });
            }

        });
    </script>

@endsection