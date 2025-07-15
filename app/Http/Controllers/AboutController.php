<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

use DB;
use File;
use Image;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:about');
    }


    public function editAbout()
    {
        $about = About::first();
        return view('admin.about.editAbout', compact('about'));
    }

    public function update(Request $request)
    {
        $add = About::first();
        $add->title_en = $request->title_en;
        $add->text_en = $request->text_en;
        $add->title_ar = $request->title_ar;
        $add->title1_ar = $request->title1_ar;
        $add->title1_en = $request->title1_en;
        $add->text_ar = $request->text_ar;
        $add->text1_ar = $request->text1_ar;
        $add->text1_en = $request->text1_en;
        $add->alt_img = $request->alt_img;
        $add->alt_banner = $request->alt_banner;

        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('aboutStrucs');
            SaveImageTo3Path::deleteImage(  $add->image, 'aboutStrucs');
            $add->image = $fileName;
        }
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('img');
            SaveImageTo3Path::deleteImage(  $add->img, 'aboutStrucs');
            $add->img = $fileName;
        }
        if ($request->hasFile("banner")) {

            $file = $request->file("banner");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('aboutStrucs');
            SaveImageTo3Path::deleteImage(  $add->banner, 'aboutStrucs');
            $add->banner = $fileName;
        }
        $add->save();
        return redirect()->back()->with('success', trans('home.about_info_updated_successfully'));
    }
}
