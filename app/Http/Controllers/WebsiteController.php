<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\IntroSlider;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\Category;
use App\Models\HomeImage;
use App\Models\MenuItem;
use App\Models\Service;
use App\Models\Project;
use App\Models\Page;
use App\Models\AboutStruc;
use App\Models\About;
use App\Models\Album;
use App\Models\ContactUs;
use App\Models\Setting;
use App\Models\Title;
use App\Models\BlogCategory;
use App\Models\Team;
use App\Models\BlogItem;
use App\Models\GalleryImage;
use App\Models\BeforeAfter;
use App\Models\GalleryVideo;
use App\Models\SeoAssistant;
use App\Models\Configration;
use Melbahja\Seo\Schema;
use Melbahja\Seo\Schema\Thing;
use Melbahja\Seo\MetaTags;
use App\Models\Faq;
use App\Models\Comment;
use App\Models\Writer;
use App\Models\Brand;
use App\Models\Partner;
use App\Traits\SeoTrait;
use App\Support\Collection;
use App\Models\Career;
use App\Models\Date;
use App\Models\CareerApplication;
use App\Models\Phone;
use App\Models\TrainingApplication;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    use SeoTrait;
    public function checkUrl($slug)
    {
        $checkMenu = MenuItem::where('type', $slug)->first();
        // $checkBlog = BlogItem::where('link_en', $slug)->orWhere('link_ar', $slug)->first();
        // $checkService = Service::where('link_en',$slug)->orWhere('link_ar',$slug)->first();
        // $checkProject = Project::where('link_en', $slug)->orWhere('link_ar', $slug)->first();

        if ($checkMenu) {
            return $this->menus($checkMenu->type);
        } else {
            abort('404');
        }
    }

    //////// function retun dynamic menu//////////
    public function menus($menu)
    {
        $menu = MenuItem::where('type', $menu)->first();
        $lang = LaravelLocalization::getCurrentLocale();

        if (!$menu) {
            abort(404);
        } elseif ($menu->type == 'home') {
            return $this->home();
        } elseif ($menu->type == 'about-us') {
            return $this->aboutUs();
        } elseif ($menu->type == 'contact-us') {
            return $this->contactUs();
        } elseif ($menu->type == 'projects') {
            return $this->getProjects();
        } elseif ($menu->type == 'services') {
            return $this->getservices();
        } elseif ($menu->type == 'galleryImages') {
            return $this->getGalleryImages();
        } elseif ($menu->type == 'galleryVideos') {
            return $this->getGalleryVideos();
        } elseif ($menu->type == 'blogs') {
            return $this->getBlogs();
        } elseif ($menu->type == 'careers') {
            return $this->getCareersPage();
        } elseif ($menu->type == 'training') {
            return $this->applyTrainingPage();
        } elseif ($menu->type == 'developers') {
            return $this->developersPage();
        } else {
            abort(404);
        }
    }

    ////////////// function returnindex page///////////
    public function home()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $intro_sliders = IntroSlider::where('lang', $lang)->where('status', 1)->get();
        $sliders = HomeSlider::where('lang', $lang)->where('status', 1)->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->whereHas('childs')->take(4)->get();
        $blogs = BlogItem::where('status', 1)->take(3)->get();
        $categories = Category::where('status', 1)->where('home', 1)->get();
        $about = About::first();
        $brands = Brand::where('status', 1)->orderBy('order', 'ASC')->get();
        $partners = Partner::where('status', 1)->orderBy('order', 'ASC')->get();
        $testimonials = Testimonial::where('status', 1)->where('lang', $lang)->get();
        $teams = Team::where('lang', $lang)->where('status', 1)->get();
        $projects = Project::where('status', 1)->orderBy('order', 'ASC')->get();
        // dd($projects);
        $galleryImages = GalleryImage::where('status', 1)->orderBy('order', 'asc')->take(6)->get();
        $careers = Career::where('status', 1)->orderBy('order', 'ASC')->get();
        $secType = new Career;
        $titles = Title::where('status', 1)->orderBy('order', 'ASC')->get();
        $secType = new Title;
        $homeImages = HomeImage::get();
        $videos = GalleryVideo::where('status', 1)->orderBy('order', 'asc')->get();
        ////// seo script//////
        list($schema, $metatags) = $this->homePageSeo();

        return view('website.home', compact('careers','partners','secType', 'homeImages','teams', 'intro_sliders', 'sliders', 'galleryImages', 'services', 'about', 'testimonials', 'projects', 'blogs', 'schema', 'metatags', 'categories', 'brands' , 'videos' ));
    }

    public function getWriter($id)
    {
        $writer = Writer::find($id);
        $blogss = BlogItem::where('status', 1)->where('writer_id', $id)->get();
        $lang = LaravelLocalization::getCurrentLocale();
        $about = About::first();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $title = Title::first();
        $seo = SeoAssistant::first();
        $schema1 = new Thing('LocalBusiness', [
            'name' => $configration->app_name,
            'url' => LaravelLocalization::localizeUrl('/'),
            'image' => url("uploads/settings/source/$configration->app_logo"),
            'telephone' => $setting->mobile,
            'address' => $configration->address1,
        ]);


        $schema2 = new Thing('Organization', [
            'url' => LaravelLocalization::localizeUrl('/'),
            'logo' => url("uploads/settings/source/$configration->app_logo"),
            'contactPoint' => new Thing('ContactPoint', [
                'telephone' => $setting->mobile,
                'contactType' => 'customer service'
            ]),
        ]);

        $schema = new Schema(
            $schema1,
            $schema2
        );

        $metatags = new MetaTags();
        $metatags
            ->title(($seo->home_meta_title) ? $seo->home_meta_title : $configration->app_name)
            ->meta('title', ($seo->home_meta_title) ? $seo->home_meta_title : $configration->app_name)
            ->description(($seo->home_meta_desc) ? $seo->home_meta_desc : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(url("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/'))
            ->canonical(LaravelLocalization::localizeUrl('/'))
            ->shortlink(LaravelLocalization::localizeUrl('/'))
            ->meta('robots', ($seo->home_meta_robots) ? 'index' : 'noindex');


        return view('website.writer_details', compact('writer', 'metatags', 'blogss', 'schema', 'setting', 'lang', 'seo'));
    }

    ////////////FUNCTION RETURN VIEW ABOUT US//////
    public function aboutUs()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $about = About::first();
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $aboutStrucs = AboutStruc::where('status', 1)->orderBy('order' , 'ASC')->get();
        // $statments = Career::where('status', 1)->where('type', 'statistics')->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->get();
        $testimonials = Testimonial::where('status', 1)->where('lang', $lang)->get();
        $teams = Team::where('lang', $lang)->where('status', 1)->get();
        $sliderCount = 1;
        $slidercount = 1;
        // $careers = Career::where('status', 1)->orderBy('order', 'ASC')->get();
        ////// seo script//////
        list($schema, $metatags) = $this->aboutUsPageSeo();
        return view('website.about-us', compact('lang', 'about' , 'aboutStrucs', 'metatags', 'schema', 'services', 'blogCategories', 'teams', 'testimonials', 'sliderCount', 'slidercount'));
    }

    ////////////FUNCTION RETURN VIEW CONTACT US//////
    public function contactUs()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $addresses = Address::where('status', 1)->get();
        $contact_messagges = Page::where('status', 1)->orderBy('id')->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->get();
        $teams = Team::where('lang', $lang)->where('status', 1)->get();
        ////// seo script//////
        list($schema, $metatags) = $this->contactUsPageSeo();
        return view('website.contact-us', compact('teams','lang', 'addresses', 'schema', 'contact_messagges', 'metatags', 'blogCategories', 'services'));
    }
    public function appointment()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $addresses = Address::where('status', 1)->get();
        $contact_messagges = Page::where('status', 1)->orderBy('id')->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->get();
        ////// seo script//////
        list($schema, $metatags) = $this->contactUsPageSeo();
        return view('website.appointment', compact('lang', 'addresses', 'schema', 'contact_messagges', 'metatags', 'blogCategories', 'services'));
    }

    ////////////// function saveContact //////////
