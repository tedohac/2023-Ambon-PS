@extends('layout.master', ['title' => 'Create New KIP - Personal Site'])

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
  Form Kreatif Ide Perbaikan
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item"><a href="{{ url('kip/listown') }}">List</a></li>
  <li class="breadcrumb-item active">New</li>
@endsection

@section('content')

<form method="post" id="formadd" action="{{ route('kip.new') }}" enctype="multipart/form-data">
@csrf
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      Rencana Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-12">
        <div class="form-group">
          <label for="kip_judul_tema" class="mb-1">Judul Tema</label>
          <input type="text" class="form-control" name="kip_judul_tema" id="kip_judul_tema">
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_nama" class="mb-1">Nama</label>
          <input type="text" class="form-control" name="disabled_nama" id="disabled_nama" value="{{ $user->user_name }}" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_npk" class="mb-1">NPK</label>
          <input type="text" class="form-control" name="disabled_npk" id="disabled_npk" value="{{ $user->user_npk }}" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_dept" class="mb-1">Dept</label>
          <input type="text" class="form-control" name="disabled_dept" id="disabled_dept" value="{{ $user->user_dept }}" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="kip_kategori" class="mb-1">Kategori</label>
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
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="kip_line" class="mb-1">Line</label>
          <input type="text" class="form-control" name="kip_line" id="kip_line">
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="kip_proses" class="mb-1">Proses</label>
          <input type="text" class="form-control" name="kip_proses" id="kip_proses">
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_tanggal" class="mb-1">Tanggal</label>
          <input type="text" class="form-control" name="disabled_tanggal" id="disabled_tanggal" value="{{ date('Y-m-d') }}" disabled>
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
      Laporan Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-12">
        <div class="form-group">
          <label for="kip_masalah" class="mb-1">Masalah dan Kondisi Saat Ini</label>
          <textarea class="form-control jodit" name="kip_masalah" id="kip_masalah"></textarea>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="kip_perbaikan" class="mb-1">Aktifitas Perbaikan</label>
          <textarea class="form-control jodit" name="kip_perbaikan" id="kip_perbaikan"></textarea>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <label>Ilustrasi Perbaikan Sebelum</label>
        <div class="input-group mb-2">
          <div class="custom-file">
              <input type="file" class="custom-file-input" id="kip_foto_sebelum" name="kip_foto_sebelum" accept="image/*">
              <label class="custom-file-label" for="kip_foto_sebelum">Pilih file</label>
          </div>
        </div>
        <img id="previewpict1" src="{{ asset('img/photo.png') }}" style="max-width: 100%" class="bg-white border p-1">

      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <label>Ilustrasi Perbaikan Sesudah</label>
        <div class="input-group mb-2">
          <div class="custom-file">
              <input type="file" class="custom-file-input" id="kip_foto_sesudah" name="kip_foto_sesudah" accept="image/*">
              <label class="custom-file-label" for="kip_foto_sesudah">Pilih file</label>
          </div>
        </div>
        <img id="previewpict2" src="{{ asset('img/photo.png') }}" style="max-width: 100%;" class="bg-white border p-1">
       
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
      Evaluasi Hasil Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-12">
        <div class="form-group">
          <label for="kip_eval_uraian" class="mb-1">Uraian Data</label>
          <textarea class="form-control jodit" name="kip_eval_uraian" id="kip_eval_uraian"></textarea>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="kip_eval_benefit_kuantitatif" class="mb-1">Benefit Kuantitatif</label>
          <textarea class="form-control jodit" name="kip_eval_benefit_kuantitatif" id="kip_eval_benefit_kuantitatif"></textarea>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="kip_eval_benefit_kualitatif" class="mb-1">Benefit Kualitatif</label>
          <textarea class="form-control jodit" name="kip_eval_benefit_kualitatif" id="kip_eval_benefit_kualitatif"></textarea>
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
      Biaya Perbaikan
    </h3>
  </div>
  <div class="card-body table-responsive p-0">

    <table class="table order-list table-hover text-nowrap" id="tableBiaya">
      <thead>
        <tr>
          <th>Desc</th>
          <th>Harga</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" name="biaya_desc0" class="form-control val-biaya-desc"/></td>
          <td><input type="text" name="biaya_harga0" class="form-control val-biaya-harga"/></td>
          <td><a class="deleteRow"></a></td>
        </tr>
      </tbody>
      <tfoot>
          <tr>
              <td colspan="2">
                  <input type="button" class="btn btn-block" id="biayaAddrow" value="Add Row" />
              </td>
              <td></td>
          </tr>
      </tfoot>
    </table>

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      Tindak Lanjut atau Standarisasi
    </h3>
  </div>
  <div class="card-body">
    <div class="row">
      
      <div class="col-12">
        <div class="form-group">
          <label for="kip_pengontrolan" class="mb-1">Pengontrolan Selanjutnya</label>
          <textarea class="form-control jodit" name="kip_pengontrolan" id="kip_pengontrolan"></textarea>
        </div>
      </div>

    </div>
    <!-- end of row -->

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<div class="row">
      <div class="col-md-6 col-12 mb-2">
        <button type="submit" class="btn btn-block btn-secondary" value="draft">
          <i class="fa fa-fw fa-pencil-ruler"></i>
          Save as Draft
        </button>
      </div>
      <div class="col-md-6 col-12 mb-2">
        <button type="button" class="btn btn-block btn-primary" id="checkValid">
          <i class="fa fa-fw fa-paper-plane"></i>
          Save and Submit
        </button>
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
        <p>KIP akan disubmit untuk penilaian</p>
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
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Jodit-->
<script src="{{ asset('plugins/jodit/jodit.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

<!-- JS -->
<script src="{{ asset('dist/js/newkip.js?v=').time() }}"></script>
@endsection