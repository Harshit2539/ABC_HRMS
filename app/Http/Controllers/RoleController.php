<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {

        $roles['data'] = Role::all();
        return view('roles.index', $roles);
    }
    public function create()
    {

        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);
        Role::Create($validated);
        $request->session()->flash('message', 'New Role Added');
        return redirect(route('role.listing'));
    }

    public function edit(Role $id)
    {
        $data['modules'] = Permission::select('module_name')->distinct()->orderBy('module_name')->get()->toArray();

        $data['role'] = $id;
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('roles.edit', $data);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $request->session()->flash('message', 'Role Update Successfully');
        return redirect(route('role.listing'));

    }

    public function givePermission(Request $request, Role $role)
    {

        // $role->givePermissionTo('2');
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()->with('message', 'Permission assigned Succesfully');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return redirect()->back()->with('message', 'Remove permission');
        }
        return redirect()->back()->with('message', 'Permission not exist');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('message', 'Role deleted successfully.');
    }

}
