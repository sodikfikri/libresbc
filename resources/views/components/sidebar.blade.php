@php
    $access = json_decode(session()->get('access-menu'));
    // dd($access);
    function get_data($menu, $arr, $type) {
        foreach ($arr as $key => $el) {
            if ( $menu == $el->name ) {
                if ($type == 1) { // return data
                    return $el;
                } else { // return key
                    return $key;
                }
            }
        }
        return false;
    }
@endphp

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

    {{-- @php
        // $mn = get_data('configuration', $access, 0);
        // dd(get_data('configuration', $access, 1)->sub_menu)
        // dd(empty(get_data('configuration', $access, 1)));
    @endphp --}}

    <!-- Nav Item - Dashboard -->
    @if (get_data('dashboard', $access, 1)->is_active == 1)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    @if (get_data('performance', $access, 1)->is_active == 1)
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Performance</span>
            </a>
        </li>
    @endif

    @if (get_data('configuration', $access, 1)->is_active == 1)
        <li class="nav-item">
            <a class="nav-link collapsed" id="menu-configuration" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Configuration</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SBC Config:</h6>

                    @if (get_data('configuration', $access, 1)->sub_menu[0]->is_active == 1)
                        <a class="collapse-item {{ request()->segment(1) == 'cluster' ? 'active' : '' }}" href="{{ route('cluster-list') }}">Cluster</a>
                    @endif

                    @if (get_data('configuration', $access, 1)->sub_menu[1]->is_active == 1)
                        <a class="collapse-item {{ request()->segment(1) == 'base' ? 'active' : '' }}" href="javascript:void(0)" id="sub-base" data-type="1">Base</a>
                            @if (get_data('configuration', $access, 1)->sub_menu[1]->child[0]->is_active == 1)
                                <a class="collapse-item child-sub-base {{ request()->segment(2) == 'natalias' ? 'active' : '' }}" 
                                    href="{{ route('base-natalias-list') }}" style="display: none; padding-left: 30px">Netalias</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[1]->child[1]->is_active == 1)
                                <a class="collapse-item child-sub-base {{ request()->segment(2) == 'firewall' ? 'active' : '' }}" 
                                    href="{{ route('base-firewall-list') }}" style="display: none; padding-left: 30px">Firewall</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[1]->child[2]->is_active == 1)
                                <a class="collapse-item child-sub-base {{ request()->segment(2) == 'acl' ? 'active' : '' }}" 
                                    href="{{ route('base-acl-list') }}" style="display: none; padding-left: 30px">ACL</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[1]->child[3]->is_active == 1)
                                <a class="collapse-item child-sub-base {{ request()->segment(2) == 'gateway' ? 'active' : '' }}" 
                                    href="{{ route('base-gateway-list') }}" style="display: none; padding-left: 30px">Gateway</a>
                            @endif
                    @endif

                    @if (get_data('configuration', $access, 1)->sub_menu[2]->is_active == 1)
                        <a class="collapse-item {{ request()->segment(1) == 'sipprofile' ? 'active' : '' }}" href="{{ route('sipprofile-list') }}">Sipprofile</a>
                    @endif

                    @if (get_data('configuration', $access, 1)->sub_menu[3]->is_active == 1)
                        <a class="collapse-item {{ request()->segment(1) == 'class' ? 'active' : '' }}" href="javascript:void(0)" id="sub-cls" data-type="1">Class</a>
                            @if (get_data('configuration', $access, 1)->sub_menu[3]->child[0]->is_active == 1)
                                <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'preanswer' ? 'active' : '' }}" 
                                    href="{{ route('preanswer-list') }}" style="display: none; padding-left: 30px">Pre Answer</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[3]->child[1]->is_active == 1)
                                <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'media' ? 'active' : '' }}" 
                                    href="{{ route('media-list') }}" style="display: none; padding-left: 30px">Media</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[3]->child[2]->is_active == 1)
                                <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'capacity' ? 'active' : '' }}" 
                                    href="{{ route('capacity-list') }}" style="display: none; padding-left: 30px">Capacity</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[3]->child[3]->is_active == 1)
                                <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'translation' ? 'active' : '' }}" 
                                    href="{{ route('translation-list') }}" style="display: none; padding-left: 30px">Translation</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[3]->child[4]->is_active == 1)
                                <a class="collapse-item child-sub-cls {{ request()->segment(2) == 'manipulation' ? 'active' : '' }}" 
                                    href="{{ route('manipulation-list') }}" style="display: none; padding-left: 30px">Manipulation</a>
                            @endif
                    @endif

                    @if (get_data('configuration', $access, 1)->sub_menu[4]->is_active == 1)
                        <a class="collapse-item {{ request()->segment(1) == 'inter-conncection' ? 'active' : '' }}" href="javascript:void(0)" id="sub-inter" data-type="1">Inter Connection</a>
                            @if (get_data('configuration', $access, 1)->sub_menu[4]->child[0]->is_active == 1)
                                <a class="collapse-item child-sub-inter {{ request()->segment(2) == 'in-bound' ? 'active' : '' }}" 
                                    href="{{ route('inboud-list') }}" style="display: none; padding-left: 30px">In Bound</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[4]->child[1]->is_active == 1)
                                <a class="collapse-item child-sub-inter {{ request()->segment(2) == 'out-bound' ? 'active' : '' }}" 
                                    href="{{ route('outboud-list') }}" style="display: none; padding-left: 30px">Out Bound</a>
                            @endif
                    @endif

                    @if (get_data('configuration', $access, 1)->sub_menu[5]->is_active == 1)
                        <a class="collapse-item {{ request()->segment(1) == 'routing' ? 'active' : '' }}" href="javascript:void(0)" id="sub-routing" data-type="1">Routing</a>
                            @if (get_data('configuration', $access, 1)->sub_menu[5]->child[0]->is_active == 1)
                                <a class="collapse-item child-sub-routing {{ request()->segment(2) == 'table' ? 'active' : '' }}" href="{{ route('table-list') }}" style="display: none; padding-left: 30px">Table</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[5]->child[1]->is_active == 1)
                                <a class="collapse-item child-sub-routing {{ request()->segment(2) == 'record' ? 'active' : '' }}" href="{{ route('record-list') }}" style="display: none; padding-left: 30px">Record</a>
                            @endif
                    @endif

                    @if (get_data('configuration', $access, 1)->sub_menu[6]->is_active == 1)
                        <a class="collapse-item" href="javascript:void(0)" id="sub-access" data-type="1">Access</a>
                            @if (get_data('configuration', $access, 1)->sub_menu[6]->child[0]->is_active == 1)
                                <a class="collapse-item child-sub-access" href="#" style="display: none; padding-left: 30px">Domain Policy</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[6]->child[1]->is_active == 1)
                                <a class="collapse-item child-sub-access" href="#" style="display: none; padding-left: 30px">Service</a>
                            @endif
                            @if (get_data('configuration', $access, 1)->sub_menu[6]->child[2]->is_active == 1)
                                <a class="collapse-item child-sub-access" href="#" style="display: none; padding-left: 30px">Directory/User</a>
                            @endif
                    @endif

                    @if (json_decode(session()->get('access-menu'))[2]->sub_menu[7]->is_active == 1)
                        <h6 class="collapse-header">Enum Config:</h6>
                        <a class="collapse-item {{ request()->segment(1) == "route" ? "active" : "" }}" href="{{ route('enum-route') }}" id="">Route List</a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    @if (get_data('user_management', $access, 1)->is_active == 1)
        <li class="nav-item {{ json_decode(session()->get('access-menu'))[3]->is_active == 0 ? 'display-0' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub-usr-manage"
                aria-expanded="true" aria-controls="sub-usr-manage">
                <i class="fas fa-fw fa-users"></i>
                <span>User Management</span>
            </a>
            <div id="sub-usr-manage" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if (json_decode(session()->get('access-menu'))[3]->sub_menu[0]->is_active == 1)
                        <a class="collapse-item" href="{{ route('user-manage-user-list') }}">User</a>
                    @endif
                    @if (json_decode(session()->get('access-menu'))[3]->sub_menu[1]->is_active == 1)
                        <a class="collapse-item" href="utilities-border.html">Role</a>
                    @endif
                </div>
            </div>
        </li>
    @endif
    
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>