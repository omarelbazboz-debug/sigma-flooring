<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use App\Models\HomeSlider;
use DB;
use File;
use Image;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:homeSlider']);
    }

    public function index()
    {
        //
        $sliders = HomeSlider::orderBy('id','DESC')->get();
        return view('admin.sliders.home-sliders.sliders',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sliders.home-sliders.addSlider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new HomeSlider();
        $add->title = $request->title;
        $add->title1 = $request->title1;
        $add->text = $request->text;
        $add->link = $request->link;
        $add->order = $request->order;
        $add->lang = $request->lang;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('sliders/home-sliders');
            $add->image = $fileName;
        }

        if ($request->hasFile("video")) {
            $file = $request->file("video");
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('uploads/sliders/home-sliders/videos/' . $fileName);
            $file->move(public_path('uploads/sliders/home-sliders/videos/'), $fileName);
            $add->video = asset('uploads/sliders/home-sliders/videos/' . $fileName);
        }
        $add->save();
        return redirect('admin/home-sliders')->with('success',trans('home.your_item_added_successfully'));
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
        $slider=HomeSlider::find($id);
        if($slider){
            return view('admin.sliders.home-sliders.editSlider',compact('slider'));
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
        $add = HomeSlider::find($id);
        $add->title = $request->title;
        $add->title1 = $request->title1;
        $add->title_color = $request->title_color;
        $add->title1_color = $request->title1_color;
        $add->text = $request->text;
        $add->link = $request->link;
        $add->order = $request->order;
        $add->lang = $request->lang;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('sliders/home-sliders');
            SaveImageTo3Path::deleteImage(  $add->image, 'sliders/home-sliders');
            $add->image = $fileName;
        }
        if ($request->hasFile("video")) {
            $file = $request->file("video");
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('uploads/sliders/home-sliders/videos/' . $fileName);
            $file->move(public_path('uploads/sliders/home-sliders/videos/'), $fileName);
            $add->video = asset('uploads/sliders/home-sliders/videos/' . $fileName);
        }
        $add->save();
        return redirect('/admin/home-sliders')->with('success',trans('home.your_item_updated_successfully'));
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
        $img_path = public_path() . '/uploads/sliders/home-sliders/source/';

        foreach ($ids as $id) {
            $slider = HomeSlider::findOrFail($id);

            if ($slider->image != null) {
                file_exists($img_path.$slider->image) ? unlink($img_path.$slider->image):'';
            }

            $slider->delete();
        }
    }

}
