<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AmenitiesController extends Controller
{
    public function AllAmenities(){
        $types = Amenities::latest()->get();
        return view("admin.amenities.all_aminities", compact("types"));
    }
    public function AddAmenities(){
        return view("admin.amenities.add_amenities");
    }
    public function StoreAmenities(Request $request){
        $request->validate([
            "amenitie_name" => ["required","max:200", Rule::unique("amenities", "amenitie_name")],
        ]);

        Amenities::insert([
            "amenitie_name"=> $request->amenitie_name,
        ]);

        $notification = [
            "message" => "Amenitie Create Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.amenities")->with($notification);
    }

    public function EditAmenities($id){
        $type = Amenities::findOrFail($id);
        return view("admin.amenities.edit_aminities",compact("type"));
    }

    public function UpdateAmenities(Request $request){
        Amenities::findOrFail($request->id)->update([
            "amenitie_name" => $request->amenitie_name,
        ]);

        $notification = [
            "message" => "Amenitie Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()->route("all.amenities")->with($notification);
    }
    public function DeleteAmenities($id){
        
        Amenities::findOrFail($id)->delete();

        $notification = [
            "message" => "Amenitie Deleted Successfully",
            "alert-type" => "success",
        ];
        return redirect()->back()->with($notification);
    }
}