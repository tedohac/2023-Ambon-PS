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

<div class="card card-warning card-outline">
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
          <input type="text" class="form-control" name="disabled_dept" id="disabled_dept" disabled>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="disabled_tanggal" class="mb-1">Tanggal</label>
          <input type="text" class="form-control" name="disabled_tanggal" id="disabled_tanggal" disabled>
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

    </div>
    <!-- end of row -->

    <div class="row justify-content-md-center">

      <div class="col-lg-4 col-md-6 col-12">
        Ilustrasi Sebelum

        <div id="profilethumb1">
          <img src="{{ asset('img/photo.png') }}" class="bg-white border p-2 shadow">
        </div>
        <div class="input-group w-50">
          <div class="custom-file">
              <input type="file" class="custom-file-input" id="kip_foto_sebelum" name="kip_foto_sebelum" accept="image/*">
              <label class="custom-file-label" for="kip_foto_sebelum">Pilih file</label>
          </div>
        </div>

      </div>

      <div class="col-lg-4 col-md-6 col-12">
        Ilustrasi Sesudah

        <div id="profilethumb2">
          <img src="{{ asset('img/photo.png') }}" style="width: 100px;height: auto;max-height: 100px;">
        </div>
        <div class="input-group w-50">
          <div class="custom-file">
              <input type="file" class="custom-file-input" id="kip_foto_sesudah" name="kip_foto_sesudah" accept="image/*">
              <label class="custom-file-label" for="kip_foto_sesudah">Pilih file</label>
          </div>
        </div>

      </div>

    </div>
    <!-- end of row -->


  </div>
  <!-- end of card body -->
</div>
<!-- end of card -->

<button type="submit" class="btn btn-block btn-primary">Submit</button>
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


<!-- Preview Profile Pict -->
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $("#kip_foto_sebelum").change(function()
    {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            var fileName = this.value,
                idxDot = fileName.lastIndexOf(".") + 1,
                extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
          
            if (extFile!="jpg" && extFile!="jpeg" && extFile!="png")
            {
                $("#kip_foto_sebelum").addClass("is-invalid text-danger");
                return;
            }
            
            $("#profilethumb1").empty();
            reader.onload = function(e) {
                $("#profilethumb1").append('<img id="previewpict1" style="width: 100px;height: auto;max-height: 100px;");
                $('#previewpict1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });
    $("#kip_foto_sesudah").change(function()
    {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            var fileName = this.value,
                idxDot = fileName.lastIndexOf(".") + 1,
                extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
          
            if (extFile!="jpg" && extFile!="jpeg" && extFile!="png")
            {
                $("#kip_foto_sesudah").addClass("is-invalid text-danger");
                return;
            }
            
            $("#profilethumb2").empty();
            reader.onload = function(e) {
                $("#profilethumb2").append('<img id="previewpict2" style="width: 100px;height: auto;max-height: 100px;"');
                $('#previewpict2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });
</script>
@endsection