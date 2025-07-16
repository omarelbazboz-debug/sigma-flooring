<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use App\Models\Progress;

use App\Models\ProgressApplication;
use Illuminate\Http\Request;

class ProgressController extends Controller
{


    public function __construct(){
        $this->middleware(['permission:progress']);
    }

    public function index()
    {
        //
        $progresses = progress::orderBy('id','DESC')->get();
        return view('admin.progresses.progresses',compact('progresses'));
    }


    public function create()
    {
        //
        return view('admin.progresses.addProgress');
    }


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


        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('progress');
            $add->image = $fileName;
        }
        $add->save();
        return redirect('admin/progresses')->with('success',trans('home.your_item_added_successfully'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $progress =Progress::find($id);
        if($progress){
            return view('admin.progresses.editProgress',compact('progress'));
        }else{
            abort('404');
        }
    }

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

        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('progress');
            SaveImageTo3Path::deleteImage(  $add->image, 'progress');
            $add->image = $fileName;
        }
        $add->save();
        return redirect('/admin/progresses')->with('success',trans('home.your_item_updated_successfully'));
    }

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
