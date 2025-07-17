<?php

namespace App\Http\Middleware;

use App\Models\Album;
use App\Models\BlogItem;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LangRedirection
{
    public function handle(Request $request, Closure $next)
    {
        $models = config('segmentsmodels.segments');
        $url_model = $request->segment(2);
        $lang = $request->segment(1) ?? Session::get('lang') ??  config('site_lang') ??  App::getlocale();
        App::setLocale($lang);

        if(array_key_exists($url_model,$models)){
            if(!request()->ajax()){
                $slug = $request->segment(3);
                 App::setLocale($lang);
                $item  = app($models[$url_model])->where('link_ar',$slug )->orWhere('link_en',$slug)->first()  ;
                if($item && $item->{'link_'.$lang} !== $slug){
                    $redirectUrl = url("/$lang/$url_model/{$item->{'link_'.$lang} }");
                    return redirect($redirectUrl);
                }
            }
        }

        return $next($request);
    }
}
