@extends('layout.sidebar-raw')

@section('sidebar_menu')

        @php($roles = App\Permission::getByUser(auth()->user()->user_npk))
        @foreach($roles as $role)
            <li class="nav-item">
                <a href="{{ url($role->role_url) }}" class="nav-link">
                    <i class="nav-icon fa fa-{{ $role->role_icon }}"></i>
                    <p>
                        {{ $role->role_desc }}
                    </p>
                </a>
            </li>
        @endforeach
@endsection