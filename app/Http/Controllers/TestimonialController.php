<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use DB;
use File;
use Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:testimonial');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonials.testimonials',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.addTestimonial');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Testimonial();
        $add->name = $request->name;
        $add->position = $request->position;
        $add->text = $request->text;
        $add->lang = $request->lang;
        $add->status = $request->status;
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

           // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/testimonials/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->img = $fileName;
        }
        $add->save();
        return redirect('admin/testimonials')->with('success',trans('home.your_item_updated_successfully'));
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
        $testimonial = Testimonial::find($id);
        if($testimonial){
            return view('admin.testimonials.editTestimonial',compact('testimonial'));
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
        $add = Testimonial::find($id);
        $add->name = $request->name;
        $add->position = $request->position;
        $add->text = $request->text;
        $add->lang = $request->lang;
        $add->status = $request->status;
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/testimonials/source/';
            if ($add->img != null) {
                file_exists($img_path.$add->img) ? unlink($img_path .$add->img):'';

            }
           // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/testimonials/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->img = $fileName;
        }
        $add->save();
        return redirect('admin/testimonials')->with('success',trans('home.your_item_updated_successfully'));
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

        $img_path = public_path() . '/uploads/testimonials/source/';
        foreach ($ids as $id) {
            $testimonial = Testimonial::findOrFail($id);
            if ($testimonial->img != null) {
                file_exists($img_path . $testimonial->img)?unlink($img_path.$testimonial->img):'';
            }
            $testimonial->delete();
        }
    }
}
