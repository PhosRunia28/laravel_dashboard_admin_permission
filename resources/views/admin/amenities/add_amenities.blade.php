@extends("admin.admin_dashboard")
@section("admin")
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Amenitie</h6>
                        <form class="forms-sample" method="POST" action="{{route("store.amenities")}}" >  
                            @csrf
                            <div class="mb-3">
                                <label for="amenitie_name" class="form-label">Amenitie Name</label>
                                <input type="text" name="amenitie_name" class="form-control @error("amenitie_name") is-invalid @enderror" id="amenitie_name" autocomplete="off" placeholder="Amenitie Name">
                            </div>
                            @error("amenitie_name")
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