@extends('layout.master', ['title' => 'Personal Site'])

@section('head')

    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }

      table,
      th,
      td {
        border: 1px solid lightgray;
        font-family: sans-serif;
        padding: 7px 15px;
      }
    </style>
@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection

@section('content-title')
<h1 class="m-0">DASHBOARD Employee</h1>
@endsection

@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Draft Tersimpan</span>
            <span class="info-box-number">
            {{ $KIPCount[1]->jlh }}
              <!-- <small>%</small> -->
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Telah di Submit</span>
            <span class="info-box-number">{{ $KIPCount[2]->jlh }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Telah dinilai komite</span>
            <span class="info-box-number">{{ $KIPCount[5]->jlh }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Telah dinilai SPV</span>
            <span class="info-box-number">{{ $KIPCount[3]->jlh }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Telah dinilai MGR</span>
            <span class="info-box-number">{{ $KIPCount[4]->jlh }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
       <div class="col-12 col-sm-6 col-md-2">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Telah di revisi</span>
            <span class="info-box-number">{{ $KIPCount[0]->jlh }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="card">
      <div class="row justify-content-md-center mt-4 mx-0">
        <div class="col-lg-12 col-md-12 col-12">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th colspan="1" class="text-center"></th>
                <th class="text-center">JAN</th>
                <th class="text-center">FEB</th>
                <th class="text-center">MAR</th>
                <th class="text-center">APR</th>
                <th class="text-center">MEI</th>
                <th class="text-center">JUN</th>
                <th class="text-center">JUL</th>
                <th class="text-center">AGU</th>
                <th class="text-center">SEP</th>
                <th class="text-center">OKT</th>
                <th class="text-center">NOV</th>
                <th class="text-center">DES</th>
                <th class="text-center">TOTAL</th>
              </tr>
              <tr>
                <td class="text-center"><b>Telah dinilai SPV/MGR</b></td>
                @php($counter = 0)
                @foreach($KIPLevel as $kip)
                  <td class="text-center">{{ $kip->spvdepthead }}</td>
                  @php($counter+=$kip->spvdepthead)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>Telah dinilai komite</b></td>
                @php($counter = 0)
                @foreach($KIPLevel as $kip)
                  <td class="text-center">{{ $kip->comitee }}</td>
                  @php($counter+=$kip->comitee)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>Total</b></td>
                <td class="text-center">{{ $KIPLevel[0]->spvdepthead+$KIPLevel[0]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[1]->spvdepthead+$KIPLevel[1]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[2]->spvdepthead+$KIPLevel[2]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[3]->spvdepthead+$KIPLevel[3]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[4]->spvdepthead+$KIPLevel[4]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[5]->spvdepthead+$KIPLevel[5]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[6]->spvdepthead+$KIPLevel[6]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[7]->spvdepthead+$KIPLevel[7]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[8]->spvdepthead+$KIPLevel[8]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[9]->spvdepthead+$KIPLevel[9]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[10]->spvdepthead+$KIPLevel[10]->comitee }}</td>
                <td class="text-center">{{ $KIPLevel[11]->spvdepthead+$KIPLevel[11]->comitee }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="row justify-content-md-center mt-4 mx-0">
        <div class="col-lg-12 col-md-12 col-12">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th colspan="1" class="text-center"></th>
                <th class="text-center">JAN</th>
                <th class="text-center">FEB</th>
                <th class="text-center">MAR</th>
                <th class="text-center">APR</th>
                <th class="text-center">MEI</th>
                <th class="text-center">JUN</th>
                <th class="text-center">JUL</th>
                <th class="text-center">AGU</th>
                <th class="text-center">SEP</th>
                <th class="text-center">OKT</th>
                <th class="text-center">NOV</th>
                <th class="text-center">DES</th>
                <th class="text-center">TOTAL</th>
              </tr>
              <tr>
                <td class="text-center"><b>0-15</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->to15 }}</td>
                  @php($counter+=$kip->0to15)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>16-25</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->16to25 }}</td>
                  @php($counter+=$kip->16to25)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>26-35</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->26to35 }}</td>
                  @php($counter+=$kip->26to35)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>36-45</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->36to45 }}</td>
                  @php($counter+=$kip->36to45)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>46-55</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->46to55 }}</td>
                  @php($counter+=$kip->46to55)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>56-60</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->56to60 }}</td>
                  @php($counter+=$kip->56to0)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>61-70</b></td>
                @php($counter = 0)
                @foreach($KIPRange as $kip)
                  <td class="text-center">{{ $kip->61to70 }}</td>
                  @php($counter+=$kip->61to70)
                @endforeach
                <td class="text-center">{{ $counter }}</td>
              </tr>
              <tr>
                <td class="text-center"><b>Total</b></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">KIP</h3>
            <!-- <a href="javascript:void(0);">View Report</a> -->
          </div>
        </div>
        <div class="card-body">

          <div class="position-relative mb-4">
            <div id="container" height="200"></div>
          </div>

          <!-- <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> This year
            </span>

            <span>
              <i class="fas fa-square text-gray"></i> Last year
            </span>
          </div> -->
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->

  </div>
  <!-- /.card -->

   <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Nilai > 35</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Some Product
                    </td>
                    <td>$13 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>
                      12,000 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Nilai < 35</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Some Product
                    </td>
                    <td>$13 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>
                      12,000 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div><!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('bottom')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Perkembangan KIP Tahunan'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
        ],
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Total KIP'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      name: 'KIP',
      data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
        194.1, 95.6, 54.4]

    }]
  });

</script>
@endsection
