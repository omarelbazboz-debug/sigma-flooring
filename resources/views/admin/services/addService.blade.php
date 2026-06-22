@extends('layouts.admin')
@section('meta')
<title>{{trans('home.add_service')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{trans('home.add_service')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/services')}}">{{trans('home.services')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('home.add_service')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @if ($errors->any())
                                    <script>
                                        let errorMessages = '';
                                        @foreach ($errors->all() as $error)
                                            errorMessages += '{{ $error }}\n';
                                        @endforeach
                                        alert(errorMessages);
                                    </script>
                                @endif
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label for="name_en">{{trans('home.name_en')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.name_en')}}" name="name_en" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="name_ar">{{trans('home.name_ar')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.name_ar')}}" name="name_ar">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="helperText">{{trans('home.parent')}}</label>
                                        <select class="form-control" data-trigger name="parent_id" required>
                                            <option value="0">{{trans('home.no_parent')}}</option>
                                            @foreach($services as $serv)
                                            <option value="{{$serv->id}}">{{(app()->getLocale() == 'en')?$serv->name_en:$serv->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="youtube_link">{{trans('home.youtube_link')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.youtube_link')}}" name="youtube_link">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="order">{{trans('home.order')}}</label>
                                        <input type="number" min="0" class="form-control" placeholder="{{trans('home.order')}}" name="order">
                                    </div>
                                    
                                     <div class="col-md-4 mb-3">
                                        <label for="helperText">{{trans('home.album_for')}}</label>
                                        <select class="form-control" data-trigger name="album_for" required>
                                            <option value="0">{{trans('home.not_album')}}</option>
                                            @foreach($services as $serv)
                                                <option value="{{$serv->id}}">{{(app()->getLocale() == 'en')?$serv->name_en:$serv->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-8 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.choose_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="img">
                                    </div>

                                    <div class="col-md-4 mb-3 mt-3">
                                        <label>{{trans('home.alt_img')}}</label>
                                        <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}" />
                                    </div>
                                    <div class="col-md-6 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.pdf') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="file">
                                    </div>

                                    <div class="col-md-12 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.icon') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="icon">
                                    </div>
                                    <div class="col-md-12 mb-3 mt-3">
                                        <label for="formFile" class="form-label">{{ trans('home.banner') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="banner">
                                    </div>


                                    <div class="col-md-6 mb-3 ">
                                        <label for="text1_en">{{trans('home.hometext_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text1_en" placeholder="{{trans('home.text_en')}}"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="text1_ar">{{trans('home.hometext_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text1_ar" placeholder="{{trans('home.text_ar')}}"></textarea>
                                    </div>
                                    <tr></tr>
                                    <div class="col-md-6 mb-3 ">
                                        <label for="text_en">{{trans('home.text_en')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_en" placeholder="{{trans('home.text_en')}}"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="text_ar">{{trans('home.text_ar')}}</label>
                                        <textarea class="form-control ckeditor-classic" name="text_ar" placeholder="{{trans('home.text_ar')}}"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title mt-3 mb-3">{{trans('home.seo_block')}}</h4>
                                        <span class="badge-soft-primary">{{trans('home.en')}}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_en">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}"></textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge-soft-primary">{{trans('home.ar')}}</span>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="link_ar">{{trans('home.slug')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}"></textarea>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                    </div>
                                </div>
                                <!-- Row-->
                                <div class="row mt-2">
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="status" id="switch" switch="success" />
                                            <label for="switch" data-on-label="{{ trans('home.yes') }}" data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch">{{ trans('home.publish') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="home" id="switch1" switch="success" />
                                            <label for="switch1" data-on-label="{{ trans('home.yes') }}" data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch1">{{ trans('home.home') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="meta_robots" id="switch2" switch="success" />
                                            <label for="switch2" data-on-label="{{ trans('home.yes') }}" data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch2">{{ trans('home.meta_robots') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="menu" id="switch3" switch="success" />
                                            <label for="switch3" data-on-label="{{ trans('home.yes') }}" data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch3">{{ trans('home.menu') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{trans('home.save')}}</button>
                                    <a href="{{url('/admin/services')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection