<?php

namespace App\Http\Controllers;

use App\Models\Category;
use DB;
use File;
use Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:categories']);
    }

    public function index()
    {
        //
        $categories = Category::with('children')->get();
        return view('admin.categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::where('status',1)->get();
        return view('admin.categories.addCategory',compact('categories'));
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
        $add = new Category();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->desc_en = $request->desc_en;
        $add->desc_ar = $request->desc_ar;
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

        if($request->menu){
            $add->menu = 1;
        }else{
            $add->menu = 0;
        }

        if($request->home){
            $add->home = 1;
        }else{
            $add->home = 0;
        }

        if($request->parent_id !=0){
            $add->parent_id = $request->parent_id;
            $category=Category::find($request->parent_id);
            $category->has_sub =1;
            $category->save();
            $add->has_sub =0;
        }else{
            $add->parent_id = 0;
            $add->has_sub =0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/categories/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $add->image = $fileName;
        }
        $add->save();
        return redirect('admin/categories')->with('success',trans('home.your_item_added_successfully'));
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
        $category=Category::find($id);
        if($category){
            $categories=Category::where('id','!=',$id)->where('status',1)->get();
            return view('admin.categories.editCategory',compact('categories','category'));
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
        //
        $add = Category::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->desc_en = $request->desc_en;
        $add->desc_ar = $request->desc_ar;
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

        if($request->menu){
            $add->menu = 1;
        }else{
            $add->menu = 0;
        }

        if($request->home){
            $add->home = 1;
        }else{
            $add->home = 0;
        }

        if($request->parent_id !=0){
            $add->parent_id = $request->parent_id;
            $category=Category::find($request->parent_id);
            $category->has_sub =1;
            $category->save();
            $add->has_sub =0;
        }else{
            $add->parent_id = 0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/categories/source/';

            if ($add->image != null) {
                file_exists($img_path.$add->image) ? unlink($img_path . $add->image):'';
            }

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/categories/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $add->image = $fileName;
        }

        $add->save();


        return redirect('/admin/categories')->with('success',trans('home.your_item_updated_successfully'));
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
        $img_path = public_path() . '/uploads/category/source/';
         
        
        foreach ($ids as $id) {
            $category = Category::findOrFail($id);

            if ($category->img != null) {
                file_exists($img_path.$category->image) ? unlink($img_path . $category->image):'';

            }

            $category->delete();
        }
    }  
    
}
