@extends('layouts.admin')
<title>{{trans('home.galleryVideos')}}</title>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{trans('home.galleryVideos')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('home.galleryVideos')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{url('admin/gallery-videos/create')}}"><button class="btn ripple btn-primary col-md-2"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
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
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="checkAll"/></th>
                                <th>{{trans('home.id')}}</th>
                                <th>{{trans('home.video')}}</th>
                                <th>{{trans('home.order')}}</th>
                                <th>{{__('home.publish/unpublish')}}</th>
                                <th>{{__('home.edit')}}</th>
                                <th>{{__('home.delete')}}
                                    <div class="d-block">
                                        <a type="button" id="btn_delete" class="btn btn-danger waves-effect waves-light" >{{__('home.delete')}}</a>
                                    <div>                                 
                                </th>
                            </tr>
                        </thead>
                        <tbody class="sortable">
                            @foreach($galleryVideos as $galleryVideo)
                                <tr id="{{$galleryVideo->id}}" data-id="{{ $galleryVideo->id }}"  class="image">
                                    <td> <input type="checkbox" name="checkbox"  class="tableChecked form-check-input" value="{{$galleryVideo->id}}" /> </td>
                                    <td><a href="{{ route('gallery-videos.edit', $galleryVideo->id) }}">{{$galleryVideo->id}}</a></td>
                                    <td>
                                        <a href="{{ route('gallery-videos.edit', $galleryVideo->id) }}">
                                            <iframe width="200" height="150"
                                                src="{{$galleryVideo->youtube_link}}">
                                            </iframe>
                                        </a>
                                    </td>
                                    <td class="order">{{$galleryVideo->order}}</td>
                                    <td> 
                                        <input class="btn_active" data-id="{{$galleryVideo->id}}" type="checkbox" id="switch-{{$galleryVideo->id}}" switch="success" {{$galleryVideo->status == 1?'checked':''}} />
                                        <label for="switch-{{$galleryVideo->id}}" data-on-label="{{trans('home.yes')}}" data-off-label="{{trans('home.no')}}"></label>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-info waves-effect waves-light " 
                                            href="{{ route('gallery-videos.edit',$galleryVideo->id) }}" >{{__('home.edit')}}</a>
                                    </td>
                                    <td> 
                                        <a type="button" class="btn btn-danger waves-effect waves-light btn_delete" 
                                            data-id="{{$galleryVideo->id}}">{{__('home.delete')}}</a>
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
@section('script')
    <script>
        /////// make table row sortable ////
        $(document).ready(function () {
            var $videos = $('.sortable');
            $videos.sortable({
                connectWith: '.sortable',
                items: 'tr.image',
                stop: (event, ui) => {
                    sendReordervideosRequest($(ui.item).parent());
    
                    if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                        if ($(event.target).find('tr.image').length) {
                            sendReordervideosRequest($(event.target));
                        } else {
                            $(event.target).find('.empty-message').show();
                        }
                    }
                }
            });
            $('table, .sortable').disableSelection();
        });
        
        ////// send reorder request //////////////
        function sendReordervideosRequest($image) {
            var items = $image.sortable('toArray', {attribute: 'data-id'});
            var ids = $.grep(items, (item) => item !== "");
            var _token = $('meta[name="csrf-token"]').attr('content');
            
            if ($image.find('tr.image').length) {
                $image.find('.empty-message').hide();
            }

            $.post('{{ url('admin/gallery-videos/reorder') }}', {
                _token,
                ids,
            })
            .done(function (response) {
                $image.children('tr.image').each(function (index, image) {
                    $(image).children('.order').text(response.positions[$(image).data('id')])
                });
            })
            .fail(function (response) {
                alert('Error occured while sending reorder request');
                location.reload();
            });
        }

    </script>
@endsection    
