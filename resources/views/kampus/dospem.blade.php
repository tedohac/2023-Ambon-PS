@extends('layouts.front', ['Kelola Dosen Pembimbing - MagangHub'])

@section('head')
    
    <!-- SB Admin Template -->
    <link href="{{ asset('styles/sb-admin.css?v=').time() }}" rel="stylesheet">

    <!-- DataTable-->
    <link href="{{ url('datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Profile -->
    <link href="{{ asset('styles/profile.css?v=').time() }}" rel="stylesheet">

    <style>
        .font-20 {
            font-size: 20px;
        }
    </style>
@endsection

@section('banner-front')
<div class="row m-0 mt-5 panel">
    <div class="profile-thumb col-lg-3 col-md-4 pr-md-0 text-center">
        @if($univ->profile_pict == "")
        <i class="fas fa-university bg-white border p-2 shadow-sm" style="font-size: 130px"></i>
        @else
        <img src="{{ url('storage/univ/'.$univ->profile_pict) }}" class="bg-white border p-2 shadow-sm">
        @endif
    </div>
    <div class="profile-text col-lg-9 col-md-8 p-md-0 mb-2">
        <h3 class="m-0">{{ $univ->nama }}</h3>
        <small>Menunggu kelengkapan profil untuk verifikasi</small>
    </div>
</div>
@endsection


@section('content')
    <ol class="breadcrumb p-1 ml-auto">
        <li class="breadcrumb-item ml-auto"><a href="{{ route('/') }}">MagangHub</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kampus.list') }}">Cari Kampus</a></li>
        <li class="breadcrumb-item"><a href="{{ url('kampus/detail/'.$univ->id) }}">Detail Kampus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kelola Dosen Pembimbing</li>
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

    <div class="alert alert-info">
        Membuat data dosen pembimbing baru sekaligus mengirim akun ke e-mail mereka. Jika e-mail tidak terkirim, mohon klik kirim ulang e-mail verifikasi.
    </div>

    <!-- prodi list -->
    <h5 class="mb-2 p-0">
        Kelola Dosen Pembimbing
    </h5>
    <div class="bg-white shadow-sm border px-2 px-lg-3 py-3 mb-3">
        <table class="table table-sm table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="greybox">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>E-mail</th>
                    <th>Mahasiswa Dibimbing</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dospems as $dospem)
                <tr>
                    <td>{{ $dospem->nik }}</td>
                    <td>{{ $dospem->nama }}</td>
                    <td>{{ $dospem->prodi }}</td>
                    <td>{{ $dospem->email }}</td>
                    <td>{{ strtoupper($prodi->akreditasi) }}</td>
                    <td>13</td>
                    <td>13</td>
                    <td>
                        <a class="btn btn-outline-info px-1 py-0 edit-form" href="#" data-id="{{ $prodi->id }}">
                            <small>Edit</small>
                        </a>
                        <a class="btn btn-outline-danger px-1 py-0 hapus-form" href="#" data-id="{{ $prodi->id }}">
                            <small>Hapus</small>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- end prodi list -->
    
