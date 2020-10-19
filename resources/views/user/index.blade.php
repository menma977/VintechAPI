@extends('components.layout')

@section('sidebar')
<li class="nav-header">DashBoard</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="fas fa-globe-asia"></i>
      <p>
        Online Users
        <span class="right badge badge-danger">new</span>
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="fa fa-users" aria-hidden="true"></i>
      <p>
        Total Users
        <span class="right badge badge-danger">new</span>
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="far fa-chart-bar"></i>
      <p>
        Trading Users
        <span class="right badge badge-danger">new</span>
      </p>
    </a>
  </li>
</ul>

<li class="nav-header">User Details</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!--User Details-->
  <li class="nav-item">
    <a href="/resource/user/profile.blade.php" class="nav-link">
      <i class="fa fa-users" aria-hidden="true"></i>
      <p>
        Users
      </p>
    </a>
  </li>
  <!--/user details-->

  <!--history-->
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="fas fa-history" aria-hidden="true"></i>
      <p>
        History
      </p>
    </a>
  </li>
  <!--/history-->

  <!--withdraw-->
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="fa fa-credit-card" aria-hidden="true"></i>
      <p>
        Withdraw
      </p>
    </a>
  </li>

  <!--deposit-->
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="far fa-money-bill-alt"></i>
      <p>
        Deposit
      </p>
    </a>
  </li>


  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Suspand
      </p>
    </a>
  </li>
</ul>

<li class="nav-header">Option</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="/public/widgets.html" class="nav-link">
      <i class="fal fa-code-commit"></i>
      <p>
        Version
      </p>
    </a>
  </li>
</ul>

@endsection

@section('content')

<div class="col-sm-6">
  <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->

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

<!--Mini Box-->
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>

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
          <h3>999 Doge</h3>

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
          <h3>44</h3>

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
          <h3>1</h3>

          <p>Suspend</p>
        </div>
        <div class="icon">
          <i class="fas fa-ban"></i>
        </div>
      </div>
    </div>
    @endsection

    @section('script')

    <script>

  var salesChartCanvas = document.getElementById('barChart').getContext('2d');

  var salesChartData = {
    labels  : ['12PM','1PM','2PM',"3PM","4PM","5PM","6PM"], //LABEL
    datasets: [
      {
        label               : 'Online User',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90] // DATASET
      },
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, {
      type: 'line',
      data: salesChartData,
      options: salesChartOptions
    }
  )

    </script>
    <!-- ./col -->
    @endsection
