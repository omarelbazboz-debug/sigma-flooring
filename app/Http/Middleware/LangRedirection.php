<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use App\Models\Service;
use App\Models\BlogItem;
use App\Models\Project;
use Closure;
use Illuminate\Support\Facades\App;

class LangRedirection
{
    public function handle($request, Closure $next)
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        $slugLang = $request->segment(1);
        $path = $request->path();

        // تحديد السيجمنتات حسب اللغة
        if ($slugLang === 'en') {
            $typeSegment = 2;
            $slugSegment = 3;
        } else {
            $typeSegment = 1;
            $slugSegment = 2;
        }

        // تحديد اللغة
        if ($slugLang === 'en') {
            App::setLocale('en');
        } else {
            App::setLocale('ar');
            $slugLang = 'ar';
        }

        $currentLang = App::getLocale();
        $test_lang = Setting::first()->default_lang;

        // إعادة توجيه للعربية بدون /ar (دائم 301 لأي رابط يبدأ بـ /ar)
        if ($currentLang === 'ar' && preg_match('#^ar($|/)#', $path)) {
            $newPath = preg_replace('#^ar/?#', '', $path);
            if ($newPath === '' || $newPath[0] !== '/') {
                $newPath = '/' . ltrim($newPath, '/');
            }
            // إذا كان هناك كويري سترينج أضفه للرابط الجديد
            $query = $request->getQueryString();
            if ($query) {
                $newPath .= '?' . $query;
            }
            return redirect($newPath)->setStatusCode(301);
        }

        // إعادة توجيه للإنجليزية بـ /en
        if ($currentLang === 'en' && !preg_match('#^en($|/)#', $path)) {
            return redirect('/en/' . ltrim($path, '/'));
        }

        $url = urldecode($request->url());

        // التحقق من روابط المدونة والمشاريع والخدمات حسب اللغة الحالية
        if ($slugLang == $currentLang) {
            $type = $request->segment($typeSegment);
            $slug = $request->segment($slugSegment);

            if ($type == 'blogs' && $slug != '') {
                if ($slugLang == 'ar') {
                    $blog = BlogItem::where("link_ar", $slug)->first();
                    if (!$blog) {
                        abort(404);
                    }
                } else {
                    $blog = BlogItem::where("link_en", $slug)->first();
                    if (!$blog) {
                        abort(404);
                    }
                }
            }

            if ($type == 'project' && $slug != '') {
                $project = Project::where("link_en", $slug)
                                  ->orWhere("link_ar", $slug)
                                  ->first();
                if ($project) {
                    $link_ar = $project->link_ar ?? '';
                    $link_en = $project->link_en ?? '';
                    $redirectUrl = $slugLang == 'ar'
                        ? url("/ar/project/$link_ar")
                        : url("/en/project/$link_en");
                    if ($redirectUrl != $url && (($slugLang == 'ar' && $link_ar) || ($slugLang == 'en' && $link_en))) {
                        return redirect($redirectUrl);
                    }
                }
            }

            if ($type == 'products' && $slug != '') {
                $project = Project::where("link_en", $slug)
                                  ->orWhere("link_ar", $slug)
                                  ->first();
                if ($project) {
                    $link_ar = $project->link_ar ?? '';
                    $link_en = $project->link_en ?? '';
                    $redirectUrl = $slugLang == 'ar'
                        ? url("/ar/products/$link_ar")
                        : url("/en/products/$link_en");
                    if ($redirectUrl != $url && (($slugLang == 'ar' && $link_ar) || ($slugLang == 'en' && $link_en))) {
                        return redirect($redirectUrl);
                    }
                }
            }

            if ($type == 'service' && $slug != '') {
                if ($slugLang == 'ar') {
                    $service = Service::where("link_ar", $slug)->first();
                    if (!$service) {
                        abort(404);
                    }
                } else {
                    $service = Service::where("link_en", $slug)->first();
                    if (!$service) {
                        abort(404);
                    }
                }
            }

            return $next($request);
        }
        // إذا اللغة في الرابط لا تساوي اللغة الافتراضية
        if ($slugLang != $test_lang) {
            $type = $request->segment($typeSegment);
            $slug = $request->segment($slugSegment);

            if ($type == 'blogs' && $slug != '') {
                if ($slugLang == 'ar') {
                    $blog = BlogItem::where("link_ar", $slug)->first();
                    if (!$blog) {
                        abort(404);
                    }
                } else {
                    $blog = BlogItem::where("link_en", $slug)->first();
                    if (!$blog) {
                        abort(404);
                    }
                }
            }

            if ($type == 'project' && $slug != '') {
                $project = Project::where("link_en", $slug)
                                  ->orWhere("link_ar", $slug)
                                  ->first();
                if ($project) {
                    $redirectUrl = url("/$slugLang/project/{$project->{'link_' . $slugLang}});");
                    if ($redirectUrl != $url) {
                        return redirect($redirectUrl);
                    }
                }
            }

            if ($type == 'products' && $slug != '') {
                $project = Project::where("link_en", $slug)
                                  ->orWhere("link_ar", $slug)
                                  ->first();
                if ($project) {
                    $redirectUrl = url("/$slugLang/products/{$project->{'link_' . $slugLang}});");
                    if ($redirectUrl != $url) {
                        return redirect($redirectUrl);
                    }
                }
            }

            if ($type == 'service' && $slug != '') {
                if ($slugLang == 'ar') {
                    $service = Service::where("link_ar", $slug)->first();
                    if (!$service) {
                        abort(404);
                    }
                } else {
                    $service = Service::where("link_en", $slug)->first();
                    if (!$service) {
                        abort(404);
                    }
                }
            }

            return $next($request);
        }
    }
}
