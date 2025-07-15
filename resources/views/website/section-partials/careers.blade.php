{{--@php
    $aboutTitles = $titles->filter(fn($title) => $title->type === 'careers');
@endphp

@foreach ($aboutTitles as $title)
<section class="career-page-section sec-pad">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 left-side">
                <div class="text-box">

                    <h3><strong>{{$title->{'title_' .$lang} }}</strong></h3>

<p><br />

    {!! $title->{'text_' .$lang} !!}

</p>

</div>

</div>

<div class="col-lg-6 col-md-12 col-sm-12 right-side">
    <ul class="accordion-box">
        @foreach ($careers as $index => $career)
        <li class="accordion block active-block">
            <div class="acc-btn active">
                <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                <h5>{{ $career->{'title_' . $lang} }}</h5>
            </div>
            <div class="acc-content">
                <div class="content-box">
                    <p>{!! $career->{'text_' . $lang} !!}</p>
                    <button type="button" class="theme-btn btn-one" data-bs-toggle="modal"
                        data-bs-target="#careerModal-{{ $index }}"> Apply Now </button>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
</div>
</div>
</div>
</section>
@endforeach

@foreach ($careers as $index => $career)
<div class="modal fade" id="careerModal-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Apply For {{ $career->{'title_' . $lang} }}
                </h5>
                <a type="button" class="close fs-2" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="careers">

                <div class="contact-form">
                    <form id="contactForm"
                        action="{{ url('save-career-application') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        data-toggle="validator"
                        class="wow fadeInUp"
                        data-wow-delay="0.4s">

                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ trans('home.name') }}*" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-12 mb-4">
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ trans('home.email') }}*" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-12 mb-4">
                                <input type="text" name="phone" class="form-control"
                                    placeholder="{{ trans('home.phone') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input type="text" name="position" class="form-control"
                                    placeholder="{{ $career->{'title_' . $lang} }}" value="{{ $career->{'title_' . $lang} }}" readonly>
                                <input type="hidden" name="position" value="{{ $career->{'title_' . $lang} }}">
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 form-group mb-4">
                                <div class="contact-one__input-box">
                                    <input type="file" class="form-control"
                                        name="file" accept=".pdf,.docx">
                                    <small class="text-muted"> PDF . DOCX </small>
                                </div>
                            </div>

                            <div class="form-group col-md-12 mb-5">
                                <textarea name="notes" class="form-control" rows="4"
                                    placeholder="{{ trans('home.message') }}"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default">{{ trans('home.send') }}</button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach --}}
@php
$careerTitle = $titles->where('type' , 'careers');
@endphp
<div class="full-row">
    <div class="container">
        <div class="row g-5">
            <div class="col-12">
                <div class="row">
                    @foreach($careerTitle as $title)
                    <div class="col-md-12 wow animate__fadeIn" data-wow-delay="100ms" data-wow-duration="1000ms">
                        <h3 class="down-line-primary text-secondary text-start mb-20">{{ $title->{'title_' .$lang} }}</h3>
                        <span class="sub-title fs-15 ordinary-font fst-normal text-general text-start mb-30">{!! $title->{'text_' .$lang} !!}</span>
                    </div>
                    @endforeach
                </div>
                <div class="row accordion right-plus border-style-3">
                    <div class="col">
                        <div id="accordion-1">
                            @foreach ($careers as $index => $career)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $index }}">{{ $career->{'title_' .$lang} }}</button>
                                </h2>
                                <div id="collapse-{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $index }}">
                                    <div class="accordion-body bg-white">
                                        <div class="row row-cols-sm-2 row-cols-1 g-4">
                                            <div class="col">
                                                <span class="text-primary">{!! $career->{'title_' .$lang} !!}</span>
                                               
                                                <p>{!! $career->{'text_' .$lang} !!}</p>
                                                <a class="apply-btn btn btn-primary d-block mt-3" href="javascript:void(0);" onclick="openForm('{{ $career->{'title_' .$lang} }}')">Apply Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-apply" id="formPopup">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="down-line-primary text-secondary text-start mb-20">Application Here</h3>
                <form id="applicationForm" action="{{ url('save-career-application') }}" method="post" novalidate="novalidate" enctype="multipart/form-data"
                    data-toggle="validator">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <input class="form-control bg-light" name="name" placeholder="{{ trans('home.name') }}" type="text">
                        </div>
                        <div class="col-md-6">
                            <input class="form-control bg-light" name="email" placeholder="{{ trans('home.email') }}" type="text">
                        </div>
                        <div class="col-md-6">
                            <input class="form-control bg-light" name="phone" placeholder="{{ trans('home.phone') }}" type="text">
                        </div>
                        <div class="col-md-6">
                            <select class="form-control bg-light" name="position">
                                <option>{{ trans('home.position') }}</option>
                                @foreach ($careers as $career)
                                <option value="{{ $career->{'title_' . $lang} }}">{{ $career->{'title_' . $lang} }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control bg-light" rows="10" name="message" placeholder="{{ trans('home.message') }}"></textarea>
                        </div>
                        <div id="file" class="col-md-6">
                            <input class="attatchment" name="file" accept=".pdf,.docx" type="file">
                        </div>
                        <div class="col-md-6 d-flex justify-content-end gap-2">
                            <input class="btn btn-primary py-2" placeholder="{{ trans('home.send') }}" type="submit">
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>