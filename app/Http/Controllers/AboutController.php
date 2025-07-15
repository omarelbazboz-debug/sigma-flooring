<?php

namespace App\Http\Controllers;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/aboutStrucs/source/';
            if ($add->image != null) {
                file_exists($img_path . $add->image) ? unlink($img_path . $add->image) : '';
            }
            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/aboutStrucs/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);


            $add->image = $fileName;
        }
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/aboutStrucs/source/';
            if ($add->img != null) {
                file_exists($img_path . $add->img) ? unlink($img_path . $add->img) : '';
            }
            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing img
            $path = public_path('uploads/aboutStrucs/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);


            $add->img = $fileName;
        }
        if ($request->hasFile("banner")) {

            $file = $request->file("banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/aboutStrucs/source/';
            if ($add->banner != null) {
                file_exists($img_path . $add->banner) ? unlink($img_path . $add->banner) : '';
            }
            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/aboutStrucs/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->banner = $fileName;
        }
        $add->save();
        return redirect()->back()->with('success', trans('home.about_info_updated_successfully'));
    }
}
