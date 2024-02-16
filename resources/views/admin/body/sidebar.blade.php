<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
        Easy<span>Learning</span>
        </a>
        <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
            <a href="{{route("dashboard")}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Real Estate</li>
        @if (Auth::user()->can("type.menu"))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#propertyType" role="button" aria-expanded="false" aria-controls="propertyType">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Property Type</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="propertyType">
                <ul class="nav sub-menu">
                    @if (Auth::user()->can("all.type"))
                    <li class="nav-item">
                        <a href="{{route("all.type")}}" class="nav-link">All Type</a>
                    </li>
                    @endif
                    @if (Auth::user()->can("add.type"))
                    <li class="nav-item">
                        <a href="{{route("add.type")}}" class="nav-link">Add Type</a>
                    </li>
                    @endif
                </ul>
                </div>
            </li>
        @endif
        @if (Auth::user()->can("amenitie.menu"))
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false" aria-controls="amenities">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Amenities</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="amenities">
            <ul class="nav sub-menu">
                @if (Auth::user()->can("all.amenitie"))
                    <li class="nav-item">
                        <a href="{{route("all.amenities")}}" class="nav-link">All Amenities</a>
                    </li>
                @endif
                @if (Auth::user()->can("add.amenitie"))
                <li class="nav-item">
                    <a href="{{route("add.amenities")}}" class="nav-link">Add Amenities</a>
                </li>
                @endif
            </ul>
            </div>
        </li>
        @endif
        <li class="nav-item nav-category">Role & Permissions</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#roles" role="button" aria-expanded="false" aria-controls="roles">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Role & Permissions</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="roles">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{route("all.permission")}}" class="nav-link">All Permission</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route("all.roles")}}" class="nav-link">All Role</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route("add.roles.permission")}}" class="nav-link">Role in Permission</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route("all.roles.permission")}}" class="nav-link">All Role in Permission</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Admin Setup</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="false" aria-controls="admin">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Admin Setup</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="admin">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{route("all.admin")}}" class="nav-link">All Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route("add.admin")}}" class="nav-link">Add Admin</a>
                    </li>
                </ul>
            </div>
        </li>
        </ul>
    </div>
</nav>
