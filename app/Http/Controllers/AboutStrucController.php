<?php

namespace App\Http\Controllers;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aboutStrucs = AboutStruc::orderBy('id','DESC')->get();
        return view('admin.aboutStrucs.aboutStrucs',compact('aboutStrucs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutStrucs.addAboutStruc');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

           // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/aboutStrucs/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->image = $fileName;
        }
        $add->save();
        return redirect()->route('aboutStrucs.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/aboutStrucs/source/';
            if ($add->image != null) {
                file_exists($img_path.$add->image) ? unlink($img_path.$add->image):'';
            }
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/aboutStrucs/source/' . $fileName);
            $resize200 = public_path('uploads/aboutStrucs/resize200/' . $fileName);
            $resize800 = public_path('uploads/aboutStrucs/resize800/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->image = $fileName;
        }
        $add->save();
        return redirect()->route('aboutStrucs.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
