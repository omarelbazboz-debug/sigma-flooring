@if ($categories->isNotEmpty())
    <!--========================== Categories ==========================-->
    <div id="tt-page-content">
        <div class="tt-section">
            <div class="tt-section-inner max-width-2200">
                <div id="portfolio-grid" class="pgi-hover">
                    <div class="tt-grid ttgr-layout-3 ttgr-gap-3">
                        <div class="tt-grid-items-wrap isotope-items-wrap">
                            @foreach ($sub_categories as $categorie)
                                <div class="tt-grid-item isotope-item Residential">
                                    <div class="ttgr-item-inner">
                                        <div class="portfolio-grid-item">
                                            <div class="pgi-image-holder">
                                                <div class="pgi-image-inner tt-anim-zoomin">
                                                    <figure class="pgi-image ttgr-height">
                                                        <a href="{{ $categorie->children->count() > 0 
                                                            ? url('category/' . $categorie->{'link_' . $lang}) 
                                                            : url('category/' . $categorie->{'link_' . $lang} . '/projects') }}">
                                                            <img 
                                                                src="{{ asset('uploads/categories/source/' . $categorie->image) }}"
                                                                width="200" height="150" 
                                                                alt="{{ $categorie->{'name_' . $lang} }}" />
                                                        </a>
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="pgi-caption">
                                                <div class="pgi-caption-inner">
                                                    <h2 class="pgi-title">
                                                        <a href="{{ $categorie->children->count() > 0 
                                                            ? url('category/' . $categorie->{'link_' . $lang}) 
                                                            : url('category/' . $categorie->{'link_' . $lang} . '/projects') }}">
                                                            {{ $categorie->{'name_' . $lang} }}
                                                        </a>
                                                    </h2>
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
    <!--========================== Categories ==========================-->
@endif
