@extends('layout.master', ['title' => 'Manage Ratio - Personal Site'])

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

<form method="post" id="formadd" action="{{ route('manageratio') }}" enctype="multipart/form-data">
@csrf

<div class="row">
  <div class="col-lg-4 col-md-6 col-12">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Manage Ratio
        </h3>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label for="ratio_spvdepthead" class="mb-1">Ratio SPV / Dept Head</label>
          <input type="text" class="form-control" name="ratio_spvdepthead" id="ratio_spvdepthead">
        </div>

        <div class="form-group">
          <label for="ratio_comitee" class="mb-1">Ratio Comitee</label>
          <input type="text" class="form-control" name="ratio_comitee" id="ratio_comitee">
        </div>

        <div class="form-group">
          <label for="user_passwordre" class="mb-1">Re-Enter Password</label>
          <input type="password" class="form-control" name="user_passwordre" id="user_passwordre">
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
        <p>Password akan diubah</p>
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
<script src="{{ asset('dist/js/changepass.js?v=').time() }}"></script>
@endsection