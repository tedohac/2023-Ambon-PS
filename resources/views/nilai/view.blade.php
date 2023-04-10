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
  View KIP as {{ strtoupper($role) }}: {{ $kip->kip_no }}
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item"><a href="{{ url('nilai/list').$role }}">List</a></li>
  <li class="breadcrumb-item active">View</li>
@endsection

@section('content')

<!-- Stepper Begin -->
<div class="bs-stepper">
  <div class="bs-stepper-header" role="tablist">

  @foreach($statuses as $status)
    @if($status->status_code=='depthead' && $totalNilai->spv < 35)
      @continue
    @endif

    @if($status->status_code=='revision' && $kip->kip_status!='revision')
      @continue
    @endif
    
    <div class="step {{ ($status->status_code==$kip->kip_status) ? 'active' : '' }}" data-target="#logins-part">
      <button type="button" class="step-trigger" disabled>
        <span class="bs-stepper-circle">{{ $status->status_order }}</span>
        <span class="bs-stepper-label">{{ $status->status_code }}</span>
      </button>
    </div>
    @if ($status->status_order < count($statuses))
    <div class="line"></div>
    @endif
  @endforeach
  </div>
</div>
<!-- Stepper End -->

<div class="alert alert-secondary">
    {{ $kip->status_desc }}
</div>

@if($kip->kip_status!="draft" && $kip->kip_status!="submit")
<div class="card">
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>Penilai</th>
          <th>Level</th>
          <th>Penghematan</th>
          <th>Quality</th>
          <th>Safety</th>
          <th>Ergonomi</th>
          <th>Manfaat</th>
          <th>Kepekaan</th>
          <th>Keaslian</th>
          <th>Usaha</th>
        </tr>
      </thead>
      <tbody>
        @foreach($nilais as $nilai)
        <tr>
          <td>{{ $nilai->user_name }}</td>
          <td>{{ $nilai->nilai_level }}</td>
          <td>{{ $nilai->nilai_penghematan }}</td>
          <td>{{ $nilai->nilai_quality }}</td>
          <td>{{ $nilai->nilai_safety }}</td>
          <td>{{ $nilai->nilai_ergonomi }}</td>
          <td>{{ $nilai->nilai_manfaat }}</td>
          <td>{{ $nilai->nilai_kepekaan }}</td>
          <td>{{ $nilai->nilai_keaslian }}</td>
          <td>{{ $nilai->nilai_usaha }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row justify-content-md-center mt-4 mx-0">
      <div class="col-lg-4 col-md-6 col-12">
        <table class="table table-bordered">
          <tr>
            <th class="text-center">Total SPV</th>
            @if($totalNilai->spv >= 35)
            <th class="text-center">Total Dept Head</th>
            @endif
            <th class="text-center">Total Comitee</th>
            <th class="text-center">Final</th>
          </tr>
          <tr>
            <td class="text-center">{{ $totalNilai->spv }}</td>
            @if($totalNilai->spv >= 35)
            <td class="text-center">{{ $totalNilai->depthead }}</td>
            @endif
            <td class="text-center">{{ $totalNilai->comitee }}</td>
            <td class="text-center">{{ $totalNilai->final }}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- end row -->

  </div>
</div>
<!-- Penilaian End -->
@endif

<form method="post" id="formnilai" action="{{ route('nilai.save') }}" enctype="multipart/form-data">
@csrf

@if($showForm)
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      Nilai KIP
    </h3>
  </div>
  <div class="card-body">
    <div class="row">
      <input type="hidden" name="nilai_kip_no" value="{{ $kip->kip_no }}">
      <input type="hidden" name="nilai_level" value="{{ $role }}">
      

      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_penghematan" class="mb-1">Penghematan</label>
          <input type="text" class="form-control nilai-input" name="nilai_penghematan" id="nilai_penghematan">
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_quality" class="mb-1">Quality</label>
          <input type="text" class="form-control nilai-input" name="nilai_quality" id="nilai_quality">
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_safety" class="mb-1">Safety</label>
          <input type="text" class="form-control nilai-input" name="nilai_safety" id="nilai_safety">
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_ergonomi" class="mb-1">Ergonomi</label>
          <input type="text" class="form-control nilai-input" name="nilai_ergonomi" id="nilai_ergonomi">
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_manfaat" class="mb-1">Manfaat</label>
          <input type="text" class="form-control nilai-input" name="nilai_manfaat" id="nilai_manfaat">
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_kepekaan" class="mb-1">Kepekaan</label>
          <input type="text" class="form-control nilai-input" name="nilai_kepekaan" id="nilai_kepekaan">
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_keaslian" class="mb-1">Keaslian</label>
          <input type="text" class="form-control nilai-input" name="nilai_keaslian" id="nilai_keaslian">
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="nilai_usaha" class="mb-1">Usaha</label>
          <input type="text" class="form-control nilai-input" name="nilai_usaha" id="nilai_usaha">
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_total" class="mb-1">Total</label>
          <input type="text" class="form-control" name="disabled_total" id="disabled_total" value="0" readonly>
        </div>
      </div>

      <div class="col-12 mb-2">
        
        @if($showRevisi)
        <button type="button" class="btn btn-danger mt-4" data-toggle="modal" data-target="#modal-revisi">
          <i class="fa fa-fw fa-backspace"></i>
          Revisi
        </button>
        @endif

        <button type="button" class="btn btn-secondary mt-4" data-toggle="modal" data-target="#modal-panduan">
          <i class="fa fa-fw fa-question"></i>
          Panduan
        </button>
          
        <button type="button" class="btn btn-primary mt-4" id="checkValid">
          <i class="fa fa-fw fa-paper-plane"></i>
          Beri Penilaian
        </button>
      </div>

    </div>
    <!-- end of row -->

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->
@endif

<div class="modal fade" id="modal-submit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <i class="fa fa-fw fa-paper-plane"></i>
          Konfirmasi
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Nilai akan diberikan dan dilanjutkan ke tahap berikutnya</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" value="submit">Submit</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-panduan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <i class="fa fa-fw fa-question"></i>
          Panduan
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('img/panduan.png') }}" width="100%" />
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@if($showRevisi)
<div class="modal fade" id="modal-revisi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <i class="fa fa-fw fa-backspace"></i>
          Revisi
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label for="kip_revision" class="mb-1">Alasan Revisi</label>
          <input type="text" class="form-control" name="kip_revision" id="kip_revision">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" value="revisi">Submit</button>
      </div>
    </div>
  </div>
</div>
@endif
</form>

<h2>Detail KIP</h2>
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
          {{ $kip->dept_name }}
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">Kategori</label><br />
        {{ $kip->kip_kategori }}
      </div>
      
      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="mb-1">Line</label><br />
        {{ $kip->line_name }} - {{ $kip->line_detail }}
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
      Biaya Perbaikan
    </h3>
  </div>
  <div class="card-body table-responsive table-bordered p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>Keterangan</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @foreach($biayas as $biaya)
        <tr>
          <td>{{ $biaya->biaya_desc }}</td>
          <td>{{ number_format($biaya->biaya_harga) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Benefit Kuantitatif
    </h3>
  </div>
  <div class="card-body table-responsive table-bordered p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>Keterangan</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @foreach($benefits as $benefit)
        <tr>
          <td>{{ $benefit->benefit_desc }}</td>
          <td>{{ number_format($benefit->benefit_harga) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

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

<!-- JS -->
<script src="{{ asset('dist/js/nilaiviewkip.js?v=').time() }}"></script>
@endsection