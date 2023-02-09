
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark bg-komatsu">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <img src="{{ url('img/topy_logo.png') }}" style="height: 28px;">
        </li>
        <li class="nav-item">
            @yield('module_title')
        </li>

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        <li class="nav-item dropdown user-menu">
            {{-- User menu toggler --}}
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline">
                    <i class="fa fa-fw fa-user"></i>
                </span>
            </a>

            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                {{-- User menu footer --}}
                <li class="user-body">
                    <small>{{ auth()->user()->user_email }}</small>
                    
                </li>
                <li class="user-footer" style="max-width: 10p">
                    <a class="btn btn-default btn-flat float-right btn-block" href="{{ route('logout') }}" >
                        <i class="fa fa-fw fa-power-off"></i>
                        Log Out
                    </a>
                </li>

            </ul>

        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->