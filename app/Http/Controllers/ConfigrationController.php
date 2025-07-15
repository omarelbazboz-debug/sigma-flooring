<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use Illuminate\Http\Request;
use App\Models\Configration;
use File;
use Image;
class ConfigrationController extends Controller
{
    
    public function __construct(){
        $this->middleware(['permission:configration']);
    }

    public function show($lang)
    {
        //
        $configrations =Configration::where('lang',$lang)->first();
        return view('admin.configrations.configration',compact('configrations'));
    }


    public function update(Request $request, $lang)
    {
        $configration = Configration::where('lang',$lang)->first();
        $configration -> app_name = $request -> app_name;
        $configration -> about_app = $request -> about_app;
        $configration -> address1 = $request -> address1;
        $configration -> address2 = $request -> address2;
        $configration -> time = $request -> time;
        $configration -> copy_rights_text = $request -> copy_rights_text;

        
        if ( $request->hasFile("app_logo")) {
            $file = $request->file("app_logo");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('settings');
            SaveImageTo3Path::deleteImage(   $configration->app_logo, 'settings');
            $configration->app_logo = $fileName;
        }
        
        if ( $request->hasFile("about_image")) {
            $file = $request->file("about_image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('settings');
            SaveImageTo3Path::deleteImage(   $configration->about_image, 'settings');
            $configration->about_image = $fileName;
        }
        
        if ( $request->hasFile("footer_logo")) {
            $file = $request->file("footer_logo");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('settings');
            SaveImageTo3Path::deleteImage(   $configration->footer_logo, 'settings');
            $configration->footer_logo = $fileName;
        }
        
        if ( $request->hasFile("fav_icon")) {
            $file = $request->file("fav_icon");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('settings');
            SaveImageTo3Path::deleteImage(   $configration->fav_icon, 'settings');
            $configration->fav_icon = $fileName;
        }
        
        
        $configration->save() ;
        return back()->with('success',trans('home.configurations_updated_successfully'));
    }
}
