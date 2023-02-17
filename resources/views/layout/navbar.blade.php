
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark bg-komatsu">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <img src="{{ url('img/topy_logo.png') }}" style="height: 33px;">
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
                <span class="d-inline">
                    <i class="fa fa-fw fa-user"></i>
                </span>
            </a>

            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                {{-- User menu footer --}}
                <li class="user-body">
                    {{ auth()->user()->user_npk.' - '.auth()->user()->user_name }}<br />
                    {{ auth()->user()->user_dept }} - {{ auth()->user()->user_line }}<br/><br/>
                    
                    <a class="btn btn-default btn-flat float-right btn-block" href="{{ route('logout') }}" >
                        <i class="fa fa-fw fa-key"></i>
                        Change Password
                    </a>
                </li>
                <li class="user-footer" style="max-width: 10p">
                    <a class="btn btn-default btn-flat float-right btn-block" href="{{ route('logout') }}" >
                        <i class="fa fa-fw fa-power-off"></i>
                        Log Out
                    </a>
                </li>

            </ul>

        </li>

    </ul>
  </nav>
  <!-- /.navbar -->