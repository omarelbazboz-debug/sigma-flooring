<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;

use App\Models\BeforeAfter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class BeforeAfterController extends Controller
{


    public function __construct(){
        $this->middleware(['permission:beforeAfter']);
    }


    public function index(){
        $beforeafters = BeforeAfter::orderBy('order','asc')->get();
        return view('admin.beforeAfters.beforeAfters',compact('beforeafters'));
    }



    public function create(){
        return view('admin.beforeAfters.addBeforeAfter');
    }


    public function store(Request $request){
        $add = new BeforeAfter();
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("before_img")) {

            $file = $request->file("before_img");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('beforeAfters');
            $add->before_img = $fileName;
        
        }
        if ($request->hasFile("after_img")) {

            $file = $request->file("after_img");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('beforeAfters');
            $add->after_img = $fileName;
        }
        $add->save();
        return redirect('admin/beforeAfters')->with('success',trans('home.your_item_added_successfully'));
    }

    public function edit($id){
        $beforeAfters=BeforeAfter::find($id);
        if($beforeAfters){
            return view('admin.beforeAfters.editBeforeAfter',compact('beforeAfters'));
        }else{
            abort('404');
        }
    }

    public function update(Request $request,$id){
        $add = BeforeAfter::find($id);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        if ($request->hasFile("before_img")) {

            $file = $request->file("before_img");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('beforeAfters');
            SaveImageTo3Path::deleteImage(  $add->before_img, 'beforeAfters');
            $add->before_img = $fileName;
        }
        if ($request->hasFile("after_img")) {

            $file = $request->file("after_img");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('beforeAfters');
            SaveImageTo3Path::deleteImage(  $add->after_img, 'beforeAfters');
            $add->after_img = $fileName;
        }

        $add->save();
        return redirect('admin/beforeAfters')->with('success',trans('home.your_item_updated_successfully'));
    }

    public function reorderImeges(Request $request){
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer',
        ]);

        foreach ($request->ids as $index => $id) {
            BeforeAfter::where('id', $id)->update(['order' => $index + 1]);
        }

        $positions = BeforeAfter::pluck('order', 'id');

        return response(compact('positions'), Response::HTTP_OK);

    }


    /////// upload product images///////////////
    public function uploadImages(Request $request){
        if($request->hasFile('file')){

            $file = $request->file("file");
            $realName = $file->getClientOriginalName();
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('beforeAfters');


            DB::table('temp_upload_files')->insert(['server_name' => $fileName,'original_name' => $realName , 'type'=>'gallery_image']);
            if(Session::has('imagesUpload')){
                Session::push('imagesUpload',$fileName);
                Session::push('imagesUploadRealName',$realName);
            }else{
                $images = [];
                array_push($images,$fileName);
                Session::put('imagesUpload',$images);

                $realImages = [];
                array_push($realImages,$realName);
                Session::put('imagesUploadRealName',$realImages);
            }
        }
    }

    ///////// delete uploaded images///////////
    public function removeUploadImages(Request $request){
        $name = $request->name;
        $names = Session::get('imagesUploadRealName');
        $images = Session::get('imagesUpload');
        $key = array_search($name, $names);

        $img_path = public_path() . '/uploads/beforeAfters/source/';

        file_exists($img_path.$images[$key]) ? unlink($img_path .$images[$key]):'';


        unset($images[$key]);
        unset($names[$key]);
        Session::put('imagesUpload',$images);
        Session::put('imagesUploadRealName',$names);
        DB::table('temp_upload_files')->where('original_name',$name)->delete();
    }

    public function destroy($ids){
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $m = BeforeAfter::findOrFail($id);
            $img_path = public_path() . '/uploads/beforeAfters/source/';

            if ($m->image != null) {
                file_exists($img_path . $m->image)?unlink($img_path .$m->image):'';
            }
            $m->delete();
        }

        $BeforeAfterIds = BeforeAfter::pluck('id')->toArray();
        foreach ($BeforeAfterIds as $index => $id) {
            BeforeAfter::where('id', $id)->update(['order' => $index + 1]);
        }
    }

}
