@extends("admin.admin_dashboard")
@section("admin")
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Type</h6>
                        <form class="forms-sample" method="POST" action="{{route("update.permission")}}" >
                            @csrf
                            @method("PUT")
                            <input type="hidden" name="id" value={{$permission->id}}>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value={{$permission->name}} name="name" class="form-control @error("name") is-invalid @enderror" id="name" autocomplete="off" placeholder="Name">
                            </div>
                            @error("name")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="group_name" class="form-label">Name</label>
                                <select name="group_name" id="group_name" class="form-select @error("group_name") is-invalid  @enderror">
                                    <option selected="" disabled="">Select Group</option>
                                    <option value="Property Type"
                                    selected={{$permission->group_name == "Property Type" ? "Property Type" : ""}}
                                    >Property Type</option>
                                    <option value="Amenities"
                                    selected={{$permission->group_name == "Amenities" ? "Amenities" : ""}}
                                    >Amenities</option>
                                </select>
                            </div>
                            @error("group_name")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
@endsection
