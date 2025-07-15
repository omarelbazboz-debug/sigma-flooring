<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogItem;
use App\Models\BlogCategory;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Image;
use App\Models\Faq;

class BlogItemController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:blogItem');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogItems = BlogItem::orderBy('id','desc')->get();
        return view('admin.blogItems.blogItems',compact('blogItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $blogCategories = BlogCategory::where('status',1)->get();
        return view('admin.blogItems.addBlogItem',compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'link_en' => 'nullable|string|max:255',
            'link_ar' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'alt_img' => 'nullable|string|max:255',
            'alt_banner' => 'nullable|string|max:255',
            'shorttext__en' => 'nullable|string',
            'shorttext__ar' => 'nullable|string',
            'status' => 'nullable|boolean',
            'home' => 'nullable|boolean',
            'text_en' => 'nullable|string',
            'text_ar' => 'nullable|string',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_desc_en' => 'nullable|string|max:500',
            'meta_desc_ar' => 'nullable|string|max:500',
            'meta_robots' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'question.*' => 'nullable|string|max:255',
            'answer.*' => 'nullable|string|max:1000',
        ]);

        // باقي الكود الخاص بالإضافة
        $blogitem = new BlogItem();
        $blogitem->title_en = $request->title_en;
        $blogitem->title_ar = $request->title_ar;
        $blogitem->blogcategory_id = $request->blogcategory_id;
        $blogitem->link_en = $request->link_en ? preg_replace("/[ \/]/", "-", $request->link_en) : preg_replace("/[ \/]/", "-", $request->title_en);
        $blogitem->link_ar = $request->link_ar ? preg_replace("/[ \/]/", "-", $request->link_ar) : preg_replace("/[ \/]/", "-", $request->title_ar);
        $blogitem->date = $request->date;
        $blogitem->alt_img = $request->alt_img;
        $blogitem->alt_banner = $request->alt_banner;
        $blogitem->writer_id = $request->writer_id;
        $blogitem->status = $request->status ?? 0;
        $blogitem->home = $request->home;
        $blogitem->text_en = $request->text_en;
        $blogitem->text_ar = $request->text_ar;
        $blogitem->meta_title_en = $request->meta_title_en;
        $blogitem->meta_title_ar = $request->meta_title_ar;
        $blogitem->meta_desc_en = $request->meta_desc_en;
        $blogitem->meta_desc_ar = $request->meta_desc_ar;
        $blogitem->meta_robots = $request->meta_robots;

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/blogitems/source/' . $fileName);
            Image::make($file->getRealPath())->save($path);
            $blogitem->image = $fileName;
        }

        if ($request->hasFile("banner")) {
            $file = $request->file("banner");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/blogitems/source/' . $fileName);
            Image::make($file->getRealPath())->save($path);
            $blogitem->banner = $fileName;
        }

        $blogitem->save();

        // حذف جميع الأسئلة القديمة المرتبطة بالمقال قبل إضافة الأسئلة الجديدة
        Faq::where('blog_item_id', $blogitem->id)->where('type', 'blog_item')->delete();

        // دعم الحقول الجديدة faqs[]
        if ($request->has('faqs') && is_array($request->faqs)) {
            foreach ($request->faqs as $faq) {
                $hasTitle = (isset($faq['title_ar']) && !empty($faq['title_ar'])) || (isset($faq['title_en']) && !empty($faq['title_en']));
                $hasText = (isset($faq['text_ar']) && !empty($faq['text_ar'])) || (isset($faq['text_en']) && !empty($faq['text_en']));
                if ($hasTitle || $hasText) {
                    $newFaq = new Faq();
                    $newFaq->blog_item_id = $blogitem->id;
                    $newFaq->type = 'blog_item';
                    $newFaq->title_ar = $faq['title_ar'] ?? null;
                    $newFaq->title_en = $faq['title_en'] ?? null;
                    $newFaq->text_ar = $faq['text_ar'] ?? null;
                    $newFaq->text_en = $faq['text_en'] ?? null;
                    if (isset($faq['image']) && $faq['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $image = $faq['image'];
                        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/faqs'), $imageName);
                        $newFaq->image = $imageName;
                    }
                    $newFaq->status = 1;
                    $newFaq->save();
                }
            }
        }

        // إضافة الأسئلة القديمة (للتوافق)
        $questions = $request->question;
        $answers = $request->answer;
        if ($questions) {
            foreach ($questions as $key => $question) {
                if ($question) {
                    $faq = new Faq();
                    $faq->blog_item_id = $blogitem->id;
                    $faq->type = 'blog_item';
                    $faq->question = $question;
                    $faq->answer = $answers[$key];
                    $faq->save();
                }
            }
        }

        return redirect()->route('blog-items.index')->with('success', trans('home.your_item_added_successfully'));
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
        $blogItem = BlogItem::find($id);
        if($blogItem){
            $blogCategories = BlogCategory::where('status',1)->get();
            $questions = Faq::where('type','blog_item')->where('blog_item_id',$id)->get();
            return view('admin.blogItems.editBlogItem',compact('blogCategories','blogItem','questions'));
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
        // التحقق من صحة البيانات
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'link_en' => 'nullable|string|max:255',
            'link_ar' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'alt_img' => 'nullable|string|max:255',
            'alt_banner' => 'nullable|string|max:255',
            'shorttext_en' => 'nullable|string',
            'shorttext_ar' => 'nullable|string',
            'status' => 'nullable|boolean',
            'home' => 'nullable|boolean',
            'text_en' => 'nullable|string',
            'text_ar' => 'nullable|string',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_desc_en' => 'nullable|string|max:500',
            'meta_desc_ar' => 'nullable|string|max:500',
            'meta_robots' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'question.*' => 'nullable|string|max:255',
            'answer.*' => 'nullable|string|max:1000',
        ]);

        // باقي الكود الخاص بالتحديث
        $blogitem = BlogItem::find($id);
        $blogitem->title_en = $request->title_en;
        $blogitem->title_ar = $request->title_ar;
        $blogitem->blogcategory_id = $request->blogcategory_id;
        $blogitem->link_en = $request->link_en?preg_replace("/[ \/]/", "-", $request->link_en):preg_replace("/[ \/]/", "-", $request->title_en);
        $blogitem->link_ar = $request->link_ar?preg_replace("/[ \/]/", "-", $request->link_ar):preg_replace("/[ \/]/", "-", $request->title_ar);
        $blogitem->date = $request->date;
        $blogitem->alt_img = $request->alt_img;
        $blogitem->writer_id = $request->writer_id;
        $blogitem->status = $request->status;
        $blogitem->home = $request->home;
        $blogitem->text_en = $request->text_en;
        $blogitem->text_ar = $request->text_ar;
        $blogitem->shorttext_en = $request->shorttext_en;
        $blogitem->shorttext_ar = $request->shorttext_ar;
        $blogitem->meta_title_en = $request->meta_title_en;
        $blogitem->meta_title_ar = $request->meta_title_ar;
        $blogitem->meta_desc_en =$request->meta_desc_en;
        $blogitem->meta_desc_ar =$request->meta_desc_ar;
        $blogitem->meta_robots =$request->meta_robots;
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/blogitems/source/';

            if ($blogitem->image != null) {
                file_exists($img_path.$blogitem->image) ? unlink(sprintf($img_path . '%s', $blogitem->image)):'';
            }
           // $destinationPath = public_path() . '/uploads/'; // upload path   
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/blogitems/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);
            $blogitem->image = $fileName;
        }
        if ($request->hasFile("banner")) {

            $file = $request->file("banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/blogitems/source/';

            if ($blogitem->banner != null) {
                file_exists($img_path.$blogitem->banner) ? unlink(sprintf($img_path . '%s', $blogitem->banner)):'';
            }
           // $destinationPath = public_path() . '/uploads/'; // upload path   
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/blogitems/source/' . $fileName);

            Image::make($file->getRealPath())->save($path);
            $blogitem->banner = $fileName;
        }
        $blogitem->save();
        
        // حذف جميع الأسئلة القديمة المرتبطة بالمقال قبل إضافة الأسئلة الجديدة
        Faq::where('blog_item_id', $blogitem->id)->where('type', 'blog_item')->delete();

        // دعم الحقول الجديدة faqs[]
        if ($request->has('faqs') && is_array($request->faqs)) {
            foreach ($request->faqs as $faq) {
                $hasTitle = (isset($faq['title_ar']) && !empty($faq['title_ar'])) || (isset($faq['title_en']) && !empty($faq['title_en']));
                $hasText = (isset($faq['text_ar']) && !empty($faq['text_ar'])) || (isset($faq['text_en']) && !empty($faq['text_en']));
                if ($hasTitle || $hasText) {
                    $newFaq = new Faq();
                    $newFaq->blog_item_id = $blogitem->id;
                    $newFaq->type = 'blog_item';
                    $newFaq->title_ar = $faq['title_ar'] ?? null;
                    $newFaq->title_en = $faq['title_en'] ?? null;
                    $newFaq->text_ar = $faq['text_ar'] ?? null;
                    $newFaq->text_en = $faq['text_en'] ?? null;
                    if (isset($faq['image']) && $faq['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $image = $faq['image'];
                        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/faqs'), $imageName);
                        $newFaq->image = $imageName;
                    }
                    $newFaq->status = 1;
                    $newFaq->save();
                }
            }
        }

        // إضافة الأسئلة القديمة (للتوافق)
        $questions=$request->question;
        $answers =$request->answer;
        $statuses =$request->faq_status;
        if($questions){
            foreach($questions as $key=>$question){
                if($question){
                    $faq=new Faq();
                    $faq->blog_item_id=$blogitem->id;
                    $faq->type='blog_item';
                    $faq->question=$question;
                    $faq->answer=$answers[$key];
                    $faq->save();
                }
            }
        }
        return redirect()->route('blog-items.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
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
        foreach ($ids as $id) {
            $m = BlogItem::findOrFail($id);
            $img_path = public_path() . '/uploads/blogitems/source/';

            if ($m->image != null) {
                file_exists($img_path.$m->image) ? unlink($img_path .$m->image):'';
            }
            $m->delete();
        }
    }
    
    public function updateFaq(Request $request){
        $faq=Faq::find($request->faq_id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        // $faq->statue = $request->statue;
        $faq->save();
        return back()->with('success',trans('home.faq_updated_successfully'));

    }
    
    public function removeFaq(){
        $faqId= $_POST['faq_id'];
        Faq::find($faqId)->delete();
    }

    public function copy(){
        $ids= $_POST['ids'];
        $img_path = public_path() . '/uploads/blogitems/source/';
        foreach ($ids as $index=>$id) {
            $old_blog = BlogItem::findOrFail($id);
            
            $new_blog = new BlogItem();
            $new_blog->title_en = $old_blog->title_en;
            $new_blog->title_ar = $old_blog->title_ar;
            $new_blog->blogcategory_id = $old_blog->blogcategory_id;
            $new_blog->link_en = $old_blog->link_en?preg_replace("/[ \/]/", "-", $old_blog->link_en):preg_replace("/[ \/]/", "-", $old_blog->title_en).'-'.$index;
            $new_blog->link_ar = $old_blog->link_ar?preg_replace("/[ \/]/", "-", $old_blog->link_ar):preg_replace("/[ \/]/", "-", $old_blog->title_ar).'-'.$index;
            $new_blog->date = $old_blog->date;
            $new_blog->alt_img = $old_blog->alt_img;
            $new_blog->writer_id = $old_blog->writer_id;
            $new_blog->status = $old_blog->status;
            $new_blog->home = $old_blog->home;
            $new_blog->text_en = $old_blog->text_en;
            $new_blog->text_ar = $old_blog->text_ar;
            $new_blog->shorttext_en = $old_blog->shorttext_en;
            $new_blog->shorttext_ar = $old_blog->shorttext_ar;
            $new_blog->meta_title_en = $old_blog->meta_title_en;
            $new_blog->meta_title_ar = $old_blog->meta_title_ar;
            $new_blog->meta_desc_en =$old_blog->meta_desc_en;
            $new_blog->meta_desc_ar =$old_blog->meta_desc_ar;
            $new_blog->meta_robots =$old_blog->meta_robots;
            if ($old_blog->image != null) {
                $new_image_path = $img_path . 'blogItem_'.$index.'_' . $old_blog->image;
                if (file_exists($img_path . $old_blog->image)) {
                    copy($img_path . $old_blog->image, $new_image_path);
                }              
                $new_blog->image = 'blogItem_'.$index.'_'.$old_blog->image;
            }            

            $new_blog->save();

        }
    }
}
