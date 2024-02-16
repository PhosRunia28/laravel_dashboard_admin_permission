@extends("admin.admin_dashboard")
@section("admin")

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route("add.amenities")}}" class="btn btn-inverse-info">Add Amenitie</a>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Amenities All</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Amenitie Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->amenitie_name}}</td>
                            <td>
                                @if (Auth::user()->can("edit.amenitie"))
                                <a href="{{route("edit.amenities", $item->id)}}" class="btn btn-inverse-danger">Edit</a>
                                @endif
                                @if (Auth::user()->can("delete.amenitie"))
                                <a href="{{route("delete.amenities", $item->id)}}" class="btn btn-inverse-warning" id="delete">Delete</a>
                                @endif
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
