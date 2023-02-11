@extends('layout.master', ['title' => 'View KIP - Personal Site'])

@section('head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  
  <!-- Jodit -->
  <link rel="stylesheet" href="{{ asset('plugins/jodit/jodit.min.css') }}">

  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">

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
  View Own KIP: {{ $kip->kip_no }}
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item"><a href="{{ url('kip/list') }}">List</a></li>
  <li class="breadcrumb-item active">View</li>
@endsection

@section('content')

<!-- Stepper Begin -->


<div class="bs-stepper">
  <div class="bs-stepper-header" role="tablist">

  @php ($num = 1)
  @foreach($statuses as $status)
    <div class="step {{ ($status->status_code==$kip->kip_status) 'active' : '' }}" data-target="#logins-part">
      <button type="button" class="step-trigger" disabled>
        <span class="bs-stepper-circle">{{ $num }}</span>
        <span class="bs-stepper-label">{{ $status->status_code }}</span>
      </button>
    </div>
    @if ($num < count($statuses))
    <div class="line"></div>
    @endif
    @php ($num++)
  @endforeach
  </div>
  
</div>
<!-- Stepper End -->

<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Rencana Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">
      <input type="hidden" name="kip_no" value="{{ $kip->kip_no }}">

      <div class="col-12 mb-3">
        <label class="mb-1">Judul Tema</label><br />
        {{ $kip->kip_judul_tema }}
      </div>
      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">Nama</label><br />
        {{ $kip->user_name }}
      </div>
      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">NPK</label><br />
        {{ $kip->user_npk }}
      </div>
      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
          <label class="mb-1">Dept</label><br />
          {{ $kip->user_dept }}
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">Kategori</label><br />
        {{ $kip->user_dept }}
      </div>
      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">Line</label><br />
        {{ $kip->kip_line }}
      </div>
      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
          <label class="mb-1">Proses</label><br />
          {{ $kip->kip_proses }}
      </div>

      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">Tanggal</label><br />
        {{ date('Y-m-d H:i', strtotime($kip->kip_created_on)) }}
      </div>

    </div>
    <!-- end of row -->
  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Laporan Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-12 mb-3">
        <label class="mb-1">Masalah dan Kondisi Saat Ini</label><br />
        {!! htmlspecialchars_decode($kip->kip_masalah) !!}
      </div>

      <div class="col-12 mb-3">
        <label class="mb-1">Aktifitas Perbaikan</label><br />
        {!! htmlspecialchars_decode($kip->kip_perbaikan) !!}
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label>Ilustrasi Perbaikan Sebelum</label><br />
        <img id="previewpict1" src="{{ ($kip->kip_foto_sebelum!='') ? url('storage/kip/'.$kip->kip_foto_sebelum) : asset('img/photo.png') }}" style="max-width: 100%" class="bg-white border p-1">

      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label>Ilustrasi Perbaikan Sesudah</label><br />
        <img id="previewpict2" src="{{ ($kip->kip_foto_sesudah!='') ? url('storage/kip/'.$kip->kip_foto_sesudah) : asset('img/photo.png') }}" style="max-width: 100%;" class="bg-white border p-1">
       
      </div>

    </div>
    <!-- end of row -->

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->


<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Evaluasi Hasil Perbaikan
    </h3>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-12 mb-3">
        <label class="mb-1">Uraian Data</label><br />
        {!! htmlspecialchars_decode($kip->kip_eval_uraian) !!}
      </div>

      <div class="col-12 mb-3">
        <label class="mb-1">Biaya Perbaikan</label><br />
        {!! htmlspecialchars_decode($kip->kip_eval_biaya) !!}
      </div>

      <div class="col-12 mb-3">
        <label class="mb-1">Benefit Kuantitatif</label><br />
        {!! htmlspecialchars_decode($kip->kip_eval_benefit_kuantitatif) !!}
      </div>

      <div class="col-12 mb-3">
        <label class="mb-1">Benefit Kualitatif</label><br />
        {!! htmlspecialchars_decode($kip->kip_eval_benefit_kualitatif) !!}
      </div>

    </div>
    <!-- end of row -->

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->


<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Tindak Lanjut atau Standarisasi
    </h3>
  </div>
  <div class="card-body">
    <div class="row">
      
      <div class="col-12 mb-3">
        <label class="mb-1">Pengontrolan Selanjutnya</label><br />
        {!! htmlspecialchars_decode($kip->kip_pengontrolan) !!}
      </div>

    </div>
    <!-- end of row -->

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

@endsection

@section('bottom')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Jodit-->
<script src="{{ asset('plugins/jodit/jodit.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- BS Stepper -->
<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

<!-- JS -->
<script src="{{ asset('dist/js/viewkip.js?v=').time() }}"></script>
@endsection