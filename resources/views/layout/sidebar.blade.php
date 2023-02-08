@extends('layout.sidebar-raw')

@section('sidebar_menu')

        @foreach($modules as $module)
            <li class="nav-item">
                <a href="{{ url($module->role_url) }}" class="nav-link">
                    <i class="nav-icon fa fa-{{ $module->role_icon }}"></i>
                    <p>
                        {{ $module->role_desc }}
                    </p>
                </a>
            </li>
        @endforeach
@endsection