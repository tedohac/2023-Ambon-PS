@extends('layout.master', ['title' => 'Manage User - Personal Site'])

@section('head')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
    Manage User
@endsection

@section('content-breadcumb')
  <li class="breadcrumb-item active">List</li>
@endsection

@section('content')

<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      Data User
    </h3>
    <a href="{{ route('user.new') }}" class="btn btn-primary btn-sm float-right">
      <i class="fas fa-plus"></i>  
      Create New
    </a>
  </div>
  <div class="card-body">

    <table id="dataTable" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>NPK</th>
          <th>Nama</th>
          <th>Line</th>
          <th>Status</th>
          <th>Created On</th>
          <th>Updated On</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->user_npk }}</td>
          <td>{{ $user->user_name }}</td>
          <td>{{ $user->line_dept }} - {{ $user->line_name }} - {{ $user->line_detail }}</td>
          <td>
            <span class="badge bg-{{ ($user->user_status==1) ? 'primary' : 'secondary' }}">{{ ($user->user_status==1) ? 'Active' : 'Inactive' }}</span>
          </td>
          <td>{{ date('Y-m-d H:i', strtotime($user->created_at)) }}</td>
          <td>{{ date('Y-m-d H:i', strtotime($user->updated_at)) }}</td>
          <td>
            <a class="btn btn-outline-primary p-1 float-right broadcast-form" href="{{ route('user.edit', $user->user_npk) }}">
                <i class="fa fa-fw fa-edit"></i>
            </a>
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