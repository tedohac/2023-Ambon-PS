@extends('layout.master', ['title' => 'Create New User - Personal Site'])

@section('head')
  <!-- duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
  Create New User
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item"><a href="{{ route('user.list') }}">List</a></li>
  <li class="breadcrumb-item active">New</li>
@endsection

@section('content')

<form method="post" id="formadd" action="{{ route('user.new') }}" enctype="multipart/form-data">
@csrf
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      User Form
    </h3>
  </div>
  <div class="card-body">

    <div class="row">

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_npk" class="mb-1">NPK</label>
          <input type="text" class="form-control" name="user_npk" id="user_npk">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_name" class="mb-1">Name</label>
          <input type="text" class="form-control" name="user_name" id="user_name">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_dept" class="mb-1">Departemen</label>
          <input type="text" class="form-control" name="user_dept" id="user_dept">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_line" class="mb-1">Line</label>
          <input type="text" class="form-control" name="user_line" id="user_line">
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_password" class="mb-1">Password</label>
          <input type="password" class="form-control" name="user_password" id="user_password">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_passwordre" class="mb-1">Re-Enter Password</label>
          <input type="password" class="form-control" name="user_passwordre" id="user_passwordre">
        </div>
      </div>
      
      <div class="col-12">
        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="user_status" name="user_status" checked>
            <label class="custom-control-label" for="user_status">Status User</label>
          </div>
        </div>
      </div>

    </div>
    <!-- end of row -->
  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      User Permission
    </h3>
  </div>
  <div class="card-body">

  <div class="form-group">
    <label>Assign Role ke User</label>
    <select class="duallistbox" multiple="multiple">
      @foreach($roles as $role)
      <option value="{{ $role->role_code }}">{{ $role->role_desc }}</option>
      @endforeach
    </select>
  </div>

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<button type="button" class="btn btn-block btn-primary mt-4" id="checkValid">
  <i class="fa fa-fw fa-save"></i>
  Save
</button>
</form>
@endsection

@section('bottom')
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

<!-- JS -->
<script src="{{ asset('dist/js/newuser.js?v=').time() }}"></script>
@endsection