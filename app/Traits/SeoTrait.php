<?php

namespace App\Traits;

use App\Models\Brand;
use App\Models\SeoAssistant;
use App\Models\Setting;
use App\Models\Configration;
use Melbahja\Seo\Schema;
use Melbahja\Seo\Schema\Thing;
use Melbahja\Seo\MetaTags;
use App\Models\About;
use App\Models\Faq;
use App\Models\BlogItem;
use App\Models\Service;
use App\Models\Project;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait SeoTrait
{

    public function homePageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $seo = SeoAssistant::first();
        $setting = Setting::first();
        $configration = Configration::where('lang', $lang)->first();

        $schema1 = new Thing('LocalBusiness', [
            'name'          => $configration->app_name,
            'url'          => LaravelLocalization::localizeUrl('/'),
            'image'         => asset("uploads/settings/source/$configration->app_logo"),
            'telephone' => $setting->mobile,
            'address' => $configration->address1,
        ]);


        $schema2 = new Thing('Organization', [
            'url'          => LaravelLocalization::localizeUrl('/'),
            'logo'         => asset("uploads/settings/source/$configration->app_logo"),
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
        $home_title = ($lang == 'en')
            ? ($seo->home_meta_title ?? $configration->app_name ?? '')
            : ($seo->home_meta_title_ar ?? $configration->app_name ?? '');
        $home_title = (string)($home_title ?? '');
        $home_meta_title = $home_title;
        $home_desc = ($lang == 'en')
            ? ($seo->home_meta_desc ?? strip_tags($configration->about_app ?? ''))
            : ($seo->home_meta_desc_ar ?? strip_tags($configration->about_app ?? ''));
        $home_desc = (string)($home_desc ?? '');
        $metatags
            ->title($home_title)
            ->meta('title', $home_meta_title)
            ->description($home_desc)
            ->meta('author', (string)($configration->app_name ?? ''))
            ->image(asset("uploads/settings/source/" . ($configration->app_logo ?? '')))
            ->mobile(LaravelLocalization::localizeUrl('/'))
            ->canonical(LaravelLocalization::localizeUrl('/'))
            ->shortlink(LaravelLocalization::localizeUrl('/'))
            ->meta('robots', ($seo->home_meta_robots) ? 'index' : 'noindex');

        return [$schema, $metatags];
    }

    public function aboutUsPageSeo()
    {
        $about = About::first();
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $seo = SeoAssistant::first();

        $metatags = new MetaTags();
        $metatags
            ->title(($seo->about_meta_title) ? $seo->about_meta_title : $about->title_ar)
            ->meta('title', ($seo->about_meta_title) ? $seo->about_meta_title : $about->title_ar)
            ->description(($seo->about_meta_desc) ? $seo->about_meta_desc : (($lang == 'en') ? strip_tags($about->text_en) : strip_tags($about->text_ar)))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/about-us'))
            ->canonical(LaravelLocalization::localizeUrl('/about-us'))
            ->shortlink(LaravelLocalization::localizeUrl('/about-us'))
            ->meta('robots', ($seo->about_meta_robots) ? 'index' : 'noindex');

        $schema = new Schema(
            new Thing('Article', [
                'url' => LaravelLocalization::localizeUrl("/about-us"),
                'image' => asset("uploads/settings/source/$configration->app_logo"),
                'headline' => ($seo->about_meta_title) ? $seo->about_meta_title : (($lang == 'en') ? $about->title_en : $about->title_ar),
                'author' => new Thing('author', [
                    'name' => $configration->app_name,
                    'url' => LaravelLocalization::localizeUrl("/about-us"),
                ]),

                'datePublished' => $about->crated_at,
                'dateModified' => $about->updated_at,
            ])
        );
        return [$schema, $metatags];
    }

    public function contactUsPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $seo = SeoAssistant::first();
        $metatags = new MetaTags();

        $metatags
            ->title(($seo->contact_meta_title || $seo->contact_meta_title_ar) ? ($lang == 'en' ? $seo->contact_meta_title : $seo->contact_meta_title_ar) : $configration->app_name)
            ->meta('title', (($seo->contact_meta_title || $seo->contact_meta_title_ar) ? ($lang == 'en' ? $seo->contact_meta_title : $seo->contact_meta_title_ar) : $configration->app_name))
            ->description(($seo->contact_meta_desc || $seo->contact_meta_desc_ar) ? ($lang == 'en' ? $seo->contact_meta_desc : $seo->contact_meta_desc_ar) : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/contact-us'))
            ->canonical(LaravelLocalization::localizeUrl('/contact-us'))
            ->shortlink(LaravelLocalization::localizeUrl('/contact-us'))
            ->meta('robots', ($seo->contact_meta_robots) ? 'index' : 'noindex');

        $schema = new Schema(
            new Thing('Article', [
                'url' => LaravelLocalization::localizeUrl("/contact-us"),
                'image' => asset("uploads/settings/source/$configration->app_logo"),
                'headline' => ($seo->contact_meta_title) ? $seo->contact_meta_title : $configration->app_name,
                'author' => new Thing('author', [
                    'name' => $configration->app_name,
                    'url' => LaravelLocalization::localizeUrl("/contact-us"),
                ]),
            ])
        );
        return [$schema, $metatags];
    }

    public function blogsPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $seo = SeoAssistant::first();
        $metatags = new MetaTags();

        $metatags
            ->title(($seo->blogs_meta_title || $seo->blogs_meta_title_ar) ? (($lang == 'en') ? $seo->blogs_meta_title : $seo->blogs_meta_title_ar) : $configration->app_name)
            ->meta('title', ($seo->blogs_meta_title || $seo->blogs_meta_title_ar) ? (($lang == 'en') ? $seo->blogs_meta_title : $seo->blogs_meta_title_ar) : $configration->app_name)
            ->description(($seo->blogs_meta_desc || $seo->blogs_meta_desc_ar) ? (($lang == 'en') ? $seo->blogs_meta_desc : $seo->blogs_meta_desc_ar) : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/blogs'))
            ->canonical(LaravelLocalization::localizeUrl('/blogs'))
            ->shortlink(LaravelLocalization::localizeUrl('/blogs'))
            ->meta('robots', ($seo->blogs_meta_robots) ? 'index' : 'noindex');

        return [$metatags];
    }

    public function CategoryBlogsPageSeo($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $seo = SeoAssistant::first();
        $metatags = new MetaTags();

        $metatags
            ->title(($seo->blogs_meta_title) ? $seo->blogs_meta_title : $configration->app_name)
            ->meta('title', ($seo->blogs_meta_title) ? $seo->blogs_meta_title : $configration->app_name)
            ->description(($seo->blogs_meta_desc) ? $seo->blogs_meta_desc : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/blogs/' . $link))
            ->canonical(LaravelLocalization::localizeUrl('/blogs/' . $link))
            ->shortlink(LaravelLocalization::localizeUrl('/blogs/' . $link))
            ->meta('robots', ($seo->blogs_meta_robots) ? 'index' : 'noindex');

        return [$metatags];
    }

    public function brandSeo($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $brand = Brand::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $configration = Configration::where('lang', $lang)->first();
        $metatags = new MetaTags();
        $metatags
            ->title(($brand->meta_title_en || $brand->meta_title_ar) ? (($lang == 'en') ? $brand->meta_title_en : $brand->meta_title_ar) : (($lang == 'en') ? $brand->name_en : $brand->name_ar))
            ->meta('title', ($brand->meta_title_en || $brand->meta_title_ar) ? (($lang == 'en') ? $brand->meta_title_en : $brand->meta_title_ar) : (($lang == 'en') ? $brand->name_en : $brand->name_ar))
            ->description(($brand->meta_desc_en || $brand->meta_desc_ar) ? (($lang == 'en') ? strip_tags(mb_strimwidth($brand->meta_desc_en, 0, 150, "...")) : strip_tags(mb_strimwidth($brand->meta_desc_ar, 0, 150, "..."))) : (($brand == 'en') ? strip_tags(mb_strimwidth($brand->text_en, 0, 150, "...")) : strip_tags(mb_strimwidth($brand->text_ar, 0, 150, "..."))))
            ->meta('author', $configration->app_name)
            ->meta('time', date('D M j G:i:s T Y', strtotime($brand->created_at)))
            ->image(asset("uploads/blogitems/source/$brand->image"))
            ->mobile(LaravelLocalization::localizeUrl("blog/" . $link))
            ->canonical(LaravelLocalization::localizeUrl("blog/" . $link))
            ->shortlink(LaravelLocalization::localizeUrl("blog/" . $link))
            ->meta('robots', ($brand->meta_robots) ? 'index' : 'noindex');

        $schema1 = new Thing('Article', [
            'url' => LaravelLocalization::localizeUrl("brand/" . $link),
            'image' => asset("uploads/brands/source/$brand->image"),
            'headline' => ($lang == 'en') ? $brand->name_en : $brand->name_ar,

            'datePublished' => $brand->crated_at,
            'dateModified' => $brand->updated_at,
        ]);


        $schema = new Schema(
            $schema1
        );

        return [$schema, $metatags];
    }

    public function brandsPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $seo = SeoAssistant::first();
        $metatags = new MetaTags();

        $metatags
            ->title(($seo->brands_meta_title || $seo->brands_meta_title_ar) ? (($lang == 'en') ? $seo->brands_meta_title : $seo->brands_meta_title_ar) : $configration->app_name)
            ->meta('title', ($seo->brands_meta_title || $seo->brands_meta_title_ar) ? (($lang == 'en') ? $seo->brands_meta_title : $seo->brands_meta_title_ar) : $configration->app_name)
            ->description(($seo->brands_meta_desc || $seo->brands_meta_desc_ar) ? (($lang == 'en') ? $seo->brands_meta_desc : $seo->brands_meta_desc_ar) : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/brands'))
            ->canonical(LaravelLocalization::localizeUrl('/brands'))
            ->shortlink(LaravelLocalization::localizeUrl('/brands'))
            ->meta('robots', ($seo->brands_meta_robots) ? 'index' : 'noindex');

        return [$metatags];
    }
    public function blogSeo($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $blog = BlogItem::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $faqs = Faq::where('type', 'blog_item')->where('blog_item_id', $blog->id)->get();
        $configration = Configration::where('lang', $lang)->first();
        $metatags = new MetaTags();
        $blog_title = ($lang == 'en')
            ? ($blog->meta_title_en ?? $blog->title_en ?? '')
            : ($blog->meta_title_ar ?? $blog->title_ar ?? '');
        $blog_title = (string)($blog_title ?? '');
        $blog_meta_title = $blog_title;
        $blog_desc = ($lang == 'en')
            ? ($blog->meta_desc_en ?? strip_tags(mb_strimwidth($blog->text_en ?? '', 0, 150, "...")))
            : ($blog->meta_desc_ar ?? strip_tags(mb_strimwidth($blog->text_ar ?? '', 0, 150, "...")));
        $blog_desc = (string)($blog_desc ?? '');
        $blog_author = $blog->writers->name ?? '';
        $blog_time = $blog->date ? date('D M j G:i:s T Y', strtotime($blog->date)) : '';
        $blog_image = $blog->image ?? '';
        $metatags
            ->title($blog_title)
            ->meta('title', $blog_meta_title)
            ->description($blog_desc)
            ->meta('author', (string)$blog_author)
            ->meta('time', (string)$blog_time)
            ->image(asset("uploads/blogitems/source/" . $blog_image))
            ->mobile(LaravelLocalization::localizeUrl($link))
            ->canonical(LaravelLocalization::localizeUrl($link))
            ->shortlink(LaravelLocalization::localizeUrl($link))
            ->meta('robots', ($blog->meta_robots) ? 'index' : 'noindex');
        $schema1 = new Thing('Article', [
            'url' => LaravelLocalization::localizeUrl($link),
            'image' => asset("uploads/blogitems/source/$blog->image"),
            'headline' => ($lang == 'en') ? $blog->title_en : $blog->title_ar,
            'datePublished' => $blog->created_at,
            'dateModified' => $blog->updated_at,
        ]);
        // دعم الحقول الجديدة للأسئلة (title_ar/title_en/text_ar/text_en)
        $filteredFaqs = $faqs->filter(function ($faq) use ($lang) {
            $question = trim(strip_tags($faq->{'title_' . $lang} ?? ''));
            $answer = trim(strip_tags($faq->{'text_' . $lang} ?? ''));
            return $question !== '' && $answer !== '';
        });

        if ($filteredFaqs->count() > 0) {
            $ques = [];
            foreach ($filteredFaqs as $faq) {
                $ques[] = new Thing('Question', [
                    'name' => trim(strip_tags($faq->{'title_' . $lang})),
                    'acceptedAnswer' => new Thing('Answer', [
                        'text' => trim(strip_tags($faq->{'text_' . $lang}))
                    ]),
                ]);
            }

            $schema2 = new Thing('FAQPage', [
                'mainEntity' => $ques
            ]);

            $schema = new Schema($schema1, $schema2);
        } else {
            $schema = new Schema($schema1);
        }

        return [$schema, $metatags];
    }

    public function projectsPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $setting = Setting::first();
        $seo = SeoAssistant::first();
        $metatags = new MetaTags();

        $metatags
            ->title($configration->app_name . '|' . trans('home.products'))
            ->meta('title', ($seo->projects_meta_title) ? substr($seo->projects_meta_title, 0, 60) : substr($configration->app_name, 0, 60))
            ->description(($seo->projects_meta_desc) ? substr($seo->projects_meta_desc, 0, 160) : substr(strip_tags($configration->about_app), 0, 160))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/projects'))
            ->canonical(LaravelLocalization::localizeUrl('/projects'))
            ->shortlink(LaravelLocalization::localizeUrl('/projects'))
            ->meta('robots', ($seo->projects_meta_robots) ? 'index' : 'noindex');

        return [$metatags];
    }

    public function servicesPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $seo = SeoAssistant::first();

        $metatags = new MetaTags();
        $metatags
            ->title(($seo->services_meta_title || $seo->services_meta_title_ar) ? ($lang == 'en' ? $seo->services_meta_title : $seo->services_meta_title_ar) : $configration->app_name)
            ->meta('title', ($seo->services_meta_title || $seo->services_meta_title_ar) ? ($lang == 'en' ? $seo->services_meta_title : $seo->services_meta_title_ar) : $configration->app_name)
            ->description(($seo->services_meta_dsec || $seo->services_meta_dsec_ar) ? ($lang == 'en' ? $seo->services_meta_dsec : $seo->services_meta_dsec_ar) : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/services'))
            ->canonical(LaravelLocalization::localizeUrl('/services'))
            ->shortlink(LaravelLocalization::localizeUrl('/services'))
            ->meta('robots', ($seo->services_meta_robots) ? 'index' : 'noindex');

        return [$metatags];
    }

    public function projectPageSeo($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $project = Project::where('link_en', $link)->orwhere('link_ar', $link)->first();
        $configration = Configration::where('lang', $lang)->first();
        $metatags = new MetaTags();
        $metatags
            ->title(($project->meta_title_en || $project->meta_title_ar) ? (($lang == 'en') ? $project->meta_title_en : $project->meta_title_ar) : (($lang == 'en') ? $project->name_en : $project->name_ar))
            ->meta('title', ($project->meta_title_en || $project->meta_title_ar) ? (($lang == 'en') ? $project->meta_title_en : $project->meta_title_ar) : (($lang == 'en') ? $project->name_en : $project->name_ar))
            ->description(($project->meta_desc_en || $project->meta_desc_ar) ? (($lang == 'en') ? strip_tags(mb_strimwidth($project->meta_desc_en, 0, 150, "...")) : strip_tags(mb_strimwidth($project->meta_desc_ar, 0, 150, "..."))) : (($lang == 'en') ? strip_tags(mb_strimwidth($project->text_en, 0, 150, "...")) : strip_tags(mb_strimwidth($project->text_ar, 0, 150, "..."))))
            ->meta('author', $configration->app_name)
            ->meta('time', date('D M j G:i:s T Y', strtotime($project->created_at)))
            ->image(asset("uploads/projects/source/$project->image"))
            ->mobile(LaravelLocalization::localizeUrl("project/" . $link))
            ->canonical(LaravelLocalization::localizeUrl("project/" . $link))
            ->shortlink(LaravelLocalization::localizeUrl("project/" . $link))
            ->meta('robots', ($project->meta_robots) ? 'index' : 'noindex');

        $schema = new Thing('Article', [
            'url' => LaravelLocalization::localizeUrl("project/" . $link),
            'image' => asset("uploads/blogitems/source/$project->image"),
            'headline' => ($lang == 'en') ? $project->name_en : $project->name_ar,
            'author' => new Thing('author', [
                'name' => $configration->app_name,
                'url' => LaravelLocalization::localizeUrl("project/" . $link),
            ]),

            'datePublished' => $project->crated_at,
            'dateModified' => $project->updated_at,
        ]);

        return [$schema, $metatags];
    }

    public function galleryImagesPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $seo = SeoAssistant::first();

        $metatags = new MetaTags();
        $metatags
            ->title(($seo->gallery_images_meta_title || $seo->gallery_images_meta_title_ar) ? ($lang == 'en' ? $seo->gallery_images_meta_title : $seo->gallery_images_meta_title_ar) : $configration->app_name)
            ->meta('title', (($seo->gallery_images_meta_title || $seo->gallery_images_meta_title_ar) ? ($lang == 'en' ? $seo->gallery_images_meta_title : $seo->gallery_images_meta_title_ar) : $configration->app_name))
            ->description(($seo->gallery_images_meta_desc || $seo->gallery_images_meta_desc_ar) ? ($lang == 'en' ? $seo->gallery_images_meta_desc : $seo->gallery_images_meta_desc_ar) : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/galleryImages'))
            ->canonical(LaravelLocalization::localizeUrl('/galleryImages'))
            ->shortlink(LaravelLocalization::localizeUrl('/galleryImages'))
            ->meta('robots', ($seo->gallery_images_meta_robots) ? 'index' : 'noindex');

        $schema = new Schema(
            new Thing('Article', [
                'url' => LaravelLocalization::localizeUrl("/galleryImages"),
                'image' => asset("uploads/settings/source/$configration->app_logo"),
                'headline' => ($seo->gallery_images_meta_title) ? $seo->gallery_images_meta_title : $configration->app_name,
                'author' => new Thing('author', [
                    'name' => $configration->app_name,
                    'url' => LaravelLocalization::localizeUrl("/galleryImages"),
                ]),
            ])
        );

        return [$schema, $metatags];
    }

    public function galleryVideosPageSeo()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $seo = SeoAssistant::first();

        $metatags = new MetaTags();
        $metatags
            ->title(($seo->gallery_videos_meta_title || $seo->gallery_videos_meta_title_ar) ? ($lang == 'en' ? $seo->gallery_videos_meta_title : $seo->gallery_videos_meta_title_ar) : $configration->app_name)
            ->meta('title', (($seo->gallery_videos_meta_title || $seo->gallery_videos_meta_title_ar) ? ($lang == 'en' ? $seo->gallery_videos_meta_title : $seo->gallery_videos_meta_title_ar) : $configration->app_name))
            ->description(($seo->gallery_videos_meta_desc || $seo->gallery_videos_meta_desc_ar) ? ($lang == 'en' ? $seo->gallery_videos_meta_desc : $seo->gallery_videos_meta_desc_ar) : strip_tags($configration->about_app))
            ->meta('author', $configration->app_name)
            ->image(asset("uploads/settings/source/$configration->app_logo"))
            ->mobile(LaravelLocalization::localizeUrl('/galleryVideos'))
            ->canonical(LaravelLocalization::localizeUrl('/galleryVideos'))
            ->shortlink(LaravelLocalization::localizeUrl('/galleryVideos'))
            ->meta('robots', ($seo->gallery_videos_meta_robots) ? 'index' : 'noindex');

        $schema = new Schema(
            new Thing('Article', [
                'url' => LaravelLocalization::localizeUrl("/galleryVideos"),
                'image' => asset("uploads/settings/source/$configration->app_logo"),
                'headline' => ($seo->gallery_videos_meta_title) ? $seo->gallery_videos_meta_title : $configration->app_name,
                'author' => new Thing('author', [
                    'name' => $configration->app_name,
                    'url' => LaravelLocalization::localizeUrl("/galleryVideos"),
                ]),
            ])
        );

        return [$schema, $metatags];
    }

    public function serviceSeo($link)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $configration = Configration::where('lang', $lang)->first();
        $faqs = Faq::get();
        $service = Service::where('link_en', $link)->orWhere('link_ar', $link)->first();
        $faqs = Faq::where('type', 'service')->where('service_id', $service->id)->where('status', 1)->get();


        $schema1 = new Thing('Article', [
            'url' => LaravelLocalization::localizeUrl("service/" . $link),
            'image' => asset("uploads/settings/source/$configration->app_logo"),
            'headline' => ($service->meta_keywords) ? $service->meta_keywords : $service->name_en,
            // 'author' => new Thing('author', [
            //     'name'=>$configration->app_name,
            //     'url'=> LaravelLocalization::localizeUrl('/'),
            // ]),

            'datePublished' => $service->crated_at,
            'dateModified' => $service->updated_at,
        ]);
        // دعم الحقول الجديدة للأسئلة (title_ar/title_en/text_ar/text_en)
        $filteredFaqs = $faqs->filter(function ($faq) use ($lang) {
            $question = trim(strip_tags($faq->{'title_' . $lang} ?? ''));
            $answer = trim(strip_tags($faq->{'text_' . $lang} ?? ''));
            return $question !== '' && $answer !== '';
        });

        if ($filteredFaqs->count() > 0) {
            $ques = [];
            foreach ($filteredFaqs as $faq) {
                $ques[] = new Thing('Question', [
                    'name' => trim(strip_tags($faq->{'title_' . $lang})),
                    'acceptedAnswer' => new Thing('Answer', [
                        'text' => trim(strip_tags($faq->{'text_' . $lang}))
                    ]),
                ]);
            }

            $schema2 = new Thing('FAQPage', [
                'mainEntity' => $ques
            ]);

            $schema = new Schema($schema1, $schema2);
        } else {
            $schema = new Schema($schema1);
        }

        $metatags = new MetaTags();
        $metatags
            ->title(($service->meta_title_en || $service->meta_title_ar) ? (($lang == 'en') ? $service->meta_title_en : $service->meta_title_ar) : (($lang == 'en') ? $service->name_en : $service->name_ar))
            ->meta('title', ($service->meta_title_en || $service->meta_title_ar) ? (($lang == 'en') ? $service->meta_title_en : $service->meta_title_ar) : (($lang == 'en') ? $service->name_en : $service->name_ar))
            ->description(($service->meta_desc_en || $service->meta_desc_ar) ? (($lang == 'en') ? strip_tags(mb_strimwidth($service->meta_desc_en, 0, 150, "...")) : strip_tags(mb_strimwidth($service->meta_desc_ar, 0, 150, "..."))) : (($lang == 'en') ? strip_tags(mb_strimwidth($service->text_en, 0, 150, "...")) : strip_tags(mb_strimwidth($service->text_ar, 0, 150, "..."))))
            ->meta('author', $configration->app_name)
            ->meta('time', date('D M j G:i:s T Y', strtotime($service->created_at)))
            ->image(asset("uploads/services/source/$service->img"))
            ->mobile(LaravelLocalization::localizeUrl("service/" . $link))
            ->canonical(LaravelLocalization::localizeUrl("service/" . $link))
            ->shortlink(LaravelLocalization::localizeUrl("service/" . $link))
            ->meta('robots', ($service->meta_robots) ? 'index' : 'noindex');

        return [$schema, $metatags];
    }
}
