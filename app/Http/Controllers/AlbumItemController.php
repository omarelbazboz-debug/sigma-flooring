<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;

use App\Models\AlbumItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AlbumItemController extends Controller
{
 

    public function __construct(){
        $this->middleware(['permission:galleryImage']);
    }

 
    
    /////// upload product images///////////////
    public function uploadImages(Request $request){
        if($request->hasFile('file')){

            $file = $request->file("file");
            $realName = $file->getClientOriginalName();
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('album_items');

            DB::table('temp_upload_files')->insert(['server_name' => $fileName,'original_name' => $realName , 'type'=>'album_items']);
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
        
        SaveImageTo3Path::deleteImage(  $name, 'album_items');
              
        unset($images[$key]);
        unset($names[$key]);
        Session::put('imagesUpload',$images);
        Session::put('imagesUploadRealName',$names);
        DB::table('temp_upload_files')->where('original_name',$name)->delete();
    }
    
    
    public function deleteImage(){
        $albumId = $_POST['albumId'];
        $image = $_POST['image'];
        $img =AlbumItem::where('album_id',$albumId)->where('id',$image)->first();

        $img_path = public_path() . '/uploads/album_items/source/';

        if ($img->name != null) {
            file_exists($img_path.$img->name) ? unlink(sprintf($img_path . '%s', $img->name)):'';
        }
        $img->delete();
    }
    
    public function deleteAllIMages(){
        $album_id = $_POST['id'];
        $imgs =AlbumItem::where('album_id',$album_id)->get();

        $img_path = public_path() . '/uploads/album_items/source/';
        foreach($imgs as $img){
            if ($img->name != null) {
                file_exists($img_path.$img->name) ? unlink(sprintf($img_path . '%s', $img->name)):'';
            }
            $img->delete();
        }
    }

}
