@extends('layout.master', ['title' => 'AppCenter2: FOC - Parts Registration'])

@section('head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  
  <!-- Jodit -->
  <link rel="stylesheet" href="{{ asset('plugins/jodit/jodit.min.css') }}">

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
      Form Kreatif Ide Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-12">
        <div class="form-group">
          <label for="kip_judul_tema">Judul Tema</label>
          <input type="text" class="form-control" name="kip_judul_tema" id="kip_judul_tema">
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_nama">Nama</label>
          <input type="text" class="form-control" name="disabled_nama" id="disabled_nama" value="{{ $user->user_name }}" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_npk">NPK</label>
          <input type="text" class="form-control" name="disabled_npk" id="disabled_npk" value="{{ $user->user_npk }}" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_dept">Dept</label>
          <input type="text" class="form-control" name="disabled_dept" id="disabled_dept" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_tanggal">Tanggal</label>
          <input type="text" class="form-control" name="disabled_tanggal" id="disabled_tanggal" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="kip_line">Line</label>
          <input type="text" class="form-control" name="kip_line" id="kip_line">
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="kip_proses">Proses</label>
          <input type="text" class="form-control" name="kip_proses" id="kip_proses">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="kip_kategori">Kategori</label>
          <select class="form-control select2bs4" name="kip_kategori" id="kip_kategori">
            <option value="Cost">Cost</option>
            <option value="Safety">Safety</option>
            <option value="5S">5S</option>
            <option value="Ergonomi">Ergonomi</option>
            <option value="Lingkungan">Lingkungan</option>
            <option value="Kualitas">Kualitas</option>
            <option value="Produktifitas">Produktifitas</option>
          </select>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="kip_masalah">Masalah dan Kondisi Saat Ini</label>
          <textarea class="form-control jodit" name="kip_masalah" id="kip_masalah"></textarea>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="kip_perbaikan">Aktifitas Perbaikan</label>
          <textarea class="form-control jodit" name="kip_perbaikan" id="kip_perbaikan"></textarea>
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
    $('.select2bs4').select2({
      placeholder: "Select",
      id: '-1', // the value of the option
      theme: 'bootstrap4'
    })
  });
</script>

<!-- Jodit-->
<script src="{{ asset('plugins/jodit/jodit.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.jodit').each(function () {
            var editor = new Jodit(this, {
            "spellcheck": false,
            "buttons": "undo,redo,|,bold,underline,italic,|,superscript,subscript,|,ul,ol,|,outdent,indent,align,fontsize,|,image,link,|",
        });
    });

    });
</script>
@endsection