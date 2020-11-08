@extends('layouts.front', ['Kelola Dosen Pembimbing - MagangHub'])

@section('head')
    
    <!-- SB Admin Template -->
    <link href="{{ asset('styles/sb-admin.css?v=').time() }}" rel="stylesheet">

    <!-- DataTable-->
    <link href="{{ url('datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Profile -->
    <link href="{{ asset('styles/profile.css?v=').time() }}" rel="stylesheet">

    <!-- Auto complete -->
    <link href="{{ url('styles/select2.min.css') }}" rel="stylesheet" />
    
    <style>
        .font-20 {
            font-size: 20px;
        }
    </style>
@endsection

@section('banner-front')
<div class="row m-0 mt-5 panel">
    <div class="profile-thumb col-lg-3 col-md-4 pr-md-0 text-center text-dark">
        @if($univ->univ_profile_pict == "")
        <i class="fas fa-university bg-white border p-2 shadow-sm" style="font-size: 130px"></i>
        @else
        <img src="{{ url('storage/univ/'.$univ->univ_profile_pict) }}" class="bg-white border p-2 shadow-sm">
        @endif
    </div>
    <div class="profile-text col-lg-9 col-md-8 p-md-0 mb-2">
        <h3 class="m-0">{{ $univ->univ_nama }}</h3>
        <small>Menunggu kelengkapan profil untuk verifikasi</small>
    </div>
</div>
@endsection


@section('content')
    <ol class="breadcrumb p-1 ml-auto">
        <li class="breadcrumb-item ml-auto"><a href="{{ route('/') }}">MagangHub</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kampus.list') }}">Cari Kampus</a></li>
        <li class="breadcrumb-item"><a href="{{ url('kampus/detail/'.$univ->univ_id) }}">Detail Kampus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kelola DOSPEM</li>
    </ol>

    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <!-- dospem list -->
    <h5 class="mb-2 p-0">
        Kelola Dosen Pembimbing
    </h5>
    <div class="bg-white shadow-sm border px-2 px-lg-3 py-3 mb-3">
        <table class="table table-sm table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="greybox">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th>Mahasiswa</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dospems as $dospem)
                <tr>
                    <td>{{ $dospem->dospem_nik }}</td>
                    <td>{{ $dospem->dospem_nama }}</td>
                    <td>{{ $dospem->prodi_nama }}</td>
                    <td>{{ $dospem->dospem_user_email }}</td>
                    <td>
                        @if($dospem->user_status==1)
                            Butuh Verifikasi E-mail
                        @elseif($dospem->user_status==2)
                            Aktif
                        @endif
                    </td>
                    <td>13</td>
                    <td>
                        <a class="btn btn-outline-info px-1 py-0 edit-form" href="#" data-id="{{ $dospem->dospem_id }}">
                            <small>Edit</small>
                        </a>
                        <a class="btn btn-outline-danger px-1 py-0 hapus-form" href="#" data-id="{{ $dospem->dospem_id }}">
                            <small>Hapus</small>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- end dospem list -->
    
<form method="post" id="formadd" action="{{ route('dospem.save') }}">
@csrf
    <!-- add form -->
    <div class="card mb-3 p-1">
        <div class="card-header p-1" id="formHeader">
            
            <a class="btn btn-outline-primary p-1" data-toggle="collapse" href="#collapseSearchCon" role="button" aria-expanded="false" aria-controls="collapseSearchCon" id="addTogle">    
                <i class="fas fa-plus"></i>
                Tambah Dosen Pembimbing
            </a>

            <a class="btn btn-outline-success p-1 float-right" href="#">    
                <i class="fas fa-cloud-upload-alt"></i>
                Upload Data
            </a>
        </div>
        <div class="card-body collapse p-1" id="collapseSearchCon">
            <input type="hidden" name="edit_id" id="idEdit">
            <table class="table table-sm" cellspacing="0">
                <tr>
                    <td valign="center" width="50" class="greybox"><b>NIK Dosen</b></td>
                    <td>
                        <input id="nikDospem" class="form-control" placeholder="" name="dospem_nik" required="required" autofocus="autofocus" type="text" value="{{ old('dospem_nik') }}"
                            data-parsley-required
                            data-parsley-required-message="Masukan NIK Dosen Pembimbing">
                        @error('dospem_nik')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td valign="center" width="50" class="greybox"><b>Nama Dosen</b></td>
                    <td>
                        <input id="namaDospem" class="form-control" placeholder="" name="dospem_nama" required="required" autofocus="autofocus" type="text" value="{{ old('dospem_nama') }}"
                            data-parsley-required
                            data-parsley-required-message="Masukan nama Dosen Pembimbing">
                        @error('dospem_nama')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td valign="center" width="50" class="greybox"><b>Prodi</b></td>
                    <td>
                        <select class="form-control prodiDospem" required="required" name="dospem_prodi_id"
                            data-parsley-required
                            data-parsley-required-message="Pilih PRODI Dosen Pembimbing">
                        </select>
                        @error('dospem_prodi_id')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td valign="center" width="50" class="greybox"><b>E-Mail Dosen</b></td>
                    <td>
                        <input id="namaDospem" class="form-control" placeholder="" name="dospem_user_email" required="required" autofocus="autofocus" type="text" value="{{ old('dospem_user_email') }}"
                            data-parsley-required
                            data-parsley-type="email"
                            data-parsley-required-message="Masukan e-mail Dosen Pembimbing"
                            data-parsley-type-message="Format e-mail tidak valid">
                        @error('dospem_user_email')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td valign="center" width="50" class="greybox"></td>
                    <td>
                        <input type="button" class="btn btn-success btn-block" value="Tambah Program Studi" id="btnsubmit" data-toggle="modal" data-target="#confirmModal">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- end add form -->

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal">
        <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Apakah anda yakin untuk membuat Program Studi Baru?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>

            <input  type="submit" class="btn btn-primary" id="sendsubmit" value="Ya">
            </div>

        </div>
        </div>
    </div>
    <!-- End Confirm Modal -->