public function saveContactUs(Request $request)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('recaptcha_token'), // <-- هنا التغيير
            'remoteip' => $request->ip(),
        ]);

        if (!($response->json('success') && $response->json('score') >= 0.5)) {
            return back()->withErrors(['captcha' => 'reCAPTCHA validation failed'])->withInput();
        }

        if ($request->filled('honeypot')) {
            return back()->withErrors(['error' => 'Spam detected.']);
        }

        $request->validate([
            'name' => 'required|max:150',
            'email' => 'nullable|email',
            'message' => 'required|string|max:1000',
            'phone' => 'required|regex:/^[\+]?[0-9]{9,15}$/',
            'service' => 'nullable|string|max:150',
            'project_id' => 'nullable|exists:projects,id',
            'project_name' => 'nullable|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'service_name' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'height' => 'nullable|string|max:255',
            'number-floors' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:255',
            'system' => 'nullable|string|max:100',
        ]);

        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->service = $request->service;
        $contact->project_id = $request->project_id;
        $contact->project_name = $request->project_name;
        $contact->service_id = $request->service_id;
        $contact->service_name = $request->service_name;
        $contact->area = $request->area;
        $contact->height = $request->height;
        $contact->number_floors = $request->{'number-floors'};
        $contact->size = $request->size;
        $contact->system = $request->system;
        $contact->save();

        $data = [
            'contact' => $contact,
            'project_name' => $request->project_name,
            'project_id' => $request->project_id,
            'service_name' => $request->service_name,
            'service_id' => $request->service_id,
            'area' => $request->area,
            'height' => $request->height,
            'number_floors' => $request->{'number-floors'},
            'size' => $request->size,
            'system' => $request->system,
        ];

        $setting = Setting::first();
        Mail::send('emails/contact_email', $data, function ($msg) use ($setting, $request) {
            $subject = 'HyedPark - ';
            if ($request->project_name && $request->service_name) {
                $subject .= 'Project: ' . $request->project_name . ' | Service: ' . $request->service_name;
            } elseif ($request->project_name) {
                $subject .= 'Project: ' . $request->project_name;
            } elseif ($request->service_name) {
                $subject .= 'Service: ' . $request->service_name;
            } else {
                $subject .= 'New Contact';
            }

            $msg->to([$setting->contact_email], 'Booking Appointment')->subject($subject);
            $msg->cc(['ahmed.essam.be@gmail.com','egypeto81@gmail.com']);
            $msg->from(config('mail.from.address'), config('mail.from.name'));
        });

        $formattedData = [
            [
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'message' => $contact->message,
                'service' => $contact->service,
                'project_id' => $contact->project_id,
                'project_name' => $contact->project_name,
                'service_id' => $contact->service_id,
                'service_name' => $contact->service_name,
                'area' => $contact->area,
                'height' => $contact->height,
                'number_floors' => $contact->number_floors,
                'size' => $contact->size,
                'system' => $contact->system,
            ]
        ];

        $sheetResponse = Http::asJson()->post('#', ['data' => $formattedData]);

        if ($sheetResponse->failed()) {
            dd($sheetResponse->body()); // عرض محتوى الاستجابة
            return back()->withErrors(['error' => 'Failed to send data to SheetDB.']);
        }

        return back()->with(['contact_message' => trans('home.Thank you for contacting us. A customer service officer will contact you soon')]);
    }

    ////////// FUNCTION RETURN PAGE INFORMATION /////////
    public function getPage($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $page = Page::where('link_en', $link)->orwhere('link_ar', $link)->first();
        return view('website.page', compact('lang', 'page'));
    }

    /////////////////////FUNCTION RETURN VIEW BLOGS ///////////
