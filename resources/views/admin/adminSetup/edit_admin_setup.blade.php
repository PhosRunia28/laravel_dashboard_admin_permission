@extends("admin.admin_dashboard")
@section("admin")
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Admin</h6>
                        <form class="forms-sample" method="POST" action="{{route("update.admin", $user->id)}}" >
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Admin User Name</label>
                                <input type="text" name="username" class="form-control @error("username") is-invalid @enderror" id="username" autocomplete="off" placeholder="Admin User Name" value="{{$user->username}}">
                            </div>
                            @error("username")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="name" class="form-label">Admin Name</label>
                                <input type="text" name="name" class="form-control @error("name") is-invalid @enderror" id="name" autocomplete="off" placeholder="Admin Name" value="{{$user->name}}">
                            </div>
                            @error("name")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="email" class="form-label">Admin Email</label>
                                <input type="text" name="email" class="form-control @error("email") is-invalid @enderror" id="email" autocomplete="off" placeholder="Admin Email" value="{{$user->email}}">
                            </div>
                            @error("email")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="phone" class="form-label">Admin Phone</label>
                                <input type="text" name="phone" class="form-control @error("phone") is-invalid @enderror" id="phone" autocomplete="off" placeholder="Admin Phone" value="{{$user->phone}}">
                            </div>
                            @error("phone")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="address" class="form-label">Admin Address</label>
                                <input type="text" name="address" class="form-control @error("address") is-invalid @enderror" id="address" autocomplete="off" placeholder="Admin Address" value="{{$user->address}}">
                            </div>
                            @error("address")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="role_name" class="form-label">Role Name</label>
                                <select name="role_name" id="role_name" class="form-select @error("role_name") is-invalid @enderror">
                                    <option selected="" disabled="">Select Group</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}" selected="{{$user->hasRole($role)}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("role_name")
                                <span class="text-danger">{{$message}}<span>
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
