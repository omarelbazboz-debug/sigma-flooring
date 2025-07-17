<?php

namespace App\Providers;

use App\Models\About;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use App\Models\AboutStruc;
use App\Models\Career;
use App\Models\Album;
use App\Models\Date;
use App\Models\HomeSlider;
use App\Models\Progress;
use App\Models\Phone;
use App\Models\Project;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Title;
use App\Models\Configration;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Category;
use App\Models\Service;
use App\Models\GalleryImage;
use App\Models\Address;
use App\Models\SeoAssistant;
use App\Models\BlogCategory;
use App\Models\Writer;
use App\Models\Brand;
use App\Models\Partner;
use App\Helpers\MenuHelper;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Cache;
use App\Models\BlogItem;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { {
            app()->setLocale('ar');
            LaravelLocalization::setLocale('ar');
        }
        ///////////////////////@truncate///////////////////
        Blade::directive('truncate', function ($expression) {
            return "<?php echo Helper::truncateHtml($expression); ?>";
        });


        ///////////////////////@truncate///////////////////
        Schema::defaultStringLength(191);
        // \URL::forceScheme('https');

        view()->composer('*', function ($view) {

            $segments = LaravelLocalization::getNonLocalizedURL(request()->fullUrl());
            $segments = explode('/', trim(parse_url($segments, PHP_URL_PATH), '/'));

            $currentLocale = LaravelLocalization::getCurrentLocale();
            $supportedLocales = LaravelLocalization::getSupportedLocales();

            $altLangLink = null;
            $altLangTitle = null;

            // 1. مقالات بدون /blog في الرابط مثل: /رابط-مباشر
            if (isset($segments[0]) && !isset($segments[1])) {
                foreach ($supportedLocales as $localeCode => $properties) {
                    if (($localeCode == 'ar' && $currentLocale == 'en') || ($localeCode == 'en' && $currentLocale == 'ar')) {
                        $slug = $segments[0];
                        $model = BlogItem::where("link_$currentLocale", $slug)->first();

                        if ($model) {
                            $link = $localeCode === 'ar' ? ($model->link_ar ?? null) : ($model->link_en ?? null);
                            $altLangTitle = $localeCode === 'ar'
                                ? ($model->title_ar ?? $model->link_ar)
                                : ($model->title_en ?? $model->link_en);

                            if ($link) {
                                $altLangLink = LaravelLocalization::getLocalizedURL($localeCode, $link, [], true);
                            }
                            break;
                        }
                    }
                }
            }

            // 2. روابط فيها نوع زي: /service/slug أو /blog/slug
            if (!$altLangLink && isset($segments[1]) && isset($segments[2])) {
                foreach ($supportedLocales as $localeCode => $properties) {
                    if (($localeCode == 'ar' && $currentLocale == 'en') || ($localeCode == 'en' && $currentLocale == 'ar')) {
                        $type = $segments[1];
                        $slug = $segments[2];
                        $model = $view->getData()[$type] ?? null;

                        if (!$model && in_array($type, ['blog', 'blogs'])) {
                            $model = BlogItem::where("link_$currentLocale", $slug)->first();
                        } elseif (!$model && in_array($type, ['service', 'services'])) {
                            $model = Service::where("link_$currentLocale", $slug)->first();
                        } elseif (!$model && in_array($type, ['product', 'products'])) {
                            $model = Project::where("link_$currentLocale", $slug)->first();
                        }

                        if ($model  && !($model instanceof \Illuminate\Support\Collection) && !is_array($model)) {
                            $link_ar = $model->link_ar ?? '';
                            $link_en = $model->link_en ?? '';
                            $title_ar = $model->title_ar ?? $link_ar;
                            $title_en = $model->title_en ?? $link_en;

                            // بناء الرابط البديل دائماً بنفس البادئة
                            if (($localeCode === 'ar' && $link_ar) || ($localeCode === 'en' && $link_en)) {
                                $link = null;
                                if (in_array($type, ['blog', 'blogs'])) {
                                    $link = 'blogs/' . ($localeCode === 'ar' ? $link_ar : $link_en);
                                } elseif (in_array($type, ['service', 'services'])) {
                                    $link = 'service/' . ($localeCode === 'ar' ? $link_ar : $link_en);
                                } elseif (in_array($type, ['product', 'products'])) {
                                    $link = 'product/' . ($localeCode === 'ar' ? $link_ar : $link_en);
                                }

                                $altLangTitle = $localeCode === 'ar' ? $title_ar : $title_en;

                                if ($link) {
                                    $altLangLink = LaravelLocalization::getLocalizedURL($localeCode, $link, [], true);

                                }
                            }
                            break;
                        }
                    }
                }
            }

            // 3. fallback في حالة لم يتم إيجاد موديل
            if (!$altLangLink) {
                foreach ($supportedLocales as $localeCode => $properties) {
                    if (($localeCode == 'ar' && $currentLocale == 'en') || ($localeCode == 'en' && $currentLocale == 'ar')) {
                        $altLangLink = LaravelLocalization::getLocalizedURL($localeCode, null, [], true);

                        $altLangTitle = null;
                        break;
                    }
                }
            }

            // مشاركة النتيجة مع جميع الـ views
            view()->share([
                'altLangLink' => $altLangLink,
                'altLangTitle' => $altLangTitle
            ]);
            $setting = Setting::first();
            $seo = SeoAssistant::first();
            $writers = Writer::where('status', 1)->get();
            $lang = LaravelLocalization::getCurrentLocale();
            App::setlocale($lang);
            $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
            $configration = Configration::where('lang', $lang)->first();
            $services = Cache::remember('services_' . $lang, 60 * 24, function () {
                return Service::where('menu', 1)->where('status', 1)->where('parent_id', 0)->orderBy('order', 'ASC')->take(6)->get();
            });
            $menuServices = Cache::remember('menuServices_' . $lang, 60 * 24, function () {
                return Service::where('status', 1)->where('parent_id', 0)->orderBy('order', 'ASC')->take(6)->get();
            });
            $blogs = Cache::remember('blogs_' . $lang, 60 * 24, function () {
                return BlogItem::where('status', 1)->orderBy('order', 'ASC')->get();
            });
            $menus = Cache::remember('menus_' . $lang, 60 * 24, function () use ($menuServices) {
                $menus = MenuItem::where('status', 1)->where('parent_id', 0)->orderBy('order', 'ASC')->get();
                return MenuHelper::prepareMenus($menus, $menuServices);
            });
            $footerMenus = MenuItem::where('menu_id', 2)->where('status', 1)->where('parent_id', 0)->orderBy('order', 'ASC')->get();
            $pages = Page::where('status', 1)->get();
            $albums = Album::where('status', 1)->get();
            $galleryImages = GalleryImage::where('status', 1)->orderBy('order', 'asc')->take(6)->get();
            $projects = Project::where('status', 1)->where('recommended', 1)->get();
            $sliders = Cache::remember('sliders_' . $lang, 60 * 24, function () use ($lang) {
                return HomeSlider::where('lang', $lang)->where('status', 1)->get();
            });


            $menuCategories = Category::where('menu', 1)->where('status', 1)->get();
            $brands = Brand::where('status', 1)->orderBy('order', 'ASC')->get();
            $partners = Partner::where('status', 1)->orderBy('order', 'ASC')->get();
            $lang = App::getLocale();
            $addresses = Address::where('status', 1)->get();
            $statements = Career::where('status', 1)->where('type', 'header')->get();
            $dates = Date::where('status', 1)->orderBy('order', 'ASC')->get();
            $phones = Phone::where('status', 1)->orderBy('order', 'ASC')->get();
            $progresses = Progress::where('status', 1)->orderBy('order', 'ASC')->get();
            $progressesChunks = $progresses->chunk(3);
            // dd($titles);
            $title = Title::first();
            $custom_products = Project::where('status', 1)->where('recommended', 1)->get();
            $aboutStrucs  = AboutStruc::where('status', 1)->get();
            $about = About::first();
            $secType  = new Career;
            $sliderCount = 1;
            $subServices = Service::whereNotNull('parent_id')->where('status', 1)->get();
            $types = ['philosophy', 'album', 'catalogue', 'news', 'careers', 'projects', 'about', 'services', 'gallery', 'contact', 'blogs', 'reviews', 'whyus', 'teams', 'skills', 'vedios', 'aboutStruc', 'brand', 'testimonial', 'footer', 'slider', 'date'];

            $titles = Title::where('status', 1)->whereIn('type', $types)->get();

            $aboutTitle = $titles->where('type', 'about');
            $philosophyTitle = $titles->where('type', 'philosophy');
            $albumTitle = $titles->where('type', 'album');
            $blogsTitle = $titles->where('type', 'blogs');
            $contactTitle = $titles->where('type', 'contact');
            $careersTitle = $titles->where('type', 'careers');
            $newsTitle = $titles->where('type', 'news');
            $projectsTitle = $titles->where('type', 'projects');
            $catalogueTitle = $titles->where('type', 'catalogue');
            $servicesTitle = $titles->where('type', 'services');
            $galleryTitle = $titles->where('type', 'gallery');
            $reviewsTitle = $titles->where('type', 'reviews');
            $whyusTitle = $titles->where('type', 'whyus');
            $teamsTitle = $titles->where('type', 'teams');
            $skillsTitle = $titles->where('type', 'skills');
            $vediosTitle = $titles->where('type', 'vedios');
            $aboutStrucTitle = $titles->where('type', 'aboutStruc');
            $brandTitle = $titles->where('type', 'brand');
            $testimonialTitle = $titles->where('type', 'testimonial');
            $footerTitle = $titles->where('type', 'footer');
            $sliderTitle = $titles->where('type', 'slider');
            $dateTitle = $titles->where('type', 'date');
             $productsTitle = $titles->where('type', 'products');


            $menus = MenuHelper::prepareMenus($menus, $menuServices ?? null);

            App::setlocale($lang);
            View::share('language', $lang);
            View::share('sliderCount', $sliderCount);
            View::share('services', $services);
            View::share('menuServices', $menuServices);
            View::share('blogs', $blogs);
            View::share('projects', $projects);
            View::share('sliders', $sliders);
            View::share('setting', $setting);
            View::share('titles', $titles);
            View::share('title', $title);
            View::share('aboutTitle', $aboutTitle);
            View::share('philosophyTitle', $philosophyTitle);
            View::share('albumTitle', $albumTitle);
            View::share('blogsTitle', $blogsTitle);
            View::share('catalogueTitle', $catalogueTitle);
            View::share('contactTitle', $contactTitle);
            View::share('careersTitle', $careersTitle);
            View::share('newsTitle', $newsTitle);
            View::share('projectsTitle', $projectsTitle);
            View::share('servicesTitle', $servicesTitle);
            View::share('galleryTitle', $galleryTitle);
            View::share('reviewsTitle', $reviewsTitle);
            View::share('whyusTitle', $whyusTitle);
            View::share('teamsTitle', $teamsTitle);
            View::share('skillsTitle', $skillsTitle);
            View::share('vediosTitle', $vediosTitle);
            View::share('aboutStrucTitle', $aboutStrucTitle);
            View::share('brandTitle', $brandTitle);
            View::share('testimonialTitle', $testimonialTitle);
            View::share('footerTitle', $footerTitle);
            View::share('sliderTitle', $sliderTitle);
            View::share('dateTitle', $dateTitle);
            View::share('configration', $configration);
            View::share('menus', $menus);
            View::share('pages', $pages);
            View::share('lang', $lang);
            View::share('galleryImages', $galleryImages);
            View::share('blogCategories', $blogCategories);
            View::share('addresses', $addresses);
            View::share('writers', $writers);
            View::share('seo', $seo);
            View::share('footerMenus', $footerMenus);
            View::share('menuCategories', $menuCategories);
            View::share('brands', $brands);
            View::share('partners', $partners);
            View::share('statements', $statements);
            View::share('dates', $dates);
            View::share('albums', $albums);
            View::share('phones', $phones);
            View::share('progresses', $progresses);
            View::share('custom_products', $custom_products);
            View::share('menuServices', $menuServices);
            View::share('aboutStrucs', $aboutStrucs);
            View::share('about', $about);
            View::share('secType', $secType);
            View::share('progressesChunks', $progressesChunks);
            View::share('productsTitle', $productsTitle);
            View::share('firstAddress', $addresses->first() ? $addresses->first() : $configration->address1); // Share the first address with all views

            // Social Media Links
            $socialMediaLinks = [
                'whatsapp' => isset($setting->whatsapp) && $setting->whatsapp ? 'https://wa.me/+2' . ltrim($setting->whatsapp, '+') : '#',
                'facebook' => $setting->facebook ?? '#',
                'twitter' => $setting->twitter ?? '#',
                'instagram' => $setting->instagram ?? '#',
                'youtube' => $setting->youtube ?? '#',
                'linkedin' => $setting->linkedin ?? '#',
                'tiktok' => $setting->tiktok ?? '#',
            ];
            $view->with('socialMediaLinks', $socialMediaLinks);
        });
    }
}
