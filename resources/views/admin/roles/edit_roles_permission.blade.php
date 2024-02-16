
@extends("admin.admin_dashboard")
@section("admin")
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Roles in Permission</h6>
                        <form class="forms-sample" method="POST" action="{{route("update.roles.permission", $role->id)}}">
                            @csrf
                            <div class="form-group mb-3">
                                <h3>{{$role->name}}</h3>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkAll">
                                <label class="form-check-label" for="checkAll">
                                    Permission All
                                </label>
                            </div>
                            <br>
                            @foreach ($permission_groups as $group)
                            @php
                                $permissions = App\Models\User::getPermissionName($group->group_name);
                            @endphp
                            <div class="row mb-2">
                                <div class="col-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkGroupName_{{$group->group_name}}" value="{{$group->group_name}}" {{App\Models\User::roleHasPermission($role, $permissions) ? "checked" : ""}}>
                                        <label class="form-check-label" for="checkGroupName_{{$group->group_name}}">
                                            {{$group->group_name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @foreach ($permissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkPermission_{{$permission->id}}" value="{{$permission->name}}" name="permission[]" {{$role->hasPermissionTo($permission->name) ? "checked":""}}>
                                        <label class="form-check-label" for="checkPermission_{{$permission->id}}">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary me-2 mt-3">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    $('#checkAll').click(function(){
        if($(this).is(":checked")){
            $("input[type=checkbox]").prop("checked",true);
        } else {
            $("input[type=checkbox]").prop("checked",false);
        }
    })
</script>
@endsection
