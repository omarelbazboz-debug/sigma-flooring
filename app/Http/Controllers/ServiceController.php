<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\ProjectAttribute;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service');
    }

    public function index()
    {
        //
        $services = Service::all();
        return view('admin.services.services', compact('services'));
    }


    public function create()
    {
        //
        $services = Service::get();
        return view('admin.services.addService', compact('services'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'link_en' => 'nullable|string|max:255',
            'link_ar' => 'nullable|string|max:255',
            'text_en' => 'nullable|string',
            'text_ar' => 'nullable|string',
            'text1_en' => 'nullable|string',
            'text1_ar' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000', // السماح فقط بـ JPEG, PNG, JPG, GIF
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000', // نفس الشيء للـ banner
            'file' => 'nullable|mimes:pdf|max:10240', // السماح فقط بـ PDF
        ]);

        $add = new Service();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->order = $request->order;
        $add->link_en = str_replace(" ", "-", $request->link_en);
        $add->link_ar = str_replace(" ", "-", $request->link_ar);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->text1_en = $request->text1_en;
        $add->text1_ar = $request->text1_ar;
        $add->file = $request->file;
        $add->alt_img = $request->alt_img;
        $add->youtube_link = $request->youtube_link ? $this->getYoutubeEmbedUrl($request->youtube_link) : '';
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots;
        $add->status = $request->status;
        $add->home = $request->home;
        $add->menu = $request->menu;
        $add->parent_id = $request->parent_id ?? 0;

        if ($request->hasFile("img")) {
            $file = $request->file("img");
           $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');
            $add->img = $fileName;
        }
        if ($request->hasFile("icon")) {

           $file = $request->file("icon");
           $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');
            $add->icon = $fileName;
        }

        if ($request->hasFile("banner")) {
           $file = $request->file("banner");
           $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');
            $add->banner = $fileName;
        }
        if ($request->file('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();

            $folderPath = public_path('uploads/services/pdfs');

            $file = $request->file('file')->move($folderPath, $fileName);

            $add->file = $fileName;
        }

        $add->save();


        return redirect('admin/services')->with('success', trans('home.your_item_added_successfully'));
    }




    public function edit($id)
    {
        //
        $service = Service::find($id);
        if ($service) {
            $questions = Faq::where('type', 'service')->where('service_id', $id)->get();
            $services = Service::get();

            $images = DB::table('temp_upload_files')->where('type', 'service')->where('service_id', $id)->get();
            if ($images->count() > 0) {
                foreach ($images as $image) {
                    try {
                        $img_path = public_path() . '/uploads/services/source/';
                        if ($image->server_name) {
                            file_exists($img_path . $image->server_name) ? unlink($img_path . $image->server_name) : '';
                        }
                    } catch (Exception $e) {
                    }
                }
                DB::table('temp_upload_files')->where('type', 'service')->where('service_id', $id)->delete();
                session()->forget('imagesUpload');
                session()->forget('imagesUploadRealName');
            }
            // جلب جميع المواصفات
            $features = \App\Models\Feature::all();
            return view('admin.services.editService', compact('services', 'service', 'questions','features'));
        } else {
            abort('404');
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'link_en' => 'nullable|string|max:255',
            'link_ar' => 'nullable|string|max:255',
            'text_en' => 'nullable|string',
            'text_ar' => 'nullable|string',
            'text1_en' => 'nullable|string',
            'text1_ar' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1000',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1000',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'file' => 'nullable|mimes:pdf|max:10240',
            'name_color' => 'nullable|string|max:7',
        ]);

        //
        $add = Service::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->name_color = $request->name_color;
        $add->order = $request->order;
        $add->link_en = str_replace(" ", "-", $request->link_en);
        $add->link_ar = str_replace(" ", "-", $request->link_ar);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->text1_en = $request->text1_en;
        $add->text1_ar = $request->text1_ar;
        $add->file = $request->file;
        $add->alt_img = $request->alt_img;
        $add->youtube_link = $request->youtube_link ? $this->getYoutubeEmbedUrl($request->youtube_link) : '';
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots;
        $add->status = $request->status;
        $add->home = $request->home;
        $add->menu = $request->menu;
        $add->parent_id = $request->parent_id ?? 0;

        if ($request->hasFile("img")) {
            $file = $request->file("img");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');
            SaveImageTo3Path::deleteImage(  $add->img, 'services');
            $add->img = $fileName;
        }

        if ($request->hasFile("file")) {
            $folderPath = public_path('uploads/services/pdfs');

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            if ($add->file && File::exists($folderPath . '/' . $add->file)) {
                File::delete($folderPath . '/' . $add->file);
            }

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $file = $request->file('file')->move($folderPath, $fileName);
            $add->file = $fileName;
        }

        if ($request->hasFile("icon")) {
             $file = $request->file("icon");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');
            SaveImageTo3Path::deleteImage(  $add->icon, 'services');
            $add->icon = $fileName;
        }

        if ($request->hasFile("banner")) {
            $file = $request->file("banner");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');
            SaveImageTo3Path::deleteImage(  $add->banner, 'services');
            $add->banner = $fileName;
        }

        $add->save();

        //////////// add faqs/////////////

        // حذف جميع الأسئلة القديمة المرتبطة بالخدمة قبل إضافة الأسئلة الجديدة
        Faq::where('service_id', $id)->where('type', 'service')->delete();

        // دعم الحقول الجديدة faqs[]
        if ($request->has('faqs') && is_array($request->faqs)) {
            foreach ($request->faqs as $faq) {
                // دعم تعدد اللغات للعنوان والنص
                $hasTitle = (isset($faq['title_ar']) && !empty($faq['title_ar'])) || (isset($faq['title_en']) && !empty($faq['title_en']));
                $hasText = (isset($faq['text_ar']) && !empty($faq['text_ar'])) || (isset($faq['text_en']) && !empty($faq['text_en']));
                if ($hasTitle || $hasText) {
                    $newFaq = new Faq();
                    $newFaq->service_id = $add->id;
                    $newFaq->type = 'service';
                    // الحقول الجديدة
                    $newFaq->title_ar = $faq['title_ar'] ?? null;
                    $newFaq->title_en = $faq['title_en'] ?? null;
                    $newFaq->text_ar = $faq['text_ar'] ?? null;
                    $newFaq->text_en = $faq['text_en'] ?? null;
                    // حذف التوافق مع الحقول القديمة (title/text)
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


        // ربط المواصفات (features) مع المشروع
        $add->features()->sync($request->features ?? []);
        //////// save project attributes///////////////
        ///////// save service images//////
        if (Session::has('imagesUpload')) {
            //            $images = \Session::get('imagesUpload');
            $images = DB::table('temp_upload_files')->where('service_id', $id)->get();
            foreach ($images as $key => $file) {
                $img = new ServiceImage();
                $img->image = $file->server_name;
                $img->service_id = $add->id;
                $img->save();
            }
        }

        DB::table('temp_upload_files')->where('service_id', $id)->delete();
        session()->forget('imagesUpload');
        session()->forget('imagesUploadRealName');
        return redirect('admin/services')->with('success', trans('home.your_item_added_successfully'));
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
            $service = Service::findOrFail($id);
            $img_path = public_path() . '/uploads/services/source/';

            if ($service->img != null) {
                file_exists($img_path . $service->img) ? unlink($img_path . $service->img) : '';
            }

            if ($service->icon != null) {
                file_exists($img_path . $service->icon) ? unlink($img_path . $service->icon) : '';
            }

            $service->delete();
        }
    }


    /////// upload product images///////////////
    public function uploadImages(Request $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file("file");
            $realName = $file->getClientOriginalName();
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('services');

            DB::table('temp_upload_files')->insert(['server_name' => $fileName, 'original_name' => $realName, 'service_id' => $request->serviceId, 'type' => 'service']);
            if (Session::has('imagesUpload')) {
                Session::push('imagesUpload', $fileName);
                Session::push('imagesUploadRealName', $realName);
            } else {
                $images = [];
                array_push($images, $fileName);
                Session::put('imagesUpload', $images);
                $realImages = [];
                array_push($realImages, $realName);
                Session::put('imagesUploadRealName', $realImages);
            }
        }
    }

    ///////// delete uploaded images///////////
    public function removeUploadImages(Request $request)
    {
        $name = $request->name;
        $names = Session::get('imagesUploadRealName');
        $images = Session::get('imagesUpload');
        $key = array_search($name, $names);

        $img_path = public_path() . '/uploads/services/source/';
        unlink(sprintf($img_path . '%s', $images[$key]));
        unset($images[$key]);
        unset($names[$key]);
        Session::put('imagesUpload', $images);
        Session::put('imagesUploadRealName', $names);
        DB::table('temp_upload_files')->where('original_name', $name)->delete();
    }

    public function deleteImege()
    {
        $serviceId = $_POST['serviceId'];
        $image = $_POST['image'];
        $img = ServiceImage::where('service_id', $serviceId)->where('id', $image)->first();

        $img_path = public_path() . '/uploads/services/source/';

        if ($img->image != null) {
            file_exists($img_path . $img->image) ? unlink($img_path . $img->image) : '';
        }
        $img->delete();
    }

    function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }

    public function copy()
    {
        $ids = $_POST['ids'];
        $img_path = public_path() . '/uploads/services/source/';
        foreach ($ids as $index => $id) {
            $old_service = Service::findOrFail($id);
            $new_service = new Service();
            $new_service->name_en = $old_service->name_en;
            $new_service->name_ar = $old_service->name_ar;
            $new_service->order = $old_service->order;
            $new_service->link_en = $old_service->link_en ? preg_replace("/[ \/]/", "-", $old_service->link_en) : preg_replace("/[ \/]/", "-", $old_service->title_en) . '-' . $index;
            $new_service->link_ar = $old_service->link_ar ? preg_replace("/[ \/]/", "-", $old_service->link_ar) : preg_replace("/[ \/]/", "-", $old_service->title_ar) . '-' . $index;
            $new_service->alt_img = $old_service->alt_img;
            $new_service->status = $old_service->status;
            $new_service->home = $old_service->home;
            $new_service->text_en = $old_service->text_en;
            $new_service->text_ar = $old_service->text_ar;
            $new_service->youtube_link = $old_service->youtube_link;
            $new_service->meta_title_en = $old_service->meta_title_en;
            $new_service->meta_title_ar = $old_service->meta_title_ar;
            $new_service->meta_desc_en = $old_service->meta_desc_en;
            $new_service->meta_desc_ar = $old_service->meta_desc_ar;
            $new_service->meta_robots = $old_service->meta_robots;
            $new_service->parent_id = $old_service->parent_id;

            if ($old_service->icon != null) {
                $new_image_path = $img_path . 'service_' . $index . '_' . $old_service->icon;
                if (file_exists($img_path . $old_service->icon)) {
                    copy($img_path . $old_service->icon, $new_image_path);
                }
                $new_service->icon = 'service_' . $index . '_' . $old_service->icon;
            }
            if ($old_service->img != null) {
                $new_image_path = $img_path . 'service_' . $index . '_' . $old_service->img;
                if (file_exists($img_path . $old_service->img)) {
                    copy($img_path . $old_service->img, $new_image_path);
                }
                $new_service->img = 'service_' . $index . '_' . $old_service->img;
            }

            $new_service->save();
        }
    }

    public function deleteAllIMages()
    {
        $service_id = $_POST['id'];
        $imgs = ServiceImage::where('service_id', $service_id)->get();

        $img_path = public_path() . '/uploads/services/source/';
        foreach ($imgs as $img) {
            if ($img->image != null) {
                file_exists($img_path . $img->image) ? unlink($img_path . $img->image) : '';
            }
            $img->delete();
        }
    }
}
