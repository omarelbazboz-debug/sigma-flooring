<?php

namespace App\Http\Controllers;

use App\Models\Title;
use DB;
use File;
use Image;
use App\Models\TitleApplication;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:titles']);
    }

    public function index()
    {
        //
        $titles = Title::orderBy('id', 'DESC')->get();
        return view('admin.titles.title', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.titles.addTitle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'title1_en' => 'nullable|string|max:255',
            'title1_ar' => 'nullable|string|max:255',
            'text_en' => 'nullable|string',
            'text_ar' => 'nullable|string',
            'number' => 'nullable|numeric',
            'link' => 'nullable|url',
            'type' => 'required|string|unique:titles,type',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1000',
        ]);

        $existingTitle = Title::where('type', $request->type)->first();

        if ($existingTitle) {
            return redirect('admin/titles')->with('success', trans('home.type_already_used'));
        }

        $add = new Title();
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->title1_en = $request->title1_en;
        $add->title1_ar = $request->title1_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->title1_color = $request->title1_color;
        $add->title_color = $request->title_color;
        $add->number = $request->number;
        $add->link = $request->link;
        $add->type = $request->type;
        $add->order = $request->order;
        $add->status = $request->status;

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $extension = $mimearr[1];
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = public_path('uploads/titles/source/' . $fileName);
            $resize200 = public_path('uploads/titles/resize200/' . $fileName);
            $resize800 = public_path('uploads/titles/resize800/' . $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage[0];
            $heightreal = $arrayimage[1];

            $width200 = ($widthreal / $heightreal) * 150;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $add->image = $fileName;
        }

        // حفظ التغييرات
        $add->save();
        return redirect('admin/titles')->with('success', trans('home.your_item_added_successfully'));
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
        $title = Title::find($id);

        if ($title) {
            return view('admin.titles.editTitle', compact('title'));
        } else {
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
        
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'title1_en' => 'nullable|string|max:255',
            'title1_ar' => 'nullable|string|max:255',
            'text_en' => 'nullable|string',
            'text_ar' => 'nullable|string',
            'number' => 'nullable|numeric',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1000',
        ]);

        $add = Title::find($id);
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->title1_en = $request->title1_en;
        $add->title1_ar = $request->title1_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->number = $request->number;
        $add->link = $request->link;
        $add->order = $request->order;
        $add->title1_color = $request->title1_color;
        $add->title_color = $request->title_color;
        $add->status = $request->status;

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;

            $img_path = public_path('uploads/titles/source/');
            $resize200 = public_path('uploads/titles/resize200/');
            $resize800 = public_path('uploads/titles/resize800/');

            $oldFilePaths = [
                $img_path . $add->image,
                $resize200 . $add->image,
                $resize800 . $add->image,
            ];

            foreach ($oldFilePaths as $oldFilePath) {
                if (File::exists($oldFilePath)) {
                    try {
                        File::delete($oldFilePath);
                    } catch (\Exception $e) {
                        \Log::error("Failed to delete file: " . $e->getMessage());
                    }
                }
            }

            if (!File::exists($img_path)) {
                File::makeDirectory($img_path, 0755, true, true);
            }

            try {
                Image::make($file->getRealPath())->save($img_path . $fileName);
                $add->image = $fileName;
            } catch (\Exception $e) {
                \Log::error("Failed to save image: " . $e->getMessage());
            }
        }
        $add->save();
        return redirect('/admin/titles')->with('success', trans('home.your_item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $title = Title::findOrFail($id); 
            $title->delete(); 
            return response()->json(['success' => true, 'message' => 'Title deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete title.'], 500);
        }
    }

}
