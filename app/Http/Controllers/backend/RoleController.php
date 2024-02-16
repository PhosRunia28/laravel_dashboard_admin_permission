<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function AllRole(){
        $roles = Role::all();
        return view("admin.roles.all_roles", compact("roles"));
    }
    public function AddRole(){
        return view("admin.roles.add_roles");
    }
    public function StoreRole(Request $request){
        $request->validate([
            "name" => ["required"],
        ]);
        Role::insert([
            "name"=> $request->name,
            "guard_name" => "web",
        ]);

        $notification = [
            "message" => "Role Create Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.roles")->with($notification);
    }

    public function EditRole($id){
        $roles = Role::findOrFail($id);
        return view("admin.roles.edit_roles", compact("roles"));
    }

    public function UpdateRole(Request $request){
        Role::findOrFail($request->id)->update([
            "name" => $request->name,
        ]);

        $notification = [
            "message" => "Roles Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.roles")->with($notification);
    }
    public function DeleteRole($id){
        Role::findOrFail($id)->delete();
        $notification = [
            "message" => "Role Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()->back()->with($notification);
    }

    public function AddRolePermission(){
        $roles = Role::all();
        $permission_groups = Permission::select("group_name")->groupBy("group_name")->get();
        return view("admin.roles.add_roles_permissions", compact("roles", "permission_groups"));
    }

    public function StoreRolePermission(Request $request){
        $data = [];

        $permissions = $request->permission;
        foreach($permissions as $key => $item){
            $data["role_id"] = $request->role_id;
            $data["permission_id"] = $item;

            DB::table("role_has_permissions")->insert($data);
        }


        $notification = [
            "message" => "Role Permission Added Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.roles.permission")->with($notification);
    }

    public function AllRolePermission(){
        $roles = Role::all();
        return view("admin.roles.all_roles_permission",compact("roles"));
    }

    public function EditRolePermission($id){
        $role = Role::find($id);
        $permission_groups = Permission::select("group_name")->groupBy("group_name")->get();
        return view("admin.roles.edit_roles_permission",compact("role","permission_groups"));
    }

    public function UpdateRolePermission(Request $request, $id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $notification = [
            "message" => "Role Permission Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.roles.permission")->with($notification);
    }
}