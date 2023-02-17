@extends('layout.master', ['title' => 'Edit User - Personal Site'])

@section('head')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
    Manage User
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item"><a href="{{ route('user.list') }}">List</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      Edit User {{ $user->user_npk }}
    </h3>
  </div>
  <div class="card-body">

    <div class="row">


    </div>
    <!-- end of row -->
  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->
@endsection

@section('bottom')

@endsection