<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:role');
    }


    public function index()
    {
        //
        $roles = Role::all();
        return view('admin.roles.roles',compact('roles'));
    }


    public function create()
    {
        //
        $permissions= Permission::all();
        return view('admin.roles.addRole',compact('permissions'));
    }

    public function store(Request $request)
    {
        //
        $role = Role::create(['name' => $request->name]);
        if($request->all_permissions){
            $permissions = DB::table('permissions')->pluck('id')->toArray();
            foreach($permissions as $permission){
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                    'role_id' => $role->id  
                ]);
            }
        }else{
            $role->syncPermissions($request->permissions);
        }
        return redirect(LaravelLocalization::getCurrentLocale().'/admin/roles')->with('success',trans('home.your_item_added_successfully'));
    }

    public function edit($id)
    {
        //
        $role = Role::find($id);
        $allPermissions= Permission::all();
        $rolePermissions= $role->permissions()->pluck('name')->toArray();
        return view('admin.roles.editRole',compact('role','allPermissions','rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        //
        $role = Role::find($id);
        $role->name= $request->name;
        $role->save();

        if($request->all_permissions){
            DB::table('role_has_permissions')->where('role_id',$id)->delete();
            $permissions = DB::table('permissions')->pluck('id')->toArray();
            foreach($permissions as $permission){
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                    'role_id' => $role->id  
                ]);
            }
        }else{
            $rolePermissions= $role->permissions()->get();
            foreach($rolePermissions as $rolePermission){
                $role->revokePermissionTo($rolePermission);
            }

            $role->syncPermissions($request->permissions);
        }
        return redirect(App::getLocale().'/admin/roles')->with('success',trans('home.your_item_updated_successfully'));
    }


    public function destroy($ids)
    {
        //
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $role = Role::findOrFail($id);
            $role->delete();
        }
    }
}
