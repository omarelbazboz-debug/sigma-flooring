<?php

namespace App\Http\Controllers;

use App\Models\AboutStruc;
use App\Models\Album;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\GalleryVideo;
use App\Models\HomeSlider;
use App\Models\IntroSlider;
use App\Models\Lang;
use App\Models\OfferSlider;
use App\Models\Page;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Writer;
use Auth;
use App\Models\Service;
use App\Models\Region;
use App\Models\Area;
use App\Models\Brand;
use App\Models\Project;
use App\Models\Country;
use App\Models\User;
use App\Models\GalleryImage;
use App\Models\BlogItem;
use App\Models\Attribute;
use App\Models\ContactUs;
use App\Models\Testimonial;
use App\Models\Career;
use App\Models\Title;
use App\Models\CareerApplication;
use App\Models\Address;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    ///// function return admin index view///////
    public function admin(){
        $services = Service::count();
        $brands = Brand::count();
        $projects = Project::count();
        $users = User::count();
        $blogcat = BlogCategory::count();
        $blogs = BlogItem::count();
        $messages = ContactUs::count();
        $categories = Category::count();
        $pages = Page::count();
        $addresses = Address::count();


        return view('admin.index',compact('services','brands','projects','users','blogcat','blogs','messages','categories','pages','addresses'));
    }

    ///// function set session lang of the app////
    public function setlang($lang){
        $langs = ['en', 'ar'];
        if (in_array($lang, $langs)) {
            session(['lang' => $lang]);
            return redirect()->back();
        }
    }


    ///// function publish and unpublish status////
    public function updatestatus($name,$ids)
    {
        $ids = explode(',', $ids);
        foreach ($ids as $x) {

            if($name == 'categories'){
                $update = Category::findOrFail($x);
            }

            if($name == 'countries'){
                $update = Country::findOrFail($x);
            }

            if($name == 'regions'){
                $update = Region::findOrFail($x);
            }

            if($name == 'pages'){
                $update = Page::findOrFail($x);
            }

            if($name == 'products'){
                $update = Product::findOrFail($x);
            }

            if($name == 'menus'){
                $update = Menu::findOrFail($x);
            }

            if($name == 'menu-items'){
                $update = MenuItem::findOrFail($x);
            }

            if($name == 'testimonials'){
                $update = Testimonial::findOrFail($x);
            }
            if($name == 'intro-sliders'){
                $update = IntroSlider::findOrFail($x);
            }
            if($name == 'offers-sliders'){
                $update = OfferSlider::findOrFail($x);
            }
            if($name == 'home-sliders'){
                $update = HomeSlider::findOrFail($x);
            }
            if($name == 'aboutStrucs'){
                $update = AboutStruc::findOrFail($x);
            }
            if($name == 'careers'){
                $update = Career::findOrFail($x);
            }
            if($name == 'titles'){
                $update = Title::findOrFail($x);
            }
            if($name == 'blog-categories'){
                $update = BlogCategory::findOrFail($x);
            }
            if($name == 'blog-items'){
                $update = BlogItem::findOrFail($x);
            }
            if($name == 'services'){
                $update = Service::findOrFail($x);
            }
            if($name == 'gallery-images'){
                $update = GalleryImage::findOrFail($x);
            }
            if($name == 'gallery-videos'){
                $update = GalleryVideo::findOrFail($x);
            }
            if($name == 'writers'){
                $update = Writer::findOrFail($x);
            }
            if($name == 'brands'){
                $update = Brand::findOrFail($x);
            }
            if($name == 'attributes'){
                $update = Attribute::findOrFail($x);
            }
            if($name == 'projects'){
                $update = Project::findOrFail($x);
            }
            if($name == 'areas'){
                $update = Area::findOrFail($x);
            }
            if($name == 'addresses'){
                $update = Address::findOrFail($x);
            }
            if($name == 'albums'){
                $update = Album::findOrFail($x);
            }



            if ($update->status == 0) {
                $update->status = 1;
                $update->save();
            }
            else {
                $update->status = 0;
                $update->save();
            }
        }
    }

    public function switchTheme(){
        $user =Auth::user();
        if ($user ->theme == 'light') {
            $user ->theme = 'dark';
            $user ->save();
            $this->switchThemeSidebar('dark');
            $this->switchThemeTop();

        }else {
            $user->theme = 'light';
            $user->save();
            $this->switchThemeSidebar('light');
            $this->switchThemeTop();

        }
        return back();
    }
    public function switchThemeSidebar($sidebar){
        $user =Auth::user();
        $user ->side_bar = $sidebar;
        $user ->save();
        return back();
    }
    public function switchThemeTop(){
        $user =Auth::user();
        if ($user ->topbar == 1) {
            $user ->topbar = 0;
            $user ->save();
        }else {
            $user->topbar = 1;
            $user->save();
        }
        return back();
    }
}
