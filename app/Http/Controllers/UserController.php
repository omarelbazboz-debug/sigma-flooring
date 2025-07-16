<?php

namespace App\Http\Controllers;

use App\Helpers\SaveImageTo3Path;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        //$this->middleware('permission:user');
    }



    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.users',compact('users'));
    }


    public function create()
    {
        //
        $roles = Role::get();
        return view('admin.users.addUser',compact('roles'));
    }

    public function store(Request $request)
    {
        //
        $token = Str::random(80);
        $add = new User();

        $add->f_name = $request->f_name;
        $add->l_name = $request->l_name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->password = bcrypt($request->password);
        $add->remember_token = $token;
        $add->is_admin = $request->admin;

        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('users');
            $add->image = $fileName;
        }

        $add->save();

        if ($request->role){
            $roles=$request->role;
            foreach ($roles as $role) {
                $add->assignRole($role);
            }
        }

        return redirect('admin/users')->with('success',trans('home.your_item_added_successfully'));
    }


    public function edit($id)
    {
        //
        $user = User::find($id);
        $user->admin_seen =1;
        $user->save();
        $roles = Role::get();
        $userRoles = $user->roles ->pluck('name') ->toArray();
        return view('admin.users.editUser',compact('user','roles','userRoles'));
    }

    public function update(Request $request, $id)
    {

        //
        $update = User::find($id);
        $update->is_admin = $request->admin;
        $update->f_name = $request->f_name;
        $update->l_name = $request->l_name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        if ($request->password) {
            $update->password = bcrypt($request->password);
        }

        if ( $request->hasFile("image")) {
            $file = $request->file("image");
            $saveImage = new SaveImageTo3Path($file,true);
            $fileName = $saveImage->saveImages('users');
            SaveImageTo3Path::deleteImage(  $update->image, 'users');
            $update->image = $fileName;
        }

        $update->save();

       DB::table('model_has_roles')->where('model_id',$id)->delete();

        if ($request->role){
            $roles=$request->role;
            foreach ($roles as $role) {
                $update->assignRole($role);
            }
        }
        return redirect('admin/users')->with('success',trans('home.your_item_updated_successfully'));
    }


    public function destroy($ids)
    {
        //
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $user = User::findOrFail($id);
            $img_path = public_path() . '/uploads/users/source/';
            $img_path200 = public_path() . '/uploads/users/resize200/';
            $img_path800 = public_path() . '/uploads/users/resize800/';
            if ($user->image != null) {
                file_exists($img_path.$user->image) ? unlink(sprintf($img_path . '%s', $user->image)):'';
                file_exists($img_path200.$user->image) ? unlink(sprintf($img_path200 . '%s', $user->image)):'';
                file_exists($img_path800.$user->image) ? unlink(sprintf($img_path800 . '%s', $user->image)):'';
            }
            $user->delete();
        }
    }
}
