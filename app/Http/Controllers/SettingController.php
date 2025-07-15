<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:setting');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings =Setting::first();
        return view('admin.settings.setting',compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $settings=Setting::first();
        $settings->default_lang = $request->default_lang;
        $settings->contact_email = $request->contact_email;
        $settings->email = $request->email;
        $settings->telphone = $request->telphone;
        $settings->mobile = $request->mobile;
        $settings->fax = $request->fax;
        $settings->facebook = $request->facebook;
        $settings->linkedin = $request->linkedin;
        $settings->instgram = $request->instgram;
        $settings->twitter = $request->twitter;
        $settings->lat = $request->lat;
        $settings->lng = $request->lng;
        $settings->map_url = $request->map_url;
        $settings->map_view = $request->map_view;
        $settings->whatsapp = $request->whatsapp;
        $settings->snapchat = $request->snapchat;
        $settings->tiktok = $request->tiktok;
        $settings->youtube = $request->youtube;
        $settings->cetificates = $request->cetificates;
        $settings->exp_years = $request->exp_years;
        $settings->surgeries = $request->surgeries;
        $settings->consult = $request->consult;
        $settings->gtm_script = $request->gtm_script;
        $settings->gtm_noscript = $request->gtm_noscript;
        $settings->copyright = $request->copyright;
        $settings->publish_gtm_script = $request->publish_gtm_script;
        $settings->publish_contact_modal = $request->publish_contact_modal;
        if ($request->hasFile("contact_image")) {

            $file = $request->file("contact_image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = public_path() . '/uploads/settings/source/';
            if ($settings->contact_image != null) {
                file_exists($img_path.$settings->contact_image) ? unlink($img_path .$settings->contact_image):'';

            }
            // $destinationPath = public_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = public_path('uploads/settings/source/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $settings->contact_image = $fileName;
        }

            if ($request->hasFile("file")) {
            $folderPath = public_path('uploads/settings/pdfs');

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            if ($settings->file && File::exists($folderPath . '/' . $settings->file)) {
                File::delete($folderPath . '/' . $settings->file);
            }

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $file = $request->file('file')->move($folderPath, $fileName);
            $settings->file = $fileName;
        }
        $settings->save();

        return back()->with('success',trans('home.settings_updated_successfully'));
    }


}
