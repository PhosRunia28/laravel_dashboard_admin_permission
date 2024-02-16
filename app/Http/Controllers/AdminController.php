<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view("admin.index");
    }
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function adminLogin(){
        return view("admin.admin_login");
    }

    public function adminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view("admin.admin_profile", compact("profileData"));
    }

    public function AdminProfileUpdate(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file("photo")){
            if(!$data["photo"] == null){
                unlink(public_path("upload/admin_images/".$data["photo"]));
            }
            $file = $request->file("photo");
            $fileName = date("YmdHi").$file->getClientOriginalName();
            $file->move(public_path("upload/admin_images"), $fileName);
            $data["photo"] = $fileName;
        }

        $data->update();

        $notification = [
            "message"  => "Admin Profile Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->back()->with($notification);
    }

    public function adminChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view("admin.admin_change_password", compact("profileData"));
    }

    public function AdminUpdatePassword(Request $request){
        $formFields = $request->validate([
            "old_password" => "required",
            "new_password" => ["required","confirmed"],
        ]);

        if(!Hash::check($request->old_password, Auth::user()->password)){
            $notification = [
                "message" => "Old Password Does not match!",
                "alert-type" => "error",
            ];
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            "password"=>  Hash::make($request->new_password),
        ]);
        $notification = [
            "message" => "Password Change Successfully",
            "alert-type" => "success",
        ];
        return back()->with($notification);
    }

    public function AllAdmin(){
        $users = user::all();
        return view("admin.adminSetup.all_admin_setup",compact("users"));
   }
   public function AddAdmin(){
        $roles = Role::all();
        return view("admin.adminSetup.add_admin_setup",compact("roles"));
   }
   public function StoreAdmin(Request $request){
        $request->validate([
            "username" => ["required"],
            "name" => ["required"],
            "email" => ["required","email"],
            "phone" => ["required"],
            "address" => ["required"],
            "password" => ["required"],
            "role_name" => ["required"],
        ]);
        $user = User::create([
            "username" => $request->username,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "password" => Hash::make($request->password),
            "role" => "admin",
            "status" => "active",
        ]);

        if($request->role_name){
            $user->assignRole($request->role_name);
        }

        $notification = [
            "message" => "Admin Added Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.admin")->with($notification);
   }

   public function EditAdmin($id){
     $user = User::find($id);
     $roles = Role::all();
     return view("admin.adminSetup.edit_admin_setup",compact("user","roles"));
   }

   public function UpdateAdmin(Request $request, $id){
        $user = User::find($id);
        $user->update([
            "username" => $request->username,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "role" => "admin",
            "status" => "active",
        ]);

        $user->roles()->detach();
        if($request->role_name){
            $user->assignRole($request->role_name);
        }

        $notification = [
            "message" => "Admin Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.admin")->with($notification);
   }

   public function  DeleteAdmin($id){
        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        $notification = [
            "message" => "Admin Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()->back()->with($notification);
    }
}