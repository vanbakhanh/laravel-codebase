<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('/storage/avatars/default.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">OTCC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ trans('labels.general.dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ trans('labels.general.user') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.role.index') }}" class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>
                            {{ trans('labels.general.role') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permission.index') }}" class="nav-link {{ request()->routeIs('admin.permission.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            {{ trans('labels.general.permission') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>