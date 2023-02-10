@extends('layout.master', ['title' => 'Manage Own KIP - Personal Site'])

@section('head')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
    Manage Own KIP
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item active">List</li>
@endsection

@section('content')

<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Data Kreatif Ide Perbaikan
    </h3>
    <a href="{{ url('kip/new') }}" class="btn btn-primary btn-sm float-right">
      <i class="fas fa-plus"></i>  
      Create New
    </a>
  </div>
  <div class="card-body">

    <table id="dataTable" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Tanggal Buat</th>
          <th>No KIP</th>
          <th>Judul KIP</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($kips as $kip)
        <tr>
          <td>{{ $kip->kip_created_on }}</td>
          <td>{{ $kip->kip_no }}</td>
          <td>{{ $kip->kip_judul_tema }}</td>
          <td>
            <span class="badge bg-{{ ($kip->kip_status=='draft' ? 'secondary' : 'info' }}">{{ $kip->kip_status }}</span>
          </td>
          <td>
              @if( $kip->kip_status=='draft' )
              <a class="btn btn-outline-info p-0 px-1 float-right broadcast-form" href="{{ route('kip.edit').'/'.$kip->kip_no }}">
                <i class="fa fa-fw fa-edit"></i>
              </a>
              @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

  </div>
</div>
@endsection

@section('bottom')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });
  });
</script>
@endsection