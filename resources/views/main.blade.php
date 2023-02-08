@extends('layout.master', ['title' => 'AppCenter2'])

@section('head')

    <style>
    </style>
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
<h1 class="m-0">Module List</h1>
@endsection

@section('content')

    <!-- content -->
    <div class="bg-white shadow-sm border px-2 px-lg-3 py-3 mb-3">
    
        <div class="row">

        @foreach($modules as $module)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h5>{{ $module->role_desc }}</h5>

                        <p>{{ $module->role_code }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-{{ $module->role_icon }}"></i>
                    </div>
                    <a href="{{ url($module->role_url) }}" class="small-box-footer">Open module <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endforeach
    
        </div>
    </div>
@endsection

