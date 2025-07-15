<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use DB;
use File;
use Image;
use App\Models\ProgressApplication;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:progresses']);
    }

    public function index()
    {
        //
        $progresses = progress::orderBy('id','DESC')->get();
        return view('admin.progresses.progresses',compact('progresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.progresses.addprogress');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new progress();
        $add->title_ar = $request->title_ar;
        $add->title_en = $request->title_en;
        $add->text_ar = $request->text_ar;
        $add->text_en = $request->text_en;
        $add->number = $request->number;
        $add->order = $request->order;
        $add->status = $request->status;


        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/progress/source/';
            if ($add->image != null) {
                file_exists($img_path.$add->image) ? unlink($img_path.$add->image):'';
            }
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/progress/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->image = $fileName;
        }
        $add->save();
        return redirect('admin/progresses')->with('success',trans('home.your_item_added_successfully'));
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
        $progress =Progress::find($id);
        if($progress){
            return view('admin.progresses.editprogress',compact('progress'));
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
        $add = Progress::find($id);
        $add->title_ar = $request->title_ar;
        $add->title_en = $request->title_en;
        $add->text_ar = $request->text_ar;
        $add->text_en = $request->text_en;
        $add->number = $request->number;
        $add->order = $request->order;
        $add->status = $request->status;
if ($request->hasFile("image")) {
            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);
            $img_path = public_path() . '/uploads/progress/source/';
            if ($add->image != null) {
                file_exists($img_path.$add->image) ? unlink($img_path.$add->image):'';
            }
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/progress/source/' . $fileName);
            
            Image::make($file->getRealPath())->save($path);

            $add->image = $fileName;
        }
        $add->save();
        return redirect('/admin/progresses')->with('success',trans('home.your_item_updated_successfully'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids){
        //
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
//        $img_path = public_path() . '/uploads/progresses/source/';
//        $img_path200 = public_path() . '/uploads/progresses/resize200/';
//        $img_path800 = public_path() . '/uploads/progresses/resize800/';
        foreach ($ids as $id) {
            $progress = Progress::findOrFail($id);
//            if ($Date->image != null) {
//                unlink(sprintf($img_path . '%s', $Date->image));
//                unlink(sprintf($img_path200 . '%s', $Date->image));
//                unlink(sprintf($img_path800 . '%s', $Date->image));
//            }
            $progress->delete();
        }
    }
    public function getprogressesApplications(){
        $progressApplications = ProgressApplication::orderBy('id','DESC')->get();
        return view('admin.progresses.progresses-applications',compact('progressApplications'));
    }
}