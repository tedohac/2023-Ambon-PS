
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      
    {{-- Sidebar brand logo --}}
    <a href="{{ route('main') }}" class="brand-link">

        {{-- Small brand logo --}}
        <img src="{{ asset('img/komtrax-square-white.png') }}"
            class="brand-image elevation-3'">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light">
            <b>App</b>Center
        </span>

    </a>

    {{-- Sidebar menu --}}
    <div class="sidebar">

        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu"
                    data-animation-speed="300"
                    data-accordion="true">
                
                {{-- Configured sidebar links --}}
                @yield('sidebar_menu')

                <li class="nav-header">{{ auth()->user()->user_email }}</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fa fa-fw fa-power-off"></i>
                        <p>Log Out</p>
                    </a>
                </li>

            </ul>
        </nav>
        
    </div>

    <!-- /.sidebar -->
  </aside>
