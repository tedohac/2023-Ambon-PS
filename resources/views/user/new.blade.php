@extends('layout.master', ['title' => 'Create New User - Personal Site'])

@section('head')
  <!-- duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
          <label for="user_deptline" class="mb-1">Line</label>          
          <select class="form-control select2bs4" name="user_deptline" id="user_deptline">>
            @foreach($deptlines as $deptline)
            <option value="{{ $deptline->line_id }}">{{ $deptline->line_dept }} - {{ $deptline->line_name }} - {{ $deptline->line_detail }}</option>
            @endforeach
          </select>
        </div>
      </div>
      
    </div>
    <!-- end of row -->

    <div class="row">

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_password" class="mb-1">Password</label>
          <input type="password" class="form-control" name="user_password" id="user_password" class="val-required">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="user_passwordre" class="mb-1">Re-Enter Password</label>
          <input type="password" class="form-control" name="user_passwordre" id="user_passwordre" class="val-required">
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
    <select class="duallistbox" multiple="multiple" name="user_permissions[]">
      @foreach($rolelines as $roleline)
      <option>{{ $roleline->roleline_id }}-{{ $roleline->role_code }}-{{ $roleline->line_dept }}-{{ $roleline->line_name }}-{{ $roleline->line_detail }}</option>
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

<div class="modal fade" id="modal-submit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>User baru akan terbentuk</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" value="submit">Submit</button>
      </div>
    </div>
  </div>
</div>

</form>
@endsection

@section('bottom')
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<!-- JS -->
<script src="{{ asset('dist/js/newuser.js?v=').time() }}"></script>
@endsection