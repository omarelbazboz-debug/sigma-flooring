<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutStruc;
use DB;
use File;
use Image;

class AboutStrucController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:aboutStruc');
    }


    public function index()
    {
        //
        $aboutStrucs = AboutStruc::orderBy('id','DESC')->get();
        return view('admin.aboutStrucs.aboutStrucs',compact('aboutStrucs'));
    }


    public function create()
    {
        return view('admin.aboutStrucs.addAboutStruc');
    }


    public function store(Request $request)
    {
        //
        //dd($request->all());
        $add = new AboutStruc();
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;
        $add->status = $request->status;
        $add->alt_img = $request->alt_img;

         if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('aboutStrucs');
            $add->image = $fileName;
        }
        $add->save();
        return redirect()->route('aboutStrucs.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
    }


    public function edit($id)
    {
        //
        $aboutStruc = AboutStruc::find($id);
        if($aboutStruc){
            return view('admin.aboutStrucs.editAboutStruc',compact('aboutStruc'));
        }else{
            abort('404');
        }

    }


    public function update(Request $request, $id)
    {
        $add = AboutStruc::find($id);
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;
        $add->status = $request->status;
        $add->alt_img = $request->alt_img;
        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('aboutStrucs');
            SaveImageTo3Path::deleteImage(  $add->image, 'aboutStrucs');
            $add->image = $fileName;
        }
        $add->save();
        return redirect()->route('aboutStrucs.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
    }


    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }

        $img_path = public_path() . '/uploads/aboutStrucs/source/';
        foreach ($ids as $id) {
            $aboutStruc = AboutStruc::findOrFail($id);
            if ($aboutStruc->image != null) {
                file_exists($img_path.$aboutStruc->image) ? unlink($img_path.$aboutStruc->image):'';
            }
            $aboutStruc->delete();
        }
    }
}
