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
                        <form class="forms-sample" method="POST" action="{{route("update.type")}}" >  
                            @csrf
                            @method("PUT")
                            <input type="hidden" name="id" value="{{$type->id}}">
                            <div class="mb-3">
                                <label for="type_name" class="form-label">Type Name</label>
                                <input type="text" name="type_name" class="form-control @error("type_name") is-invalid @enderror" value="{{$type->type_name}}" id="type_name" autocomplete="off" placeholder="Type Name">
                            </div>
                            @error("type_name")
                                <span class="text-danger">{{$message}}</span>                                
                            @enderror
                            <div class="mb-3">
                                <label for="type_icon" class="form-label">Type Icon</label>
                                <input type="text" name="type_icon" class="form-control @error("type_icon") is-invalid @enderror" value="{{$type->type_icon}}" id="type_icon" autocomplete="off" placeholder="Type Icon">
                            </div>
                            @error("type_icon")
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