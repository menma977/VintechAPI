<li class="nav-header">DashBoard</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="fas fa-globe-asia"></i>
      <p>
        Online Users
        <span class="right badge badge-danger">new</span>
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="fa fa-users" aria-hidden="true"></i>
      <p>
        Total Users
        <span class="right badge badge-danger">new</span>
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
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
   <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="fa fa-users" aria-hidden="true"></i>
      <p>
        Users
      </p>
    </a>
  </li>
  <!--/user details-->

  <!--history-->
  <li class="nav-item">
   <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="fas fa-history" aria-hidden="true"></i>
      <p>
        History
      </p>
    </a>
  </li>
  <!--/history-->

  <!--withdraw-->
  <li class="nav-item">
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="fa fa-credit-card" aria-hidden="true"></i>
      <p>
        Withdraw
      </p>
    </a>
  </li>

  <!--deposit-->
  <li class="nav-item">
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="far fa-money-bill-alt"></i>
      <p>
        Deposit
      </p>
    </a>
  </li>


  <li class="nav-item">
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
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
    <a href="{{ route('level.index') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
      <i class="fal fa-code-commit"></i>
      <p>
        Version
      </p>
    </a>
  </li>
</ul>
