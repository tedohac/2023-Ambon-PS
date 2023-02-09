@extends('layout.master', ['title' => 'AppCenter2: FOC - Parts Registration'])

@section('head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <style>
    .select2-container--default .select2-selection--single {
      height: calc(2.25rem + 2px) !important;
    }
  </style>
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
  Create New KIP
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item"><a href="{{ url('kip/listown') }}">List</a></li>
  <li class="breadcrumb-item active">New</li>
@endsection

@section('content')

<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      KIP Form
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_stockpoint">Stock Point</label>
          <select class="form-control" name="letter_stockpoint" id="letter_stockpoint">
            <option>8200-JKT</option>
          </select>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_factory">Factory</label>
          <select class="form-control" name="letter_factory" id="letter_factory">
            <option>Koriyama</option>
          </select>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_engineer_pic">Engineer PIC</label>
          <input type="text" class="form-control" name="letter_engineer_pic" id="letter_engineer_pic">
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_model">Model</label>
          <select class="form-control select2" name="letter_model" id="letter_model" style="width: 100%;">
            <option>PC200</option>
            <option>PC210</option>
            <option>PC300</option>
            <option>PC400</option>
          </select>
        </div>
      </div>
    
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_shipment_by">Shipment By</label>
          <select class="form-control" name="letter_shipment_by" id="letter_shipment_by">
            <option>Sea</option>
            <option>Air</option>
            <option>Land</option>
          </select>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_currency">Currency</label>
          <select class="form-control select2" name="letter_currency" id="letter_currency" style="width: 100%;">
            <option>PC200</option>
            <option>PC210</option>
            <option>PC300</option>
            <option>PC400</option>
          </select>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="letter_reference">Reference</label>
          <input type="text" class="form-control" name="letter_reference" id="letter_reference">
        </div>
      </div>

    </div>
    <!-- end of row -->
  </div>
  <!-- end of card body -->
  <div class="card-footer">
    <button type="submit" class="btn btn-block btn-primary">Submit</button>
  </div>
</div>
<!-- end of card -->
@endsection

@section('bottom')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
@endsection