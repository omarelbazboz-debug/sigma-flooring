<?php

namespace App\Http\Controllers;

use App\Models\Date;
use DB;
use File;
use Image;
use App\Models\DateApplication;
use Illuminate\Http\Request;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:dates']);
    }

    public function index()
    {
        //
        $dates = Date::orderBy('id','DESC')->get();
        return view('admin.dates.dates',compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dates.addDate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Date();
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;
        $add->number = $request->number;
        $add->status = $request->status;
        $add->am = $request->am;
        $add->pm = $request->pm;

//        if ($request->hasFile("image")) {
//
//            $file = $request->file("image");
//            $mime = File::mimeType($file);
//            $mimearr = explode('/', $mime);
//
//            // $destinationPath = public_path() . '/uploads/'; // upload path
//            $extension = $mimearr[1]; // getting file extension
//            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
//            $path = public_path('uploads/dates/source/' . $fileName);
//            $resize200 = public_path('uploads/dates/resize200/' . $fileName);
//            $resize800 = public_path('uploads/dates/resize800/' . $fileName);
//            //  $file->move($destinationPath, $fileName);
//
//            Image::make($file->getRealPath())->save($path);
//
//            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
//            $widthreal = $arrayimage['0'];
//            $heightreal = $arrayimage['1'];
//
//            $width200 = ($widthreal / $heightreal) * 150;
//            $height200 = $width200 / ($widthreal / $heightreal);
//
//            $img200 = Image::canvas($width200, $height200);
//            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
//                $c->aspectRatio();
//                $c->upsize();
//            });
//            $img200->insert($image200, 'center');
//            $img200->save($resize200);
//
//            $width800 = ($widthreal / $heightreal) * 800;
//            $height800 = $width800 / ($widthreal / $heightreal);
//
//            $img800 = Image::canvas($width800, $height800);
//            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
//                $c->aspectRatio();
//                $c->upsize();
//            });
//            $img800->insert($image800, 'center');
//            $img800->save($resize800);
//
//            $add->image = $fileName;
//        }
        $add->save();
        return redirect('admin/dates')->with('success',trans('home.your_item_added_successfully'));
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
        $date=Date::find($id);
        if($date){
            return view('admin.dates.editDate',compact('date'));
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
        $add = Date::find($id);
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;
        $add->number = $request->number;
        $add->status = $request->status;
        $add->am = $request->am;
        $add->pm = $request->pm;


//        if ($request->hasFile("image")) {
//
//            $file = $request->file("image");
//            $mime = File::mimeType($file);
//            $mimearr = explode('/', $mime);
//
//            $img_path = public_path() . '/uploads/dates/source/';
//            $img_path200 = public_path() . '/uploads/dates/resize200/';
//            $img_path800 = public_path() . '/uploads/dates/resize800/';
//
//            if ($add->image != null) {
//                unlink(sprintf($img_path . '%s', $add->image));
//                unlink(sprintf($img_path200 . '%s', $add->image));
//                unlink(sprintf($img_path800 . '%s', $add->image));
//            }
//
//            // $destinationPath = public_path() . '/uploads/'; // upload path
//            $extension = $mimearr[1]; // getting file extension
//            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
//            $path = public_path('uploads/dates/source/' . $fileName);
//            $resize200 = public_path('uploads/dates/resize200/' . $fileName);
//            $resize800 = public_path('uploads/dates/resize800/' . $fileName);
//            //  $file->move($destinationPath, $fileName);
//
//            $img =Image::make($file->getRealPath());
//            $img->save($path);
//
//            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
//            $widthreal = $arrayimage['0'];
//            $heightreal = $arrayimage['1'];
//
//            $width200 = ($widthreal / $heightreal) * 150;
//            $height200 = $width200 / ($widthreal / $heightreal);
//
//            $img200 = Image::canvas($width200, $height200);
//            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
//                $c->aspectRatio();
//                $c->upsize();
//            });
//            $img200->insert($image200, 'center');
//            $img200->save($resize200);
//
//            $width800 = ($widthreal / $heightreal) * 800;
//            $height800 = $width800 / ($widthreal / $heightreal);
//
//            $img800 = Image::canvas($width800, $height800);
//            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
//                $c->aspectRatio();
//                $c->upsize();
//            });
//            $img800->insert($image800, 'center');
//            $img800->save($resize800);
//
//            $add->image = $fileName;
//        }
        $add->save();
        return redirect('/admin/dates')->with('success',trans('home.your_item_updated_successfully'));
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
//        $img_path = public_path() . '/uploads/dates/source/';
//        $img_path200 = public_path() . '/uploads/dates/resize200/';
//        $img_path800 = public_path() . '/uploads/dates/resize800/';

        foreach ($ids as $id) {
            $Date = Date::findOrFail($id);

//            if ($Date->image != null) {
//                unlink(sprintf($img_path . '%s', $Date->image));
//                unlink(sprintf($img_path200 . '%s', $Date->image));
//                unlink(sprintf($img_path800 . '%s', $Date->image));
//            }

            $Date->delete();
        }
    }

    public function getdatesApplications(){
        $DateApplications = DateApplication::orderBy('id','DESC')->get();
        return view('admin.dates.dates-applications',compact('DateApplications'));
    }

}
