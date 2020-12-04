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
  <h3 class="m-0 text-dark">List User Details</h3>
</div><!-- /.col -->

<table id="example2" class="table table-bordered table-hover">

  <tr>
    <th>Username</th>
    <th>Password</th>
    <th>History</th>
    <th>Deposit</th>
    <th>Withdraw</th>
    <th>Suspand</th>
  </tr>

  <tr>
    <td>999 Doge</td>
    <td>999 Doge
    </td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr>
    <td>999 Doge</td>
    <td>999 Doge
    </td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
</table>

@endsection
