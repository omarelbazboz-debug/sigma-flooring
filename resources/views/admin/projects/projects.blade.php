@extends('layouts.admin')
    <title>{{trans('home.projects')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.projects')}}</h4>
    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.projects')}}</li>
                        </ol>
                    </div>
    
                </div>
            </div>
        </div>
        <a href="{{url('admin/projects/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
        <div class="container-fluid">
            <!-- Row-->
            <div class="row">
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc"><input type="checkbox" id="checkAll"/></th>
                                    <th class="sorting">{{trans('home.id')}}</th>
                                    <th class="sorting">{{trans('home.name_en')}}</th>
                                    <th class="sorting">{{trans('home.name_ar')}}</th>
                                    <th class="sorting">{{trans('home.order')}}</th>
                                    <th class="sorting">{{trans('home.image')}}</th>
                                    <th class="sorting">{{__('home.publish/unpublish')}}</th>
                                    <th class="sorting">{{__('home.edit')}}</th>
                                    <th class="sorting">{{__('home.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects->sortByDesc('order') as $project)
                                    <tr id="{{$project->id}}">
                                        <td> <input type="checkbox" name="checkbox"  class="tableChecked " value="{{$project->id}}" /> </td>
                                        <td><a href="{{ route('projects.edit', $project->id) }}">{{$project->id}}</a></td>
                                        <td>{{$project->name_en}}</td>
                                        <td>{{$project->name_ar}}</td>
                                        <td>{{$project->order}}</td>
                                        <td>
                                            <a href="{{ route('projects.edit', $project->id) }}">
                                                @if($project->image)
                                                    <img style="height: 150px;object-fit: contain" src="{{$project->image}}" width="150">
                                                @else
                                                    <img src="{{asset('assets/back/images/noimage.jpg')}}" width="150">
                                                @endif
                                            </a>
                                        </td>
                                        <td> 
                                            <input class="btn_active" data-id="{{$project->id}}" type="checkbox" id="switch-{{$project->id}}" switch="success" {{$project->status == 1?'checked':''}} />
                                                <label for="switch-{{$project->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                        </td>
                                        <td> 
                                            <a type="button" class="btn btn-info waves-effect waves-light " 
                                                href="{{ route('projects.edit',$project->id) }}" >{{__('home.edit')}}</a>
                                        </td>
                                        <td> 
                                            <a type="button" class="btn btn-danger waves-effect waves-light btn_delete " 
                                                data-id="{{$project->id}}">{{__('home.delete')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
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
                    url:"<?php echo route('ProjectsCopy') ?>",
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