<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('admin.roles.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions= Permission::all();
        return view('admin.roles.addRole',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect('admin/roles')->with('success',trans('home.your_item_added_successfully'));
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
        $role = Role::find($id);
        $allPermissions= Permission::all();
        $rolePermissions= $role->permissions()->pluck('name')->toArray();
        return view('admin.roles.editRole',compact('role','allPermissions','rolePermissions'));
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
        return redirect('admin/roles')->with('success',trans('home.your_item_updated_successfully'));
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
            $role = Role::findOrFail($id);
            $role->delete();
        }
    }
}
