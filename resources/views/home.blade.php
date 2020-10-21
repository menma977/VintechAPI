@extends('components.layout')

@section('content')
  <!--Mini Box-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div>

      <div class="col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{"Total Online User: $online"}}</h3>
            <p>Vintech&trade;</p>
          </div>
          <div class="icon">
            <i class="fas fa-globe"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Monthly Profit</h3>

      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$totalUser}}</h3>

            <p>User Total</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$totalTrade}}</h3>

            <p>Today Trading</p>
          </div>
          <div class="icon">
            <i class="fas fa-cocktail"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$totalWin}}</h3>

            <p>Total Win</p>
          </div>
          <div class="icon">
            <i class="fas fa-trophy"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$suspendUser}}</h3>

            <p>Suspend</p>
          </div>
          <div class="icon">
            <i class="fas fa-ban"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>

    const salesChartCanvas = document.getElementById('barChart').getContext('2d');

    const salesChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], //LABEL
      datasets: [
        {
          label: 'Online User',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: @json($graph)
        },
      ]
    };

    let salesChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    };

    // This will get the first returned node in the jQuery collection.
    let salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
      }
    );

  </script>
  <!-- ./col -->
@endsection
