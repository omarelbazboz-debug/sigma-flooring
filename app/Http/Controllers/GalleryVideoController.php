<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleryVideoController extends Controller
{
 

    public function __construct(){
        $this->middleware(['permission:galleryVideo']);
    }


    public function index(){
        $galleryVideos = GalleryVideo::orderBy('order','asc')->get();
        return view('admin.galleryVideos.galleryVideos',compact('galleryVideos'));
    }

    public function create(){
        return view('admin.galleryVideos.addGalleryVideo');
    }
    
    
    public function store(Request $request){
        $add = new GalleryVideo();
        $add->youtube_link = $this->getYoutubeEmbedUrl($request->youtube_link);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->alt_img = $request->alt_img;                  
        $add->order = $request->order;
        $add->status = $request->status;
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/galleryVideo/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);


            $add->image = $fileName;
        }

        
        
        $add->save();
        
        return redirect('admin/gallery-videos')->with('success',trans('home.your_item_added_successfully'));
    }
    
    public function edit($id){
        $galleryVideo=GalleryVideo::find($id);
        if($galleryVideo){
            return view('admin.galleryVideos.editGalleryVideo',compact('galleryVideo'));
        }else{
            abort('404');
        }
    }
    
    public function update(Request $request,$id){
        $add = GalleryVideo::find($id);
        $add->youtube_link = $this->getYoutubeEmbedUrl($request->youtube_link);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->title_en = $request->title_en;
        $add->title_ar = $request->title_ar;
        $add->order = $request->order;
        $add->status = $request->status;
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);
    
            $image_path = public_path() . '/uploads/galleryVideo/source/';
    
            if ($add->image != null) {
                file_exists($image_path.$add->image) ?  unlink(sprintf($image_path . '%s', $add->image)):'';
            }
    
            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/galleryVideo/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);
    
            Image::make($file->getRealPath())->save($path);
    
            $add->image = $fileName;
        }
        
        $add->save();
        return redirect('admin/gallery-videos')->with('success',trans('home.your_item_updated_successfully'));
    }
    
    public function reorderVideos(Request $request){
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer',
        ]);

        foreach ($request->ids as $index => $id) {
            GalleryVideo::where('id', $id)->update(['order' => $index + 1]);
        }
        
        $positions = GalleryVideo::pluck('order', 'id');

        return response(compact('positions'), Response::HTTP_OK);

    }
    
    
    function getYoutubeEmbedUrl($url){
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
    
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
    
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }
    
    
    public function destroy($ids){
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $galleryVideo = GalleryVideo::findOrFail($id);
            $galleryVideo->delete();
        }
    }

}
