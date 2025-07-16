<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminController;

Route::group([
    'middleware' => [
        'web',
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
    ],
    'prefix' => LaravelLocalization::setLocale()
], function () {

    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
        Route::get('/', [AdminController::class, 'admin']);
        Route::get('translations', 'AdminController@translations');
        Route::get('/switch-theme', 'AdminController@switchTheme');
        Route::get('/switch-theme-topbar', 'AdminController@switchThemeTop');
        Route::get('/switch-theme-sidebar/{sidebar}', 'AdminController@switchThemeSidebar');
        Route::post('{name}/up/{ids}', 'AdminController@updatestatus');

        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('countries', 'CountryController');
        Route::resource('regions', 'RegionController');
        Route::resource('areas', 'AreaController');
        Route::resource('settings', 'SettingController');
        Route::resource('titles', 'TitleController');
        Route::resource('writers', 'WriterController');
        Route::resource('configrations', 'ConfigrationController');
        Route::resource('menus', 'MenuController');
        Route::resource('menu-items', 'MenuItemController');
        Route::post('menuTypeValue', 'MenuItemController@menuTypeValue')->name('menuTypeValue');
        Route::resource('intro-sliders', 'IntroSliderController');
        Route::resource('home-sliders', 'HomeSliderController');
        Route::resource('offers-sliders', 'OfferSliderController');
        Route::resource('services', 'ServiceController');
        Route::post('services/copy', 'ServiceController@copy')->name('servicesCopy');
        Route::post('services/deleteAllIMages','ServiceController@deleteAllIMages');
        Route::post('services/uploadImages', 'ServiceController@uploadImages');
        Route::post('services/removeUploadImages', 'ServiceController@removeUploadImages');
        Route::post('services/deleteImege', 'ServiceController@deleteImege');
        Route::get('editAbout','AboutController@editAbout')->name('admin.editAbout');
        Route::patch('about/update','AboutController@update')->name('admin.about.update');
        Route::resource('aboutStrucs', 'AboutStrucController');
        Route::resource('contact-us-messages', 'ContactusController');
        Route::resource('brands', 'BrandController');
        Route::resource('partners', 'PartnerController');
        Route::resource('pages', 'PageController');
        Route::resource('blog-categories', 'BlogCategoryController');
         Route::resource('categories', 'CategoryController');
        Route::resource('blog-items', 'BlogItemController');
        Route::post('blog-items/copy', 'BlogItemController@copy')->name('BlogItemCopy');
        Route::post('updateFaq', 'BlogItemController@updateFaq')->name('updateFaq');
        Route::post('removeFaq', 'BlogItemController@removeFaq')->name('removeFaq');
        Route::resource('home-images', 'HomeImageController');
        Route::resource('gallery-images', 'GalleryImageController');
        Route::post('gallery-images/deleteImege', 'GalleryImageController@deleteImege');
        Route::post('gallery-images/reorder','GalleryImageController@reorderImeges');
        Route::get('gallery-image/create-pluck','GalleryImageController@createPluck');
        Route::post('gallery-images/uploadImages','GalleryImageController@uploadImages');
        Route::post('gallery-images/removeUploadImages','GalleryImageController@removeUploadImages');
        Route::post('gallery-images/storePluck','GalleryImageController@storePluck');
        Route::resource('testimonials', 'TestimonialController');
        Route::resource('news-letters', 'NewsLetterController');
        Route::resource('projects', 'ProjectController');
        Route::post('projects/copy', 'ProjectController@copy')->name('ProjectsCopy');
        Route::post('projects/changeCategory/{id}', 'ProjectController@changeCategory');
        Route::post('projects/changeService/{id}', 'ProjectController@changeService');
        Route::post('album-images/deleteImage', 'AlbumItemController@deleteImage');
        Route::resource('albums', 'AlbumController');
        Route::post('albums/deleteAllIMages','AlbumItemController@deleteAllIMages');
        Route::post('albums/AlbumItemCopy','AlbumController@copy')->name('AlbumItemCopy');
        Route::resource('album-images', 'AlbumItemController');
        Route::post('album-images/uploadImages','AlbumItemController@uploadImages');
        Route::post('album-images/removeUploadImages','AlbumItemController@removeUploadImages');
        Route::post('projects/uploadImages', 'ProjectController@uploadImages');
        Route::post('projects/removeUploadImages', 'ProjectController@removeUploadImages');
        Route::post('projects/deleteImege', 'ProjectController@deleteImege');
        Route::post('projects/deleteAllIMages', 'ProjectController@deleteAllIMages');
        Route::resource('addresses', 'AddressController');
        Route::resource('gallery-videos', 'GalleryVideoController');
        Route::post('gallery-videos/reorder','GalleryVideoController@reorderVideos');
        Route::resource('seo-assistant', 'SeoAssistantContoller');
        Route::resource('faqs', 'FaqController');
        Route::get('editFaq', 'FaqController@editFaq');
        Route::post('storeFaq', 'FaqController@storeFaq');
        Route::post('updateGeneralFaq', 'FaqController@updateGeneralFaq')->name('updateGeneralFaq');
        Route::post('removeGeneralFaq', 'FaqController@removeGeneralFaq')->name('removeGeneralFaq');
        Route::resource('attributes', 'AttributeController');
        Route::post('removeAttributeValue', 'AttributeController@removeAttributeValue')->name('removeAttributeValue');
        Route::post('updateAttributeValue', 'AttributeController@updateAttributeValue')->name('updateAttributeValue');
        Route::resource('careers', 'CareerController');
        Route::resource('dates', 'DateController');
        Route::get('careers-applications', 'CareerController@getCareersApplications');
        Route::resource('phones', 'PhoneController');
        Route::resource('progresses', 'ProgressController');
        Route::resource('titles', 'TitleController');
    });

    Auth::routes();
    Route::get('/', [WebsiteController::class, 'home']);
    Route::get('about-us', [WebsiteController::class, 'aboutUs']);
    Route::get('contact-us', [WebsiteController::class, 'contactUs']);
