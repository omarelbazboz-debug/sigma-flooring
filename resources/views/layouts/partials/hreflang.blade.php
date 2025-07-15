@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar', 'service/'.$service->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar', 'project/'.$project->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar', 'page/'.$page->link_ar, [], true) }}" />
@else
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" />
@endif

@if(Request::segment(2) == 'service')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'service/'.$service->link_en, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'project/'.$project->link_en, [], true) }}"/>
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'page/'.$page->link_en, [], true) }}"/>
@else
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"/>
@endif

@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar', 'service/'.$service->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar', 'project/'.$project->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar', 'page/'.$page->link_ar, [], true) }}" />
@else
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" />
@endif

