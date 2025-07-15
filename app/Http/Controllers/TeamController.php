<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use DB;
use File;
use Image;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:teams');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::get();
        return view('admin.teams.teams',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.addTeam');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Team();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->position_en = $request->position_en;
        $add->position_ar = $request->position_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->mobile = $request->mobile;
        $add->facebook = $request->facebook;
        $add->instgram = $request->instgram;
        $add->linkedin = $request->linkedin;
        $add->status = $request->status;
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

           // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/teams/source/' . $fileName);
            $resize200 = public_path('uploads/teams/resize200/' . $fileName);
            $resize800 = public_path('uploads/teams/resize800/' . $fileName);
              //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = getimagesize($file->getRealPath());
            $widthreal = $arrayimage[0];
            $heightreal = $arrayimage[1];
            $width200 = ($widthreal / $heightreal) * 200;
            $height200 = $width200 / ($widthreal / $heightreal);
            if($widthreal > 200 && $heightreal > 200){
                $img200 = Image::canvas($width200, $height200);
                $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
                $img200->insert($image200, 'center');
                $img200->save($resize200);
            }
            else{
               Image::make($file->getRealPath())->save($resize200);
            }
            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);
            if($widthreal > 800 && $heightreal > 800){
                $img800 = Image::canvas($width800, $height800);
                $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
                $img800->insert($image800, 'center');
                $img800->save($resize800);
            }
            else{
               Image::make($file->getRealPath())->save($resize800);
            }
            $add->img = $fileName;
        }
        $add->save();
        return redirect('admin/teams')->with('success',trans('home.your_item_updated_successfully'));
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
        $team = Team::find($id);
        if($team){
            return view('admin.teams.editTeam',compact('team'));
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
        $add = Team::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->position_en = $request->position_en;
        $add->position_ar = $request->position_ar;
         $add->text_ar = $request->text_ar;
         $add->text_en = $request->text_en;
        $add->mobile = $request->mobile;
        $add->facebook = $request->facebook;
        $add->instgram = $request->instgram;
        $add->linkedin = $request->linkedin;
        $add->status = $request->status;
        
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/categories/source/';

            if ($add->img != null) {
                file_exists($img_path.$add->img) ? unlink($img_path . $add->img):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing img
            $path = public_path('uploads/teams/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $add->img = $fileName;
        }
        
        $add->save();
        return redirect('admin/teams')->with('success',trans('home.your_item_updated_successfully'));
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

        $img_path = public_path() . '/uploads/teams/source/';
        $img_path200 = public_path() . '/uploads/teams/resize200/';
        $img_path800 = public_path() . '/uploads/teams/resize800/';
        foreach ($ids as $id) {
            $team = Team::findOrFail($id);
            if ($team->img != null) {
                file_exists($img_path.$team->img) ? unlink(sprintf($img_path . '%s', $team->img)):'';
                file_exists($img_path200.$team->img) ?  unlink(sprintf($img_path200 . '%s', $team->img)):'';
                file_exists($img_path800.$team->img) ?  unlink(sprintf($img_path800 . '%s', $team->img)):'';
            }
            $team->delete();
        }
    }
}
