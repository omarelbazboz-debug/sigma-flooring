<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use DB;
use File;
use Image;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:companies']);
    }

    public function index()
    {
        //
        $brands = Brand::orderBy('id','DESC')->get();
        return view('admin.brands.brands',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brands.addBrand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Brand();
        $add->order = $request->order;
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->facebook = $request->facebook;
        $add->instagram = $request->instagram;
        $add->pinterest = $request->pinterest;
        $add->youtube = $request->youtube;
        $add->twitter = $request->twitter;
        $add->address = $request->address;
        $add->phone = $request->phone;
        $add->link_en = $request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):preg_replace("/[ \/]/", "-", $request->name_en);
        $add->link_ar = $request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):preg_replace("/[ \/]/", "-", $request->name_ar);

        $add->meta_title_en = $request->meta_title_en;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots ;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("logo")) {

            $file = $request->file("logo");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/brands/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);
            $add->logo = $fileName;
        }
        $add->save();
        return redirect('admin/brands')->with('success',trans('home.your_item_added_successfully'));
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
        $brand=Brand::find($id);
        if($brand){
            return view('admin.brands.editBrand',compact('brand'));
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
        $add = Brand::find($id);
        $add->order = $request->order;
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->facebook = $request->facebook;
        $add->instagram = $request->instagram;
        $add->pinterest = $request->pinterest;
        $add->youtube = $request->youtube;
        $add->twitter = $request->twitter;
        $add->address = $request->address;
        $add->phone = $request->phone;

        $link_en = str_replace(" ","-",$add->name_en);
        $add->link_en = str_replace(" ","-",$link_en);
        $link_ar = str_replace(" ","-",$add->name_ar);
        $add->link_ar = str_replace(" ","-",$link_ar);
        $add->link_en = $request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):$add->link_en;
        $add->link_ar = $request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):$add->link_ar;

        $add->meta_title_en = $request->meta_title_en;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots ;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("logo")) {

            $file = $request->file("logo");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/brands/source/';

            if ($add->logo != null) {
                file_exists($img_path.$add->logo) ? unlink(sprintf($img_path . '%s', $add->logo)):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/brands/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $add->logo = $fileName;
        }
        $add->save();
        return redirect('/admin/brands')->with('success',trans('home.your_item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        //
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        $img_path = public_path() . '/uploads/brand/source/';

        foreach ($ids as $id) {
            $brand = Brand::findOrFail($id);

            if ($brand->logo != null) {
                file_exists($img_path.$brand->logo) ? unlink(sprintf($img_path . '%s', $brand->logo)):'';
            }

            $brand->delete();
        }
    }

}
