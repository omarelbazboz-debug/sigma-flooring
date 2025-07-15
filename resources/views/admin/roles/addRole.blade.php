@extends('layouts.admin')
<title>{{trans('home.add')}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.roles')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/roles')}}">{{trans('home.roles')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="name">{{trans('home.name')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.name')}}" name="name" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="helperText">{{trans('home.permissions')}}</label>
                                        <div class="permissions">
                                            <select class="form-control  choices-multiple-remove-button" name="permissions[]" multiple>
                                                @foreach($permissions as $permission)
                                                <option value="{{$permission->name}}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mt-4 mb-0">
                                        <input type="checkbox" name="all_permissions" value="1" class="form-check-input form-check-input" id="checkbox"> {{trans('home.selectall')}}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/roles')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>

@endsection

@section('script')
<script>
    $("#checkbox").click(function() {
        if ($("#checkbox").is(':checked')) {
            $(".permissions").addClass("d-none");
        } else {
            $(".permissions").removeClass("d-none");
        }
    });
</script>
@endsection