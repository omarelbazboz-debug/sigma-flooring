  <!-- choices css -->
  <link rel="stylesheet" href="{{URL::To('resources/assets/back/libs/choices.js/public/assets/styles/choices.min.css')}}" type="text/css" />

@if($type == 'category')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="categories">{{trans('home.category')}}</label>
        <select data-trigger  class="form-control type_value" name="type_value" id="type_value" >
            @foreach($categories as $category)
                <option value="{{ $category->id }}">@if(app()->getLocale() == 'en'){{ $category->name_en }}@else{{$category->name_ar}}@endif</option>
            @endforeach
        </select>
    </fieldset>

@elseif($type == 'product')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="products">{{trans('home.product')}}</label>
        <select data-trigger  class="form-control type_value" name="type_value" id="type_value" >
            @foreach($products as $product)
                <option value="{{ $product->id }}">@if(app()->getLocale() == 'en'){{ $product->name_en }}@else{{$product->name_ar}}@endif</option>
            @endforeach
        </select>
    </fieldset>

@elseif($type == 'brand')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="brands">{{trans('home.brand')}}</label>
        <select data-trigger  class="form-control type_value" name="type_value" id="type_value" >
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">@if(app()->getLocale() == 'en'){{ $brand->name_en }}@else{{$brand->name_ar}}@endif</option>
            @endforeach
        </select>
    </fieldset>
@elseif($type == 'service')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="users">{{trans('home.services')}}</label>
        <select data-trigger  class="form-control type_value" name="type_value" id="type_value" >
            @foreach($services as $service)
                <option value="{{$service -> id}}">{{(app()->getLocale() == 'en')?$service -> name_en:$service -> name_ar}}</option>
            @endforeach
        </select>
    </fieldset>
@elseif($type == 'project')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="projects">{{trans('home.projects')}}</label>
            <select data-trigger  class="form-control type_value" name="type_value" id="type_value" >
                @foreach($projects as $project)
                    <option value="{{$project -> id}}">@if(app()->getLocale() == 'en') {{$project-> name_en}}@else {{$project-> name_ar}} @endif</option>
                @endforeach
            </select>    
    </fieldset>
@elseif($type == 'pages')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="regions">{{trans('home.pages')}}</label>
        <select data-trigger  class="form-control   type_value" name="type_value"  id="type_value">
            @foreach($pages as $page)
                <option value="{{$page -> id}}">@if(app()->getLocale() == 'en') {{$page -> title_en}} @else {{$page -> title_ar}}@endif</option>
            @endforeach
        </select>
    </fieldset>
@elseif($type == 'link')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="regions">{{trans('home.link')}}</label>
        <input type="text" class="form-control type_value" placeholder="{{trans('home.link')}}" name="type_value">
    </fieldset>

@elseif($type == 'blog-item')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="blog_items">{{trans('home.blog_items')}}</label>
        <select data-trigger  class="form-control   type_value" name="type_value"  id="type_value">
            @foreach($blogItems as $blogItem)
                <option value="{{$blogItem -> id}}">@if(app()->getLocale() == 'en') {{$blogItem -> title_en}} @else {{$blogItem -> title_ar}}@endif</option>
            @endforeach
        </select>
    </fieldset>
    
@elseif($type == 'blog-category')
    <fieldset class="form-group">
        <label class="form-label font-size-13 text-muted"for="blog_categories">{{trans('home.blog_categories')}}</label>
        <select data-trigger  class="form-control   type_value" name="type_value"  id="type_value">
            @foreach($blogCategories as $blogCategory)
                <option value="{{$blogCategory -> id}}">@if(app()->getLocale() == 'en') {{$blogCategory -> title_en}} @else {{$blogCategory -> title_ar}}@endif</option>
            @endforeach
        </select>
    </fieldset>

@elseif($type == 'about-us')
    <fieldset class="form-group">
    </fieldset>
@elseif($type == 'contact-us')
    <fieldset class="form-group">
    </fieldset>
@elseif($type == 'deals')
    <fieldset class="form-group">
    </fieldset>
@elseif($type == 'featured')
    <fieldset class="form-group">
    </fieldset>  
    
@elseif($type == 'blogs')
<fieldset class="form-group">
</fieldset>

@elseif($type == 'services')
    <fieldset class="form-group">
    </fieldset>    
@elseif($type == 'projects')
    <fieldset class="form-group">
    </fieldset>  
    
@elseif($type == 'home')
    <fieldset class="form-group">
    </fieldset>  
@elseif($type == 'galleryVideos')
    <fieldset class="form-group">
    </fieldset>
    
@elseif($type == 'galleryImages')
    <fieldset class="form-group">
    </fieldset>
    
@endif



<!-- choices js -->
<script src="{{ URL::to('resources/assets/back/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{ URL::to('resources/assets/back/js/pages/form-advanced.init.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.type_value').click(function() {
            alert("تم النقر!");
        });
    });
</script>

