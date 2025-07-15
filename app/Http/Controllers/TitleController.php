<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use App\Models\Title;

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


    public function create()
    {
        //
        return view('admin.titles.addTitle');
    }


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

        
        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('titles');
            $add->image = $fileName;
        }

        // حفظ التغييرات
        $add->save();
        return redirect('admin/titles')->with('success', trans('home.your_item_added_successfully'));
    }
   

    public function edit($id)
    {
        $title = Title::find($id);

        if ($title) {
            return view('admin.titles.editTitle', compact('title'));
        } else {
            abort('404');
        }
    }


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

        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('titles');
            SaveImageTo3Path::deleteImage(  $add->image, 'titles');
            $add->image = $fileName;
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
