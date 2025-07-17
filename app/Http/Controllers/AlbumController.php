<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;

use App\Models\Album;
use App\Models\AlbumItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{


    public function __construct(){
        // $this->middleware(['permission:album']);
    }


    public function index(){
        $albums = Album::get();
        return view('admin.albums.index',compact('albums'));
    }

     public function create(){
        return view('admin.albums.create');
    }

    public function store(Request $request){
        $request = (object)$request->all();
        if(request()->hasFile('image')){

            $file = request()->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('album_items');
            $request->image = $fileName;
        }
        $album = Album::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'text_en'=>$request->text_en,
            'text_ar'=>$request->text_ar,
            'status'=>$request->status,
            'type'=>$request->type,
            'link_en'=>$request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):preg_replace("/[ \/]/", "-", $request->name_en),
            'link_ar'=>$request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):preg_replace("/[ \/]/", "-", $request->name_ar),

            ]);




            if($request->type=="images")
            {
                return redirect('admin/albums/'.$album->id.'/edit')->with('success',trans('home.your_items_added_successfully'));
            }
            else{
                return view('admin.albums.edit_video',compact('album'))->with('success',trans('home.your_items_added_successfully'));
            }

    }


    public function edit($id){
        $album=Album::find($id);
         if($album->type=="images")
            {
                 return view('admin.albums.edit',compact('album'));
            }
            else{
                return view('admin.albums.edit_video',compact('album'));
            }
    }

    public function update(Request $request,$id){
        $add = Album::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->link_en = $request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):preg_replace("/[ \/]/", "-", $request->name_en);
        $add->link_ar = $request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):preg_replace("/[ \/]/", "-", $request->name_ar);


        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }


        if($request->hasFile('image')){
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('album_items');
            SaveImageTo3Path::deleteImage(  $add->image, 'album_items');
            $add->image = $fileName;
        }

        $add->save();
        if($add->type=='images'){
            if(Session::has('imagesUpload')){
                $images =DB::table('temp_upload_files')->where('type','album_items')->get();
                foreach ($images as $key=>$file) {
                    $img = new AlbumItem();
                    $img->name = $file->server_name;
                    $img->album_id=$id;
                    $img->save();
                }
            }

            DB::table('temp_upload_files')->where('type','album_items')->delete();
            session()->forget('imagesUpload');
            session()->forget('imagesUploadRealName');
        }elseif($add->type=='video'){
            AlbumItem::where('album_id',$id)->delete();
            foreach($request->video_link as $new_link){
                if($new_link){
                    $video = new AlbumItem();
                    $video->name = $new_link;
                    $video->album_id=$id;
                    $video->save();
                }

            }
        }

        return redirect('admin/albums')->with('success',trans('home.your_item_updated_successfully'));
    }

    public function destroy($ids){
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $m = Album::findOrFail($id);
            if($m->type=="images"){
                $img_path = public_path() . '/uploads/album_items/source/';

                if ($m->image != null) {
                    file_exists($img_path.$m->image) ? unlink(sprintf($img_path . '%s', $m->image)):'';
                }
            }

            $m->delete();
        }

        AlbumItem::wherein('album_id',$ids)->delete();
    }



    public function copy(){
        $ids= $_POST['ids'];
        $img_path = public_path() . '/uploads/album_items/source/';

        foreach ($ids as $index=>$id) {
            $old_album = Album::findOrFail($id);
            $add = new Album();
            $add->name_en = $old_album->name_en;
            $add->name_ar = $old_album->name_ar;
            $add->text_en = str_replace(" ","-",$old_album->text_en);
            $add->text_ar = str_replace(" ","-",$old_album->text_ar);
            $add->type = $old_album->type;

            if ($old_album->image != null) {
                $new_image_path = $img_path . 'album_'.$index.'_'.$old_album->image;
                if (file_exists($img_path . $old_album->image)) {
                    copy($img_path . $old_album->image, $new_image_path);
                }
                $add->image = 'album_'.$index.'_'. $old_album->image;
            }
            $add->save();

            if($old_album->type=="images"){

                $new_image_path = $img_path . 'album_item_'.$index.'_';

                foreach($old_album->images as $old_album_image){
                    $img = new AlbumItem();
                    if (file_exists($img_path . $old_album_image->name)) {
                        copy($img_path . $old_album_image->name,  $new_image_path.$old_album_image->name);
                    }
                    $img->name = 'album_item_'.$index.'_'.$old_album_image->name;
                    $img->album_id=$add->id;
                    $img->save();
                }
            }else{
                foreach($old_album->images as $old_album_video){
                    $img = new AlbumItem();
                    $img->name = $old_album_video->name;
                    $img->album_id=$add->id;
                    $img->save();
                }
            }
        }
    }

}
