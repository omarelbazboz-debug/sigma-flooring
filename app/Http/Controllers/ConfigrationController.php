<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configration;
use File;
use Image;
class ConfigrationController extends Controller
{
    
    public function __construct(){
        $this->middleware(['permission:configration']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        
        if ($request->hasFile("app_logo")) {

            $file = $request->file("app_logo");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/settings/source/';

            if ($configration->app_logo != null) {
                file_exists($img_path. $configration->app_logo) ? unlink($img_path . $configration->app_logo):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/settings/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);
            $configration->app_logo = $fileName;
        }
        
        if ($request->hasFile("about_image")) {

            $file = $request->file("about_image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/settings/source/';

            if ($configration->about_image != null) {
                file_exists($img_path. $configration->about_image) ? unlink($img_path . $configration->about_image):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/settings/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $configration->about_image = $fileName;
        }
        
        if ($request->hasFile("footer_logo")) {

            $file = $request->file("footer_logo");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/settings/source/';
             
             

            if ($configration->footer_logo != null) {
                file_exists($img_path. $configration->footer_logo) ? unlink($img_path . $configration->footer_logo):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/settings/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);
            $configration->footer_logo = $fileName;
        }
        
        if ($request->hasFile("fav_icon")) {

            $file = $request->file("fav_icon");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/settings/source/';
             
             

            if ($configration->fav_icon != null) {
                file_exists($img_path. $configration->fav_icon) ? unlink($img_path . $configration->fav_icon):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/settings/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);
            $configration->fav_icon = $fileName;
        }
        
        
        $configration->save() ;
        return back()->with('success',trans('home.configurations_updated_successfully'));
    }
}