public function getBlogs($link = null)
{
    $lang = LaravelLocalization::getCurrentLocale();

    $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
    $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->take(6)->get();

    if ($link) {
        $blogCategory = BlogCategory::where("link_$lang", $link)->first();

        if (!$blogCategory) {
            abort(404);
        }

        $blogs = BlogItem::where('blogcategory_id', $blogCategory->id)->where('status', 1)->get();
        list($metatags) = $this->CategoryBlogsPageSeo($link);
        return view('website.category-blogs', compact('lang', 'blogCategory', 'blogs', 'metatags', 'services', 'blogCategories'));
    }

    $blogs = BlogItem::where('status', 1)->get();
    list($metatags) = $this->blogsPageSeo();
    return view('website.blogs', compact('lang', 'blogs', 'metatags', 'services', 'blogCategories'));
}


    /////////////////////FUNCTION RETURN VIEW BLOG ///////////
public function getBlogPage($link)
{
    $lang = LaravelLocalization::getCurrentLocale();

    $blog = BlogItem::where("link_$lang", $link)->first();

    if (!$blog) {
        abort(404);
    }

    $blog->increment('n_seen');

    $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
    $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
    $faqs = Faq::where('type', 'blog_item')->where('blog_item_id', $blog->id)->get();
    $blogs = BlogItem::where('status', 1)->take(6)->get();
    $comments = Comment::where('type', 'blog')->where('type_id', $blog->id)->where('admin_approve', 1)->get();
    $nextBlog = BlogItem::where('id', '>', $blog->id)->where('status', 1)->orderBy('id')->first();
    $previousBlog = BlogItem::where('id', '<', $blog->id)->where('status', 1)->orderByDesc('id')->first();
    $teams = Team::where('lang', $lang)->where('status', 1)->get();

    // SEO
    list($schema, $metatags) = $this->blogSeo($link);

    return view('website.blog_details', compact(
        'teams', 'blog', 'schema', 'metatags', 'faqs',
        'comments', 'blogs', 'services', 'blogCategories',
        'nextBlog', 'previousBlog'
    ));
}

    /////////////////////FUNCTION RETURN VIEW Brad ///////////
    public function getBrandPage($link)
    {
        $brand = Brand::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $products = Project::where('status', 1)->where('brand_id', $brand->id)->get();
        $brands = Brand::where('status', 1)->take(6)->get();
        ////// seo script//////
        list($schema, $metatags) = $this->brandSeo($link);
        return view('website.brandPage', compact('brand', 'products', 'schema', 'metatags', 'brands'));
    }

    ////////// function return list of published Brands/////
    public function getBrands()
    {
        $brands = Brand::where('status', 1)->orderBy('order', 'ASC')->get();
        ////// seo script//////
        list($metatags) = $this->brandsPageSeo();
        return view('website.brands', compact('brands', 'metatags'));
    }
    public function getPartners()
    {
        $partners = Partner::where('status', 1)->orderBy('order', 'ASC')->get();
        ////// seo script//////
        return view('website.partners', compact('partners'));
    }
    ////////// function return list of published products/////
    public function getProjects()
    {
        // $projects =Project::where('status',1)->get();
        $categories = Category::where('status', 1)->get();
        $projects = Project::where('status', 1)->orderBy('order', 'ASC')->get();
        $services = Service::where('status', 1)->orderBy('order', 'ASC')->get();

        $condition = 'medium';

        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.projects', compact('categories', 'metatags', 'projects', 'condition' , 'services'));
        // return view('website.products',compact('projects','metatags'));
    }

    ////////// function return project Details /////
    public function getProductDetails($link)
    {
        $project = Project::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $category_id = request()->get('category_id');
        $nextProject = Project::where('id', '>', $project->id)->where('status', 1)->orderBy('id')->first();
        $previousProject = Project::where('id', '<', $project->id)->where('status', 1)->orderByDesc('id')->first();

        if (!$nextProject) {
            $nextProject = Project::where('status', 1)->orderBy('id')->first();
        }
        if (!$previousProject) {
            $previousProject = Project::where('status', 1)->orderBy('id')->first();
        }
        if ($project) {
            $new_Projects = Project::where('updated_at', '>', Carbon::now()->subDays(30))->where('category_id', $project->category_id)->orderBy('id')->take(6)->get();

            list($schema, $metatags) = $this->projectPageSeo($link);
            return view('website.project-details', compact('project', 'new_Projects', 'schema', 'metatags', 'nextProject' , 'previousProject' , 'category_id'));
        } else {
            abort('404');
        }
    }

    ////////// function return list of published services/////
    public function getservices()
    {
        $services = Service::where('status', 1)->orderBy('order');
        if($parent_link = request('parent')){
            $parentService = Service::where('link_en', $parent_link)->orWhere('link_ar', $parent_link)->first();
            if (!$parentService) {
                abort(404);
            }
            $services = $services->where('parent_id', $parentService->id);

        } else {
            $services = $services->where('parent_id', 0);
        }
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $careers = Career::where('status', 1)->orderBy('order', 'ASC')->get();
        $about = About::first();
        $services = $services->get();
        ////// seo script//////
        list($metatags) = $this->servicesPageSeo();
        return view('website.products', compact('services', 'metatags', 'blogCategories', 'about', 'careers'));
    }
    public function getteams()
    {   $lang = LaravelLocalization::getCurrentLocale();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->get();
        $teams = Team::where('lang', $lang)->where('status', 1)->get();

        ////// seo script//////
        list($metatags) = $this->servicesPageSeo();
        return view('website.teams', compact('services', 'metatags', 'teams', 'lang'));
    }

    public function getServiceDetails($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $service = Service::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $projects = Project::where('status', 1)->where('service_id', $service->id)->get();
        $teams = Team::where('lang', $lang)->where('status', 1)->get();

        if (!$service) {
            abort(404);
        }
        $projects = Project::where('service_id', $service->id)->where('status', 1)->get();
        $subServices = Service::where('parent_id', $service->id)->where('status', 1)->get();
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $about = About::first();

        if ($service) {
            $faqs = Faq::where('type', 'service')->where('service_id', $service->id)->get();
            $related_services = Service::where('parent_id', 0)->where('status', 1)
            ->orderBy('order')->whereNot('id',$service->id)->whereDoesntHave('childs')
            ->get();
            $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
            $projects = Project::where('status', 1)->get();
            $nextService = Service::where('id', '>', $service->id)->where('status', 1)->orderBy('id')->first();
            $previousService = Service::where('id', '<', $service->id)->where('status', 1)->orderByDesc('id')->first();
            $features = \App\Models\Feature::all();
            $about = About::first();
            ////// seo script//////
            list($schema, $metatags) = $this->serviceSeo($link);
            return view('website.product-details', compact('lang','teams','service', 'related_services', 'metatags', 'schema', 'faqs', 'blogCategories', 'about', 'projects','features'));
        } else {
            abort(404);
        }
    }

    public function getGalleryImages()
    {
        $galleryImages = GalleryImage::where('status', 1)->orderBy('order', 'asc')->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
        $videos = GalleryVideo::where('status', 1)->orderBy('order', 'asc')->get();
        ////// seo script//////
        list($schema, $metatags) = $this->galleryImagesPageSeo();
        return view('website.gallery-images', compact('videos','metatags', 'schema', 'services', 'galleryImages'));
    }
    public function getBeforeAfters()
    {
        $beforeAfters = BeforeAfter::where('status', 1)->orderBy('order', 'asc')->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
        ////// seo script//////
        list($schema, $metatags) = $this->beforeAftersPageSeo();
        return view('website.beforeAfters', compact('metatags', 'schema', 'services', 'beforeAfters'));
    }

    public function getGalleryVideos()
    {
        $videos = GalleryVideo::where('status', 1)->orderBy('order', 'asc')->get();
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $services = Service::where('parent_id', 0)->where('status', 1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
        ////// seo script//////
        list($schema, $metatags) = $this->galleryVideosPageSeo();
        return view('website.gallery-videos', compact('videos', 'metatags', 'schema', 'blogCategories', 'services'));
    }

    public function saveComment(Request $request)
    {
        $add = new Comment();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->comment = $request->comment;
        $add->type = $request->type;
        $add->type_id = $request->type_id;
        $add->save();
        return back()->with(['success' => trans('home.Thank you for your Comment , your commnet under review')]);

    }




    public function getDeveloperProjects($link)
    {
        $developer = Brand::where('link_en', $link)->orwhere('link_ar', $link)->first();

        $projects = Project::where('brand_id', $developer->id)->where('status', 1)->get();
        $projects = (new Collection($projects))->paginate(18);
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.developer-project', compact('projects', 'metatags', 'developer'));
    }


    public function projectsSearchResults(Request $request)
    {

        $projects = Project::where('status', 1)->whereBetween('price', [intval($request->from) - 1, intval($request->to) + 1])->get();

        if ($request->project_name) {
            $projects = Project::where('status', 1)->whereBetween('price', [intval($request->from) - 1, intval($request->to) + 1]);
            $projects = $projects->where('name_en', 'like', '%' . $request->project_name . '%')->orwhere('name_ar', 'like', '%' . $request->project_name . '%')->get();
        }

        if ($request->region_id) {
            $projects = Project::where('status', 1)->whereBetween('price', [intval($request->from) - 1, intval($request->to) + 1]);
            $projects = $projects->where('name_en', $request->region_id)->get();
        }

        if ($request->developer_id) {
            $projects = Project::where('status', 1)->whereBetween('price', [intval($request->from) - 1, intval($request->to) + 1]);
            $projects = $projects->where('brand_id', $request->developer_id)->get();
        }

        if ($request->project_area) {
            $projects = Project::where('status', 1)->whereBetween('price', [intval($request->from) - 1, intval($request->to) + 1]);
            $projects = $projects->where('project_area', $request->project_area)->get();
        }
        $projects = (new Collection($projects))->paginate(18);

        return view('website.search-results', compact('projects'));
    }

    public function getRecommendedProjects()
    {
        $projects = Project::where('status', 1)->where('recommended', 1)->get();
        $recommendedProjects = (new Collection($projects))->paginate(18);
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.all-recommended-projects', compact('recommendedProjects', 'metatags'));
    }


    public function getCategoryProjects($link)
    {
        $category = Category::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $projects = Project::where('status', 1)->where('category_id', $category->id)->get();
        $categories = Category::where('status',1)->where('home',1)->take(3)->get();

        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.projects', compact('projects', 'metatags', 'category' ,'categories'));
    }

    public function getCategoryProducts($link){
        $category = Category::where('link_en',$link)->orwhere('link_ar',$link)->first();
        $projects =Project::where('status',1)->where('category_id',$category->id)->get();
          $categories = Category::where('status',1)->where('home',1)->take(3)->get();
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.category_projects',compact('projects','metatags','category','categories'));
    }

    public function getCareersPage()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $careers = Career::where('status', 1)->orderBy('order', 'ASC')->get();
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.careers', compact('careers', 'metatags', 'lang'));
    }
    public function getDatesPage()
    {
        $dates = Date::where('status', 1)->get();
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.dates', compact('dates', 'metatags'));
    }
    public function getPhonesPage()
    {
        $phones = Phone::where('status', 1)->get();
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.phones', compact('phones', 'metatags'));
    }
    public function applyTrainingPage()
    {
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.apply-training', compact('metatags'));
    }

    public function developersPage()
    {
        ////// seo script//////
        list($metatags) = $this->projectsPageSeo();
        return view('website.developers', compact('metatags'));
    }


    public function saveCareerApplication(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'nullable|email',
            'notes' => 'nullable',
            'position' => 'nullable',
            'phone' => 'required|regex:/^[\+]?[0-9]{9,15}$/',
            'file' => 'nullable|mimes:pdf,docx|max:10240',
        ]);

        $add = new CareerApplication();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->notes = $request->notes;
        $add->position = $request->position;
        dd($request);

        if ($request->file('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();

            $folderPath = public_path('uploads/careers/pdfs');

            $file = $request->file('file')->move($folderPath, $fileName);

            $add->file = $fileName;
        }

        $add->save();

        return back()->with(['success' => trans('home.Thank you for contacting us. A customer service officer will contact you soon')]);
    }



    public function saveTrainingApplications(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email',
            'notes' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
        ]);

        $add = new TrainingApplication();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->notes = $request->notes;
        $add->training = $request->training;
        $add->save();

        //         $data = array('contact' => $contact);
        //         $setting = Setting::first();
        // 	    Mail::send('emails/contact_email', $data, function($msg) use ($setting) {
        //   			$msg->to([$setting ->contact_email,'support@waelsakrplastic.com'], 'Booking Appointement')->subject('Booking');
        //   			$msg->cc(['begroup.seo@gmail.com','ahmed.essam.be@gmail.com']);
        //   			$msg->from(config('mail.from.address'),config('mail.from.name'));
        // 		});
        return back()->with(['success' => trans('home.Thank you for contacting us. A customer service officer will contact you soon')]);

    }

    //////////////////// search auto complete function ///////////////////
    public function autoCompletesearch()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $text = $_GET['phrase'];
        $projects = Project::where('name_en', 'like', '%' . $text . '%')->orwhere('name_ar', 'like', '%' . $text . '%')->where('status', 1)->get();
        $results = [];
        foreach ($projects as $query) {
            if ($lang == 'en') {
                $results[] = ['name' => $query->name_en];
            } else {
                $results[] = ['name' => $query->name_ar];
            }
        }
        return response()->json($results);
    }

    public function getCategories(){
        $categories = Category::where('parent_id',0)->where('status',1)->get();

        list($metatags) = $this->projectsPageSeo();

        return view('website.categories',compact('categories' , 'metatags' ));
    }
    public function getSubCategories($link = null)
    {
        $category = Category::where('link_en',$link)->orwhere('link_ar',$link)->first();
        $category_id = $category->id ?? null;
        if (isset($category_id)) {
            $sub_categories = Category::where('parent_id', $category_id)
                ->where('status', 1)
                ->get();
        } else {
            $sub_categories = Category::where('parent_id','!=' ,0)
                ->where('status', 1)
                ->get();
        }

        return view('website.sub-category', compact('sub_categories'));
    }

     public function maintenance(){
        $categories =  Category::where('status',1)->get();
        // list($schema, $metatags) = $this->contactUsPageSeo();
        return view('website.maintenance',compact('categories'));
    }