<form method="post" id="formadd" action="{{ route('prodi.save') }}">
@csrf
    <!-- add form -->
    <div class="card mb-3 p-1">
        <div class="card-header p-1" id="formHeader">
            
            <a class="btn btn-outline-primary p-1" data-toggle="collapse" href="#collapseSearchCon" role="button" aria-expanded="false" aria-controls="collapseSearchCon" id="addTogle">    
                <i class="fas fa-plus"></i>
                Tambah Program Studi
            </a>
        </div>
        <div class="card-body collapse p-1" id="collapseSearchCon">
            <input type="hidden" name="edit_id" id="idEdit">
            <table class="table table-sm" cellspacing="0">
                <tr>
                    <td valign="center" width="50" class="greybox"><b>Nama Program Studi</b></td>
                    <td>
                        <input id="namaProdi" class="form-control" placeholder="Nama Program Studi" name="prodi_nama" required="required" autofocus="autofocus" type="text"
                            data-parsley-required
                            data-parsley-required-message="Masukan nama Program Studi">
                        @error('prodi_nama')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td valign="center" width="50" class="greybox"><b>Fakultas</b></td>
                    <td>
                        <input id="fakultasProdi" class="form-control" placeholder="Fakultas" name="prodi_fakultas" autofocus="autofocus" type="text">
                        @error('prodi_fakultas')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td valign="center" width="50" class="greybox"><b>Jenjang</b></td>
                    <td>
                        <select id="jenjangProdi" class="form-control" name="prodi_jenjang" required="required" autofocus="autofocus" type="text"
                            data-parsley-required
                            data-parsley-required-message="Pilih jenjang">
                            <option value="" disabled selected>-- Pilih Jenjang --</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                        @error('prodi_jenjang')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>    
                        @enderror
                    </td>
                </tr>
            <tr>
                <td valign="center" width="50" class="greybox"><b>Akreditasi</b></td>
                <td>
                    <div class="stars">
                        <input class="star star-5" id="star-5" type="radio" name="prodi_akreditasi" value="a"/>
                        <label class="star star-5" for="star-5">A</label>
                        <input class="star star-4" id="star-4" type="radio" name="prodi_akreditasi" value="b"/>
                        <label class="star star-4" for="star-4">B</label>
                        <input class="star star-3" id="star-3" type="radio" name="prodi_akreditasi" value="c"/>
                        <label class="star star-3" for="star-3">C</label>
                        <input class="star star-2" id="star-2" type="radio" name="prodi_akreditasi" value="d"/>
                        <label class="star star-2" for="star-2">D</label>
                        <input class="star star-1" id="star-1" type="radio" name="prodi_akreditasi" value="e" checked/>
                        <label class="star star-1" for="star-1">E</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="center" width="50" class="greybox"></td>
                <td>
                    <input class="btn btn-success btn-block" value="Tambah Program Studi" id="btnsubmit" data-toggle="modal" data-target="#confirmModal">
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
</form>

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

        $('.edit-form').on('click', function(){
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
                    $('.modal-body').html('Apakah anda yakin untuk mengubah informasi Program Studi <br> ['+ result.id +'] '+result.nama+' ?');
                    $('#btnsubmit').val('Edit Program Studi');
                    $('#formadd').attr('action', '{{ route("prodi.update") }}');
                    $('#formHeader').append('<div class="alert alert-warning">Edit PRODI: '+result.nama+'</div>')
                    $(".collapse").collapse('show');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#addTogle").offset().top
                    }, 2000);

                    $('#idEdit').val(result.id);
                    $('#namaProdi').val(result.nama);
                    $('#fakultasProdi').val(result.fakultas);
                    $('#jenjangProdi').val(result.jenjang);
                    $("input[value='" + result.akreditasi + "']").prop('checked', true);
                },
                error:function() {
                    alert("Error!");
                }
            });
        });

        $('.hapus-form').on('click', function(){
            var id =  $(this).data('id');
            console.log(id);
            
            $.ajax({
                type: 'GET',
                url: '{{ url("prodi/detailjson") }}?id='+id,
                success: function(data)
                {
                    var result = JSON.parse(data);
                    // console.log(result);

                    $('#idEdit').val(id);
                    $('#formadd').attr('action', '{{ route("prodi.delete") }}');
                    $('.modal-body').html('Apakah anda yakin untuk menghapus Program Studi<br> ['+ result.id +'] '+result.nama+' ?');
                    $('#confirmModal').modal('show');
                },
                error:function() {
                    alert("Error!");
                }
            });
        });

        $('#formadd').parsley().on('form:validate', function (formInstance) {
            var success = formInstance.isValid();
            console.log(success);
            if (!success) {
                $('#confirmModal').modal('hide');
            }
        });
    });
</script>
@endsection