 @extends('layouts.app')
@section('title')
@php echo $metatags @endphp
@endsection
@section('content')
<div class="page-content mb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                                    <div class="shop-product-fillter mb-50 section-padding pb-5">
                                        <div class="totall-product">
                                            <h2>
                                                {{$category->{'name_'.$lang} }}
                                            </h2>
                                        </div>
                                    </div>
                <div class="archive-header-2 text-center pt-80 pb-50">
                    <h1 class="display-2 mb-50">{{ $category->{'name_' . $lang} }}</h1>
                </div>
                <div class="loop-grid">
                    <div class="row">
                        @foreach ($products as $index => $all_product)
                            <div class="col-lg-1-5 col-md-3 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ LaravelLocalization::localizeUrl('product/' . $all_product->{'link_' . $lang}) }}">
                                                @foreach ($all_product->images() as $index => $image)
                                                    <img class="{{ $index == 0 ? 'default-img' : 'hover-img' }}"
                                                        src="{{ Helper::uploadedImagesPath('projects', $image->image) }}"
                                                        alt="{{ $all_product->{'name_' . $lang} }}" />
                                                @endforeach
                                            </a>
                                        </div>

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($all_product->type == 'Hot')
                                                <span class="hot">{{ __('home.Hot') }}</span>
                                            @elseif($all_product->type == 'Sale')
                                                <span class="sale">{{ __('home.Sale') }}</span>
                                            @elseif($all_product->type == 'New')
                                                <span class="new">{{ __('home.New') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a
                                                href="{{ LaravelLocalization::localizeUrl('category/' . $all_product->category->{'link_' . $lang} . '/products') }}">
                                                {{ $all_product->category->{'name_' . $lang} }}</a>
                                        </div>
                                        <h2>
                                            <a
                                                href="{{ LaravelLocalization::localizeUrl('product/' . $all_product->{'link_' . $lang}) }}">{{ $all_product->{'name_' . $lang} }}</a>
                                        </h2>
                                        <p>{!! substr($all_product->{'small_text_' . $lang}, 0, 50) !!}</p>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                @if (!empty($all_product->brand))
                                                    <span class="font-small text-muted">{{ __('home.By') }}
                                                        <a
                                                            href="{{ LaravelLocalization::localizeUrl('brand/' . $all_product->brand->{'link_' . $lang}) }}">{{ $all_product->brand->{'name_' . $lang} }}</a></span>
                                                @endif
                                            </div>
                                            <div class="add-cart">
                                                <a class="add"
                                                    href="{{ LaravelLocalization::localizeUrl('product/' . $all_product->{'link_' . $lang}) }}"><i
                                                        class="fi-rs-eye mr-5"></i>{{ __('home.Show Details') }}</a>
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
@endsection
