@extends('layouts.front', ['title' => $univ->nama.' - MagangHub'])

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
        <li class="breadcrumb-item active" aria-current="page">Detail Kampus</li>
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

    <!-- detail info -->
    <h5 class="mb-2 p-0">
        Profil Kampus
        
        @if(Auth::check() && Auth::user()->email == $univ->email)
        <a class="btn btn-outline-info p-1 float-right" href="{{ url('kampus/edit/') }}">
            <small><i class="fas fa-edit"></i> Edit Detail Kampus</small>
        </a>
        @endif
    </h5>
    <div class="bg-white shadow-sm border px-2 px-lg-3 py-3 mb-5">
        <table class="table" cellspacing="0">
            <tr>
                <td class="greybox" width="100"><b>Akreditasi</b></td>
                <td>
                    <span class="font-20 fa fa-star {{ $univ->akreditasi!='' && ord($univ->akreditasi)-96<6 ? 'text-warning' : '' }}"></span>
                    <span class="font-20 fa fa-star {{ $univ->akreditasi!='' && ord($univ->akreditasi)-96<5 ? 'text-warning' : '' }}"></span>
                    <span class="font-20 fa fa-star {{ $univ->akreditasi!='' && ord($univ->akreditasi)-96<4 ? 'text-warning' : '' }}"></span>
                    <span class="font-20 fa fa-star {{ $univ->akreditasi!='' && ord($univ->akreditasi)-96<3 ? 'text-warning' : '' }}"></span>
                    <span class="font-20 fa fa-star {{ $univ->akreditasi!='' && ord($univ->akreditasi)-96<2 ? 'text-warning' : '' }}"></span>
                    <span class="font-20">({{ strtoupper($univ->akreditasi) }})</span>
                </td>
            </tr>
            <tr>
                <td class="greybox"><b>NPSN</b></td>
                <td>
                    {{ $univ->npsn }}
                </td>
            </tr>
            <tr>
                <td class="greybox"><b>Tanggal Berdiri</b></td>
                <td>
                    {{ $univ->tgl_berdiri }}
                </td>
            </tr>
            <tr>
                <td class="greybox"><b>Telepon</b></td>
                <td>
                    {{ $univ->no_tlp }}
                </td>
            </tr>
            <tr>
                <td class="greybox"><b>Website</b></td>
                <td>
                    <a href="{{ $univ->website }}">{{ $univ->website }}</a>
                </td>
            </tr>
            <tr>
                <td class="greybox"><b>Alamat</b></td>
                <td>
                    {{ $univ->alamat }}
                </td>
            </tr>
            <tr>
                <td class="greybox"><b>Kota</b></td>
                <td>
                    {{ $univ->city_nama }}
                </td>
            </tr>
        </table>
    </div>

    <!-- prodi list -->
    <h5 class="mb-2 p-0">
        Program Studi
        
        @if(Auth::check() && Auth::user()->email == $univ->email)
        <a class="btn btn-outline-info p-1 float-right" href="#">
            <small><i class="fas fa-edit"></i> Kelola Program Studi</small>
        </a>
        @endif
    </h5>
    <div class="bg-white shadow-sm border px-2 px-lg-3 py-3 mb-5">
        <table class="table table-sm table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="greybox">
                <tr>
                    <th>Program Studi</th>
                    <th>Jenjang</th>
                    <th>Akreditasi</th>
                    <th><small>Pencari<br>Magang</small></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Manajemen Informatika</td>
                    <td>D3</td>
                    <td>A</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>Mesin Otomotif</td>
                    <td>D3</td>
                    <td>A</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>Pembuatan Peralatan dan Perkakas Produksi</td>
                    <td>D3</td>
                    <td>A</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>Teknik Produksi dan Proses Manufaktur</td>
                    <td>D3</td>
                    <td>A</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>Mekatronika</td>
                    <td>D3</td>
                    <td>A</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>Teknik Konstruksi Bangunan Gedung</td>
                    <td>D3</td>
                    <td>A</td>
                    <td>13</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('bottom')
<!-- DataTable-->
<script src="{{ url('datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('datatables/dataTables.bootstrap4.js') }}"></script>

<!-- SB-Admin-->
<script src="{{ url('js/sb-admin.min.js') }}"></script>

<script>
    $(document).ready(function (){
        var table = $('#dataTable').DataTable();
    });
</script>
@endsection