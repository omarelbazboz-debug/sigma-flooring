@extends('layouts.admin')
@section('meta')
<title>{{ trans('home.edit_setting') }}</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('home.edit_setting') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('home.admin') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('home.edit_setting') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->pull('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    @endif
    <!-- Row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ url('admin/settings/' . $settings->id) }}" enctype="multipart/form-data" data-toggle="validator">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="helperText">{{ trans('home.default_lang') }}</label>
                                        <select class="form-control select2" name="default_lang" required>
                                            <option value="en" {{ $settings->default_lang == 'en' ? 'selected' : '' }}>
                                                {{ trans('home.english') }}
                                            </option>
                                            <option value="ar" {{ $settings->default_lang == 'ar' ? 'selected' : '' }}>
                                                {{ trans('home.arabic') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.contact_email') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.contact_email') }}" name="contact_email"
                                            value="{{ $settings->contact_email }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="formFile" class="form-label">{{ trans('home.contact_image') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="contact_image">
                                    </div>
                                    @if ($settings->contact_image)
                                    <div class="form-group  col-md-2 mt-3">
                                        <img src="{{ url('\uploads\settings\source') }}\{{ $settings->contact_image }}"
                                            width="200" height="150">
                                    </div>
                                    @else
                                    <div class="form-group  col-md-2 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}"
                                            width="70">
                                    </div>
                                    @endif
                                     <div class="col-md-3 mb-3 mt-3">
                                    <label for="formFile" class="form-label">{{ trans('home.pdf') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="file">
                                </div>
                                @if ($setting->file)
                                    <div class=" col-md-2 m-2 mt-3">
                                        <img src="{{ $setting->file }}" width="200" height="150">
                                    </div>
                                @else
                                    <div class=" col-md-3 mt-3">
                                        <img src="{{ asset('assets/back/images/noimage.jpg') }}" width="70">
                                    </div>
                                @endif
                                    <div class="col-md-5 mb-3">
                                        <label class="">{{ trans('home.email') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ trans('home.email') }}"
                                            name="email" value="{{ $settings->email }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.telphone') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.telphone') }}" name="telphone"
                                            value="{{ $settings->telphone }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.mobile') }}</label>
                                        <input type="mobile" min="0" class="form-control"
                                            placeholder="{{ trans('home.mobile') }}" name="mobile"
                                            value="{{ $settings->mobile }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.mobile2') }}</label>
                                        <input type="mobile" min="0" class="form-control"
                                            placeholder="{{ trans('home.mobile2') }}" name="mobile2"
                                            value="{{ $settings->mobile2 }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.fax') }}</label>
                                        <input type="fax" min="0" class="form-control"
                                            placeholder="{{ trans('home.fax') }}" name="fax"
                                            value="{{ $settings->fax }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.whatsapp') }}</label>
                                        <input type="whatsapp" min="0" class="form-control"
                                            placeholder="{{ trans('home.whatsapp') }}" name="whatsapp"
                                            value="{{ $settings->whatsapp }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="facebook">{{ trans('home.facebook') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.facebook') }}" name="facebook"
                                            value="{{ $settings->facebook }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="twitter">{{ trans('home.twitter') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.twitter') }}" name="twitter"
                                            value="{{ $settings->twitter }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="instgram">{{ trans('home.instagram') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.instagram') }}" name="instgram"
                                            value="{{ $settings->instgram }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="linkedin">{{ trans('home.linkedin') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.linkedin') }}" name="linkedin"
                                            value="{{ $settings->linkedin }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="">{{ trans('home.snapchat') }}</label>
                                        <input type="text" min="0" class="form-control"
                                            placeholder="{{ trans('home.snapchat') }}" name="snapchat"
                                            value="{{ $settings->snapchat }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="tiktok">{{ trans('home.tiktok') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.tiktok') }}" name="tiktok"
                                            value="{{ $settings->tiktok }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="tiktok">{{ trans('home.behance') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.tiktok') }}" name="behance"
                                            value="{{$setting->behance}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="youtube">{{ trans('home.youtube') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.youtube') }}" name="youtube"
                                            value="{{ $settings->youtube }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>{{ trans('home.map_view') }}</label>
                                        <textarea class="form-control" name="map_view" type="text" placeholder="{{ trans('home.map_view') }}">{{ $settings->map_view }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>{{ trans('home.map_url') }}</label>
                                        <textarea class="form-control" name="map_url" type="text" placeholder="{{ trans('home.map_url') }}">{{ $settings->map_url }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <iframe src="{{ $settings->map_view }}" width="100%" height="250"
                                            style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <hr>
                                    <div class="form-group col-md-3">
                                        <label class="">{{ trans('home.FINISHED PROJECTS') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.FINISHED PROJECTS') }}" name="cetificates"
                                            value="{{ $settings->cetificates }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="">{{ trans('home.WORKING HOURS') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.WORKING HOURS') }}" name="exp_years"
                                            value="{{ $settings->exp_years }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="">{{ trans('home.AWARDS WON') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.AWARDS WON') }}" name="surgeries"
                                            value="{{ $settings->surgeries }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="">{{ trans('home.Employees') }}</label>
                                        <input type="number" min="0" class="form-control"
                                            placeholder="{{ trans('home.Employees') }}" name="consult"
                                            value="{{ $settings->consult }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gtm_script">{{ trans('home.gtm_script') }}</label>
                                        <textarea class="form-control" placeholder="{{ trans('home.gtm_script') }}" name="gtm_script"> {!! $settings->gtm_script !!}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gtm_noscript">{{ trans('home.gtm_noscript') }}</label>
                                        <textarea class="form-control" placeholder="{{ trans('home.gtm_noscript') }}" name="gtm_noscript"> {!! $settings->gtm_noscript !!}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="copyright">{{ trans('home.Copyright') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ trans('home.Copyright') }}" name="copyright"
                                            value="{{ $settings->copyright }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="publish_gtm_script"
                                                id="switch" switch="success"
                                                {{ $settings->publish_gtm_script == 1 ? 'checked' : '' }} />
                                            <label for="switch" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch">
                                                {{ trans('home.publish_gtm_script') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">

                                        <div class="form-check d-flex">
                                            <input type="checkbox" value="1" name="publish_contact_modal"
                                                id="switch1" switch="success"
                                                {{ $settings->publish_contact_modal == 1 ? 'checked' : '' }} />
                                            <label for="switch1" data-on-label="{{ trans('home.yes') }}"
                                                data-off-label="{{ trans('home.no') }}"></label>
                                            <label class="form-check-label mx-3" for="switch1">
                                                {{ trans('home.publish_contact_modal') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">{{ trans('home.save') }}</button>
                                    <a href="{{ url('/admin') }}"><button type="button" class="btn btn-danger mr-1"><i
                                                class="icon-trash"></i> {{ trans('home.cancel') }}</button></a>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2DM4_HwOA3s6WsWcyhRt5Q_NO9CoxZpU&callback=initMap2"
    async defer></script>
<script>
    $('.lang').select2({});
</script>
@endsection