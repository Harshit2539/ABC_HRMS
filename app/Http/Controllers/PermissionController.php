<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionController extends Controller
{
    public function index(){

        $permission['data']=Permission::all();
        return view('permissions.index', $permission);
    }

    public function create(){
        return view('permissions.create');
    }

    public function store(Request $request){

        $validated=$request->validate([
            'name'=>'required|min:3',
            'module_name'=>'required'
        ]);
  
       Permission::Create($validated);
       $request->session()->flash('message','New Permission Added');
       return redirect(route('permission.listing'));

    }
    public function edit(Permission $id){
        $data['roles']=Role::all();
        $data['permission']=$id;
        return view('permissions.edit', $data);

    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required|min:3',
            'module_name' => 'required',
        ]);
        $permission=Permission::find($id);
        $permission->name=$request->name;
        $permission->module_name=$request->module_name;
        $permission->save();
        $request->session()->flash('message', 'Permission Update Successfully');
        return redirect(route('permission.listing'));

}

    public function giveRole(Request $request, Permission $permission)
    {
      if($permission->hasRole($request->role)){
        return redirect()->back()->with('message', 'Role already exist');
      }else{
        $permission->assignRole($request->role);
        return redirect()->back()->with('message', 'Role assigned Succesfully');

      }
    }

    public function revokeRole(Permission $permission, Role $role)
    {
      if($permission->hasRole($role)){
        $permission->removeRole($role);
        return redirect()->back()->with('message', 'Remove Role');
      }
        return redirect()->back()->with('message', 'Role not exist');
    }

}
