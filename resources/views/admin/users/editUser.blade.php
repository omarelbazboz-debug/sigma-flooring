@extends('layouts.admin')
<title>{{trans("home.edit_user")}}</title>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.users')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/users')}}">{{trans('home.users')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.edit_user')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('home.edit_user')}}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <form method="POST" action="{{ url('admin/users/'.$user->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @method('PATCH')
                                @csrf
                                <div class="row">

                                    <div class="col-md-3 mb-3">
                                        <label for="helperText">{{trans('home.f_name')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.f_name')}}" value="{{ $user->f_name }}" name="f_name" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="helperText">{{trans('home.l_name')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.l_name')}}" value="{{ $user->l_name }}" name="l_name" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="helperText">{{trans('home.email')}}</label>
                                        <input type="email" class="form-control email" placeholder="{{trans('home.email')}}" value="{{ $user->email }}" name="email" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="helperText">{{trans('home.password')}}</label>
                                        <input type="password" class="form-control" placeholder="{{trans('home.password')}}" name="password" data-minlength="8">
                                        <p class="pristine-error text-help">{{trans('home.Your Password Must Be at Least 8 Characters')}}</p>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>
                                    @if($user->image)
                                    <div class="form-group  col-md-3 m-2 mt-3">
                                        <label>{{trans('home.image')}}</label><br>
                                        <img src="{{url('\uploads\users\resize200')}}\{{$user->image}}" width="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-auto mt-3">
                                        <img src="{{asset('assets/back/images/noimage.jpg')}}" width="70">
                                    </div>
                                    @endif

                                    <div class="col-md-4 mb-3 ">
                                        <label for="phone1">{{__('home.phone1')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                            <input class="form-control" value="{{$user->phone}}" type="number" min="0" placeholder="Phone" name="phone" autocomplete="off" required>
                                        </div>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="helperText">{{trans('home.roles')}}</label>
                                        <select class="form-control role choices-multiple-remove-button" name="role[]" multiple>
                                            @foreach($roles as $role)
                                            <option value="{{$role->name}}" @if(in_array($role->name,$userRoles)) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="helperText">{{trans('home.admin')}}</label>
                                        <select class="form-control admin" data-trigger name="admin">
                                            <option value="1" @if($user->is_admin == 1) selected @endif>{{trans('home.yes')}}</option>
                                            <option value="0" @if($user->is_admin == 0) selected @endif>{{trans('home.no')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/users')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.role').select2({
        placeholder: 'Select Roles'
    });

    $('.admin').select2();

    $(".email").attr("autocomplete", "off");

    $(".img").fileinput({
        showUpload: false,
        previewFileType: 'any',
        theme: 'fa'
    });
</script>
@endsection