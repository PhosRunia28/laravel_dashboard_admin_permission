<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PropertyTypeController extends Controller
{
    public function AllType(){
        $types = PropertyType::latest()->get();
        return view("admin.type.all_type", compact("types"));
    }
    public function AddType(){
        return view("admin.type.add_type");
    }
    public function StoreType(Request $request){
        $request->validate([
            "type_name" => ["required","max:200", Rule::unique("property_types", "type_name")],
            "type_icon" => ["required"],
        ]);

        PropertyType::insert([
            "type_name"=> $request->type_name,
            "type_icon"=> $request->type_icon,
        ]);

        $notification = [
            "message" => "Property Type Create Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.type")->with($notification);
    }

    public function EditType($id){
        $type = PropertyType::findOrFail($id);
        return view("admin.type.edit_type",compact("type"));
    }

    public function UpdateType(Request $request){
        $pid = $request->id;
        PropertyType::findOrFail($pid)->update([
            "type_name" => $request->type_name,
            "type_icon" => $request->type_icon,
        ]);

        $notification = [
            "message" => "Property Type Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.type")->with($notification);
    }
    public function DeleteType($id){
        
        PropertyType::findOrFail($id)->delete();

        $notification = [
            "message" => "Property Type Deleted Successfully",
            "alert-type" => "success",
        ];
        return redirect()->back()->with($notification);
    }
}