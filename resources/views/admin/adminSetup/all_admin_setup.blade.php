@extends("admin.admin_dashboard")
@section("admin")

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route("add.admin")}}" class="btn btn-inverse-info">Add Admin</a>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Admin</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img class="wd-100 rounded-circle" src="{{(!empty($user->photo)) ? url("upload/admin_images/".$user->photo) : url("upload/no_image.jpg")}}" alt="profile">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            {{-- @php
                                dd($user->roles);
                            @endphp --}}
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-secondary">{{$role->name}}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route("edit.admin", $user->id)}}" class="btn btn-inverse-danger">Edit</a>
                                <a href="{{route("delete.admin", $user->id)}}" class="btn btn-inverse-warning" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


@endsection