</form>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>

            <a class="btn btn-primary" id="submitDelete" href="#">Ya</a>
            </div>

        </div>
        </div>
    </div>
    <!-- End Delete Modal -->

@endsection

@section('bottom')
<!-- DataTable-->
<script src="{{ url('datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('datatables/dataTables.bootstrap4.js') }}"></script>

<!-- SB-Admin-->
<script src="{{ url('js/sb-admin.min.js') }}"></script>

<!-- Parsley Form Validation -->
<script src="{{ url('js/parsley.min.js') }}"></script>
<script>
    $("#formadd").parsley({
        errorClass: 'is-invalid text-danger',
        errorsWrapper: '<span class="form-text text-danger"></span>',
        errorTemplate: '<span></span>',
        trigger: 'change'
    })
</script>

<script>
    $(document).ready(function (){
        var table = $('#dataTable').DataTable();

        $('#dataTable').on('click', '.edit-form', function(){
            var id =  $(this).data('id');
            console.log(id);
            $.ajax({
                type: 'GET',
                url: '{{ url("prodi/detailjson") }}?id='+id,
                success: function(data)
                {
                    var result = JSON.parse(data);
                    // console.log(result);

                    $('#addTogle').html('<i class="fas fa-edit"></i> Edit Program Studi');
                    $('.modal-body').html('Apakah anda yakin untuk mengubah informasi Program Studi <br> ['+ result.prodi_id +'] '+result.prodi_nama+' ?');
                    $('#btnsubmit').val('Edit Program Studi');
                    $('#formadd').attr('action', '{{ route("prodi.update") }}');
                    $('#formHeader').append('<div class="alert alert-warning">Edit PRODI: '+result.prodi_nama+'</div>')
                    $("#collapseSearchCon").collapse('show');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#addTogle").offset().top
                    }, 2000);

                    $('#idEdit').val(result.prodi_id);
                    $('#namaProdi').val(result.prodi_nama);
                    $('#fakultasProdi').val(result.prodi_fakultas);
                    $('#jenjangProdi').val(result.prodi_jenjang);
                    $("input[value='" + result.prodi_akreditasi + "']").prop('checked', true);
                },
                error:function() {
                    alert("Error!");
                }
            });
        });

        $('#dataTable').on('click', '.hapus-form', function(){
            var id =  $(this).data('id');
            console.log(id);
            
            $.ajax({
                type: 'GET',
                url: '{{ url("prodi/detailjson") }}?id='+id,
                success: function(data)
                {
                    var result = JSON.parse(data);
                    // console.log(result);

                    $('#submitDelete').attr('href', '{{ route("prodi.delete") }}?id='+id);
                    $('.modal-body').html('Apakah anda yakin untuk menghapus Program Studi<br> ['+ result.prodi_id +'] '+result.prodi_nama+' ?');
                    $('#deleteModal').modal('show');
                },
                error:function() {
                    alert("Error!");
                }
            });
        });

        $('#formadd').parsley().on('form:validate', function (formInstance) {
            var success = formInstance.isValid();
            
            if (!success) {
                $('#confirmModal').modal('hide');
            }
        });
    });
</script>

<!-- Auto Complete-->
<script src="{{ url('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $('.prodiDospem').select2({
        width: '100%',
        placeholder: '-- Pilih Prodi --',
        ajax: {
            url: '{{ url('prodiautocom').'?univid='.$univ->univ_id }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
</script>
@endsection