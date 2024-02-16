<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view("admin.permission.all_permission", compact("permissions"));
    }
    public function AddPermission(){
        return view("admin.permission.add_permission");
    }
    public function StorePermission(Request $request){
        $request->validate([
            "name" => ["required"],
            "group_name" => ["required"],
        ]);
        Permission::insert([
            "name"=> $request->name,
            "group_name"=> $request->group_name,
            "guard_name" => "web",
        ]);

        $notification = [
            "message" => "Permission Create Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.permission")->with($notification);
    }

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);
        return view("admin.permission.edit_permission", compact("permission"));
    }

    public function UpdatePermission(Request $request){
        Permission::findOrFail($request->id)->update([
            "name" => $request->name,
            "group_name" => $request->group_name,
        ]);

        $notification = [
            "message" => "Permission Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.permission")->with($notification);
    }
    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();
        $notification = [
            "message" => "Permission Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()->back()->with($notification);
    }
}