@extends('layout.master', ['title' => 'Change Password - Personal Site'])

@section('head')
  <!-- duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
@endsection

@section('content-breadcumb')
@endsection

@section('content')

<form method="post" id="formadd" action="{{ route('user.new') }}" enctype="multipart/form-data">
@csrf

<div class="row">
  <div class="col-lg-4 col-md-6 col-12">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Change Password
        </h3>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label for="current_password" class="mb-1">Current Password</label>
          <input type="password" class="form-control" name="current_password" id="current_password" class="val-required">
        </div>

        <div class="form-group">
          <label for="user_password" class="mb-1">New Password</label>
          <input type="password" class="form-control" name="user_password" id="user_password" class="val-required">
        </div>

        <div class="form-group">
          <label for="user_passwordre" class="mb-1">Re-Enter Password</label>
          <input type="password" class="form-control" name="user_passwordre" id="user_passwordre" class="val-required">
        </div>
        
        <button type="button" class="btn btn-block btn-primary mt-4" id="checkValid">
          <i class="fa fa-fw fa-save"></i>
          Save
        </button>

      </div>
      <!-- end of card body -->
    </div>
    <!-- end of card -->

  </div>
</div>
<!-- end of row -->

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

<!-- JS -->
<script src="{{ asset('dist/js/newuser.js?v=').time() }}"></script>
@endsection