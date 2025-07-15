<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use DB;
use File;
use Image;
use App\Models\ProjectImage;
use App\Models\CategoryAttribute;
use App\Models\Attribute;
use App\Models\ProjectAttribute;
use App\Models\Region;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:projects']);
    }

    public function index()
    {
        $projects = Project::orderBy('id','DESC')->get();
        return view('admin.projects.projects',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('status',1)->get();
        $categories = Category::where('status',1)->get();

        $categoriesUds = Category::where('status',1)->pluck('id')->toArray();

        $categoryAttributeIds = CategoryAttribute::whereIn('category_id',$categoriesUds)->pluck('attribute_id')->toArray();
        $attributes=Attribute::whereIn('id',$categoryAttributeIds)->get();



        return view('admin.projects.addProject',compact('attributes','services','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Project();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->link_en = $request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):preg_replace("/[ \/]/", "-", $request->name_en);
        $add->link_ar = $request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):preg_replace("/[ \/]/", "-", $request->name_ar);


        $add->img_alt = $request->img_alt;
        $add->category_id = $request->category_id;
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path('uploads/projects/source/');
            if (!file_exists($img_path)) {
                mkdir($img_path, 0777, true);
            }
            $extension = $mimearr[1];
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = $img_path . $fileName;
            Image::make($file->getRealPath())->save($path);
            $add->image = $fileName;
        }
        $add->save();
        //////// save project attributes///////////////
        if($request->attribute){
            ProjectAttribute::where('project_id',$add->id)->delete();
            $attributes=$request->attribute;
            $attributeValues=$request->attribute_value;
            foreach($attributes as $key=>$attribute){
                if($attribute){
                    $attr=new ProjectAttribute();
                    $attr->project_id =$add->id;
                    $attr->attribute_id=$attribute;
                    $attr->attribute_value_id=$attributeValues[$key];
                    $attr->save();
                }
            }
        }
        // نقل الصور من temp_upload_files إلى ProjectImage
        $images = DB::table('temp_upload_files')->where('type','project')->where('project_id',$add->id)->get();
        foreach($images as $image){
            $img = new ProjectImage();
            $img->image = $image->server_name;
            $img->project_id = $add->id;
            $img->save();
        }
        DB::table('temp_upload_files')->where('type','project')->where('project_id',$add->id)->delete();

        return redirect('admin/projects/'.$add->id.'/edit')->with('success',trans('home.your_produt_added_successfully_upload_images_and_complete_specifications'));
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
        $project=Project::find($id);

        if($project){
            $services = Service::where('status',1)->get();
            $categories = Category::where('status',1)->get();
            $regions = Region::where('country_id',1)->where('available_units',1)->where('status',1)->get();

            $categoryAttributeIds = CategoryAttribute::where('category_id',$project->category_id)->pluck('attribute_id')->toArray();
            $attributes=Attribute::whereIn('id',$categoryAttributeIds)->get();
            $projectAttributeValueIds = ProjectAttribute::where('project_id',$id)->pluck('attribute_value_id')->toArray();

            $images = DB::table('temp_upload_files')->where('type','project')->where('project_id',$id)->get();
            if(count($images) > 0){
                foreach($images as $image){
                    try{
                        $img_path = public_path() . '/uploads/projects/source/';
                        if($image->server_name){
                            file_exists($img_path.$image->server_name) ? unlink($img_path .$image->server_name):'';
                        }
                    }catch(Exception $e){
                    }
                }
                DB::table('temp_upload_files')->where('type','project')->where('project_id',$id)->delete();
                session()->forget('imagesUpload');
                session()->forget('imagesUploadRealName');
            }
            // جلب جميع المواصفات
            $features = \App\Models\Feature::all();
            return view('admin.projects.editProject',compact('project','services','categories','attributes','projectAttributeValueIds','regions','features'));
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
        $add = Project::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->text_ar = $request->text_ar;
        $add->text_en = $request->text_en;
        $add->text2_ar = $request->text2_ar;
        $add->text2_en = $request->text2_en;
        $add->order = $request->order;
        $add->small_text_en = $request->small_text_en;
        $add->small_text_ar = $request->small_text_ar;
        $add->status = $request->status;
        $add->recommended = $request->recommended;
        $add->img_alt = $request->img_alt;
        $add->service_id = $request->service_id;
        $add->location = $request->location;
        $add->year = $request->year;
        $add->link_en = $request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):$add->link_en;
        $add->link_ar = $request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):$add->link_ar;

        $add->meta_title_en = $request->meta_title_en;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots ;

        $add->phone = $request->phone ;
        $add->whatsapp = $request->whatsapp ;
        $add->map_url = $request->map_url ;
        $add->video_link = $request->video_link ;

        $add->address_en = $request->address_en ;
        $add->address_ar = $request->address_ar ;
        $add->region_id = $request->region_id ;


        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path('uploads/projects/source/');
            if (!file_exists($img_path)) {
                mkdir($img_path, 0777, true);
            }
            if ($add->image != null) {
                file_exists($img_path.$add->image) ? unlink($img_path .$add->image):'';
            }
            $extension = $mimearr[1];
            $fileName = rand(11111, 99999) . '.' . $extension;
            $path = $img_path . $fileName;
            $img =Image::make($file->getRealPath());
            $img->save($path);
            $add->image = $fileName;
        }
        if ($request->hasFile("img")) {
            $file = $request->file("img");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/projects/source/' . $fileName);

            $img_path = public_path() . '/uploads/projects/source/';
            if ($add->img != null) {
                file_exists($img_path . $add->img) ? unlink($img_path . $add->img) : '';
            }

            Image::make($file->getRealPath())->save($path);
            $add->img = $fileName;
        }
        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/projects/source/' . $fileName);

            $img_path = public_path() . '/uploads/projects/source/';
            if ($add->photo != null) {
                file_exists($img_path . $add->photo) ? unlink($img_path . $add->photo) : '';
            }

            Image::make($file->getRealPath())->save($path);
            $add->photo = $fileName;
        }
        if ($request->hasFile("banner")) {
            $file = $request->file("banner");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/projects/source/' . $fileName);

            $img_path = public_path() . '/uploads/projects/source/';
            if ($add->banner != null) {
                file_exists($img_path . $add->banner) ? unlink($img_path . $add->banner) : '';
            }

            Image::make($file->getRealPath())->save($path);
            $add->banner = $fileName;
        }
        $add->save();
        // ربط المواصفات (features) مع المشروع
        $add->features()->sync($request->features ?? []);
        //////// save project attributes///////////////
        if($request->attribute){
            ProjectAttribute::where('project_id',$id)->delete();
            $attributes=$request->attribute;
            $attributeValues=$request->attribute_value;
            foreach($attributes as $key=>$attribute){
                if($attribute){
                    $attr=new ProjectAttribute();
                    $attr->project_id =$add->id;
                    $attr->attribute_id=$attribute;
                    $attr->attribute_value_id=$attributeValues[$key];
                    $attr->save();
                }
            }
        }
        // نقل الصور من temp_upload_files إلى ProjectImage
        $images = DB::table('temp_upload_files')->where('type','project')->where('project_id',$add->id)->get();
        foreach($images as $image){
            $img = new ProjectImage();
            $img->image = $image->server_name;
            $img->project_id = $add->id;
            $img->save();
        }
        DB::table('temp_upload_files')->where('type','project')->where('project_id',$add->id)->delete();

        return redirect('/admin/projects')->with('success',trans('home.your_item_updated_successfully'));
    }

    public function changeCategory(Request $request,$id){
        $project=Project::find($id);
        $project->category_id = $request->category_id;
        $project->save();

        //////delete attributes////
        ProjectAttribute::where('project_id',$id)->delete();
        return back()->with('success',trans('home.category_changed_successfully'));
    }

    public function changeService(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->service_id = $request->service_id;
        $project->save();

        return redirect()->back()->with('success', trans('home.service_updated_successfully'));
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
        $img_path = public_path('uploads/projects/source/');

        foreach ($ids as $id) {
            $project = Project::findOrFail($id);

            if ($project->image != null) {
                file_exists($img_path.$project->image) ? unlink($img_path . $project->image):'';
            }
            foreach($project->images() as $another_image){
                file_exists($img_path.$another_image->image) ? unlink($img_path . $another_image->image):'';
                ProjectImage::where('id',$another_image->id)->delete();
            }
            $project->delete();
        }
    }


    /////// upload product images///////////////
    public function uploadImages(Request $request){
        if($request->hasFile('file')){

            $file = $request->file("file");
            $realName = $file->getClientOriginalName();
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111111, 99999999) . '.' . $extension; // renameing image

            $path = public_path('uploads/projects/source/' . $fileName);

            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            DB::table('temp_upload_files')->insert(['server_name' => $fileName,'original_name' => $realName ,'project_id' => $request->projectId, 'type'=>'project']);
            if(\Session::has('imagesUpload')){
                \Session::push('imagesUpload',$fileName);
                \Session::push('imagesUploadRealName',$realName);
            }else{
                $images = [];
                array_push($images,$fileName);
                \Session::put('imagesUpload',$images);

                $realImages = [];
                array_push($realImages,$realName);
                \Session::put('imagesUploadRealName',$realImages);
            }
        }
    }


    ///////// delete uploaded images///////////
    public function removeUploadImages(Request $request)
    {
        $name = $request->name;
        $names = \Session::get('imagesUploadRealName');
        $images = \Session::get('imagesUpload');
        $key = array_search($name, $names);

        $img_path = public_path('uploads/projects/source/');
        file_exists($img_path. $images[$key]) ? unlink($img_path .  $images[$key]):'';



        unset($images[$key]);
        unset($names[$key]);
        \Session::put('imagesUpload',$images);
        \Session::put('imagesUploadRealName',$names);
        DB::table('temp_upload_files')->where('original_name',$name)->delete();
    }

    public function deleteImege(){
        $projectId = $_POST['projectId'];
        $image = $_POST['image'];
        $img =ProjectImage::where('project_id',$projectId)->where('id',$image)->first();

        $img_path = public_path('uploads/projects/source/');

        if ($img->image != null) {
            file_exists($img_path.$img->image) ? unlink(sprintf($img_path . '%s', $img->image)):'';
        }
        $img->delete();
    }
    public function deleteAllIMages(Request $request)
    {
        $projectId = $request->id;
        if (!$projectId) {
            return response()->json(['status' => 'error', 'message' => 'Project ID is required'], 400);
        }
        $imgs = ProjectImage::where('project_id', $projectId)->get();
        $img_path = public_path('uploads/projects/source/');
        $errors = [];
        foreach ($imgs as $img) {
            try {
                if ($img->image != null) {
                    $filePath = $img_path . $img->image;
                    if (file_exists($filePath)) {
                        if (!@unlink($filePath)) {
                            $errors[] = $img->image . ': cannot delete file (permission or lock issue)';
                        }
                    }
                }
                $img->delete();
            } catch (\Exception $e) {
                $errors[] = $img->image . ': ' . $e->getMessage();
            }
        }
        if (count($errors) > 0) {
            return response()->json(['status' => 'error', 'message' => 'Some images could not be deleted', 'errors' => $errors], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'All images deleted successfully']);
    }

    public function copy(){
        $ids= $_POST['ids'];
        $img_path = public_path('uploads/projects/source/');
        $img_path200 = public_path('uploads/projects/resize200/');
        $img_path800 = public_path('uploads/projects/resize800/');
        foreach ($ids as $index=>$id) {
            $old_project = Project::findOrFail($id);
            $add = new Project();
            $add->name_en = $old_project->name_en;
            $add->name_ar = $old_project->name_ar;
            $add->link_en = str_replace(" ","-",$old_project->link_en);
            $add->link_ar = str_replace(" ","-",$old_project->link_ar);
            $add->img_alt = $old_project->img_alt;
            $add->category_id = $old_project->category_id;
            $source_paths = [$img_path, $img_path200, $img_path800];
            if ($old_project->image != null) {
                foreach ($source_paths as $source_path) {
                    $new_image_path = $source_path . 'project_'.$index.'_'.$old_project->image;
                    if (file_exists($source_path . $old_project->image)) {
                        copy($source_path . $old_project->image, $new_image_path);
                    }
                }
                $add->image = 'project_'.$index.'_'. $old_project->image;
            }
            $add->save();

            //////// save project attributes///////////////
            if($old_project->attribute){
                ProjectAttribute::where('project_id',$add->id)->delete();
                $attributes=$request->attribute;
                $attributeValues=$request->attribute_value;
                foreach($attributes as $key=>$attribute){
                    if($attribute){
                        $attr=new ProjectAttribute();
                        $attr->project_id =$add->id;
                        $attr->attribute_id=$attribute;
                        $attr->attribute_value_id=$attributeValues[$key];
                        $attr->save();
                    }
                }
            }
            foreach($old_project->images() as $old_image){

                $new_image_path = $source_path . 'project_'.$index.'_'.$old_image->image;
                if (file_exists($source_path . $old_image->image)) {
                    copy($source_path . $old_image->image, $new_image_path);
                }
                $new_image = new Projectimage();
                $new_image->image =  'project_'.$index.'_'.$old_image->image;
                $new_image->project_id =  $add->id;
                $new_image->save();
            }
        }
    }

}