Route::get('about-us','WebsiteController@aboutUs');
    Route::get('contact-us','WebsiteController@contactUs');
    Route::get('land','WebsiteController@landPage');
    Route::get('appointment','WebsiteController@appointment');
    Route::post('save/contact-us','WebsiteController@saveContactUs');
    Route::get('page/{link}','WebsiteController@getPage');
    // Route::get('/scan', [ScanController::class, 'scan']);


    Route::get('service/{link}', [WebsiteController::class, 'getServiceDetails']);
    Route::get('blog/{link}', [WebsiteController::class, 'getBlogPage']);
    Route::get('brand/{link}', [WebsiteController::class, 'getBrandPage']);
    Route::get('about-writer/{id}', [WebsiteController::class, 'getWriter'])->name('writer.details');
    Route::get('products', [WebsiteController::class, 'getservices']);
    Route::get('teams', [WebsiteController::class, 'getteams']);
    Route::get('galleryImages', [WebsiteController::class, 'getGalleryImages']);
    Route::get('beforeAfters', [WebsiteController::class, 'getBeforeAfters']);
    Route::get('blogs/{link?}', [WebsiteController::class, 'getBlogs']);
    Route::get('brands', [WebsiteController::class, 'getBrands']);
    Route::get('partners', [WebsiteController::class, 'getPartners']);
    Route::get('galleryVideos', [WebsiteController::class, 'getGalleryVideos']);

    Route::post('save/comment', [WebsiteController::class, 'saveComment'])->middleware('throttle:10,1');

    Route::post('/save/contact-us', [WebsiteController::class, 'saveContactUs'])->middleware('throttle:2,1');
    Route::get('profile', [App\Http\Controllers\WebsiteController::class, 'profile']);


    Route::get('projects','WebsiteController@getProjects');
    Route::get('categories','WebsiteController@getCategories');
    Route::get('developer/{link}/projects','WebsiteController@getDeveloperProjects');
    Route::get('category/{link}/projects','WebsiteController@getCategoryProjects');
    Route::get('recommended/projects','WebsiteController@getRecommendedProjects');
    Route::get('project/{link}','WebsiteController@getProductDetails');
    Route::get('search-for','WebsiteController@projectsSearchResults');
    Route::post('save-career-application','WebsiteController@saveCareerApplication');

    Route::get('searchAutoComplete','WebsiteController@autoCompletesearch');
    Route::post('save/training-applications','WebsiteController@saveTrainingApplications');

    Route::get('category/{link}', 'WebsiteController@getCategory');
    Route::get('service/{link}', [WebsiteController::class, 'albumDetails'])->name('album.details');
    Route::get('product/{link}', [WebsiteController::class, 'getServiceDetails'])->name('service.details');
    Route::get('testimonial', [WebsiteController::class, 'testimonialdetails'])->name('testimonialdetails');
    Route::get('services', [WebsiteController::class, 'album'])->name('albums');

    Route::get('{slug}', function ($slug) {
        $lang = app()->getLocale();
        $blog = \App\Models\BlogItem::where("link_$lang", $slug)->first();
        if ($blog) {
            return app(WebsiteController::class)->getBlogPage($slug);
        }

        $menu = \App\Models\MenuItem::where("link_$lang", $slug)->first();
        if ($menu) {
            return app(WebsiteController::class)->menus($slug);
        }

        abort(404);
    })->where('slug', '^[^/]+$');
});

Route::get('/clear-view', function () {
    Artisan::call('view:clear');
    return response()->json(['status' => 'success', 'message' => 'Cache cleared']);
})->middleware('check.cache.key');
