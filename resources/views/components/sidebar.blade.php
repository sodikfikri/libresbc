<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SBC & ENUM</div>
        {{-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

   <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Performance</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" id="menu-configuration" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Configuration</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">SBC Config:</h6>
                <a class="collapse-item {{ request()->segment(1) == 'cluster' ? 'active' : '' }}" href="{{ route('cluster-list') }}">Cluster</a>

                <a class="collapse-item {{ request()->segment(1) == 'base' ? 'active' : '' }}" href="javascript:void(0)" id="sub-base" data-type="1">Base</a>
                    <a class="collapse-item child-sub-base {{ request()->segment(2) == 'natalias' ? 'active' : '' }}" 
                        href="{{ route('base-natalias-list') }}" style="display: none; padding-left: 30px">Netalias</a>
                    <a class="collapse-item child-sub-base {{ request()->segment(2) == 'firewall' ? 'active' : '' }}" 
                        href="{{ route('base-firewall-list') }}" style="display: none; padding-left: 30px">Firewall</a>
                    <a class="collapse-item child-sub-base {{ request()->segment(2) == 'acl' ? 'active' : '' }}" 
                        href="{{ route('base-acl-list') }}" style="display: none; padding-left: 30px">ACL</a>
                    <a class="collapse-item child-sub-base {{ request()->segment(2) == 'gateway' ? 'active' : '' }}" 
                        href="{{ route('base-gateway-list') }}" style="display: none; padding-left: 30px">Gateway</a>

                <a class="collapse-item {{ request()->segment(1) == 'sipprofile' ? 'active' : '' }}" href="{{ route('sipprofile-list') }}">Sipprofile</a>

                <a class="collapse-item {{ request()->segment(1) == 'class' ? 'active' : '' }}" href="javascript:void(0)" id="sub-cls" data-type="1">Class</a>
                    <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'preanswer' ? 'active' : '' }}" 
                        href="{{ route('preanswer-list') }}" style="display: none; padding-left: 30px">Pre Answer</a>
                    <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'media' ? 'active' : '' }}" 
                        href="{{ route('media-list') }}" style="display: none; padding-left: 30px">Media</a>
                    <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'capacity' ? 'active' : '' }}" 
                        href="{{ route('capacity-list') }}" style="display: none; padding-left: 30px">Capacity</a>
                    <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'translation' ? 'active' : '' }}" 
                        href="{{ route('translation-list') }}" style="display: none; padding-left: 30px">Translation</a>
                    <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'manipulation' ? 'active' : '' }}" 
                        href="{{ route('manipulation-list') }}" style="display: none; padding-left: 30px">Manipulation</a>

                <a class="collapse-item {{ request()->segment(1) == 'inter-conncection' ? 'active' : '' }}" href="javascript:void(0)" id="sub-inter" data-type="1">Inter Connection</a>
                    <a class="collapse-item child-sub-inter {{ request()->segment(2) == 'in-bound' ? 'active' : '' }}" 
                        href="{{ route('inboud-list') }}" style="display: none; padding-left: 30px">In Bound</a>
                    <a class="collapse-item child-sub-inter {{ request()->segment(2) == 'out-bound' ? 'active' : '' }}" 
                        href="{{ route('outboud-list') }}" style="display: none; padding-left: 30px">Out Bound</a>

                <a class="collapse-item" href="javascript:void(0)" id="sub-routing" data-type="1">Routing</a>
                    <a class="collapse-item child-sub-routing" href="#" style="display: none; padding-left: 30px">Table</a>
                    <a class="collapse-item child-sub-routing" href="#" style="display: none; padding-left: 30px">Record</a>

                <a class="collapse-item" href="javascript:void(0)" id="sub-access" data-type="1">Access</a>
                    <a class="collapse-item child-sub-access" href="#" style="display: none; padding-left: 30px">Domain Policy</a>
                    <a class="collapse-item child-sub-access" href="#" style="display: none; padding-left: 30px">Service</a>
                    <a class="collapse-item child-sub-access" href="#" style="display: none; padding-left: 30px">Directory/User</a>

                <h6 class="collapse-header">Enum Config:</h6>
                <a class="collapse-item {{ request()->segment(1) == "route" ? "active" : "" }}" href="{{ route('enum-route') }}" id="">Route List</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub-usr-manage"
            aria-expanded="true" aria-controls="sub-usr-manage">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span>
        </a>
        <div id="sub-usr-manage" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                <a class="collapse-item" href="utilities-color.html">User</a>
                <a class="collapse-item" href="utilities-border.html">Role</a>
            </div>
        </div>
    </li>
    
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>