public function getCategory($link)
{
    $category = \App\Models\Category::where('link_en', $link)
        ->orWhere('link_ar', $link)
        ->with(['children' => function($q) {
            $q->where('status', 1);
        }])
        ->firstOrFail();
        $categories =  Category::where('status',1)->get();

    $sub_categories = $category->children;

    list($metatags) = $this->projectsPageSeo();

    return view('website.subcategory', compact('category', 'sub_categories', 'metatags' , 'categories'));
}

public function profile()
{
    $setting = Setting::first();
    list($schema, $metatags) = $this->contactUsPageSeo();
    return view('website.profile', compact('setting' , 'metatags', 'schema'));
}

public function album()
{
    $setting = Setting::first();
    $albums = Album::where('status', 1)->get();
    list($schema, $metatags) = $this->contactUsPageSeo();

    $albumDetails = null;
    if ($albums->count() > 0) {
        $albumDetails = $albums->first();
    }

    return view('website.services', compact('setting', 'albums', 'albumDetails', 'metatags', 'schema'));
}

public function albumDetails($link)
{
    $setting = Setting::first();
    $album = Album::with('images')->where('link_en', $link)
        ->orWhere('link_ar', $link)->firstOrFail();
    list($schema, $metatags) = $this->contactUsPageSeo();
    return view('website.service-details', compact('setting', 'album', 'metatags', 'schema'));
}
}
