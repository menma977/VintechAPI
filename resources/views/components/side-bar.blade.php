<li class="nav-header">DashBoard</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="{{ route('home') }}" class="nav-link {{ request()->is(['level', 'level/*']) ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <p>
          Home
          <span class="right badge badge-danger">new</span>
        </p>
      </a>
    </li>
    <!--online-->
  <li class="nav-item">
    <a href="{{ route('online') }}" class="nav-link {{ request()->is(['online', 'online/*']) ? 'active' : '' }}">
      <i class="fas fa-globe-americas"></i>
      <p>
        Online Users
        <span class="right badge badge-danger">new</span>
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('admin.user') }}" class="nav-link {{ request()->is(['user', 'user/*']) ? 'active' : '' }}">
      <i class="fas fa-users"></i>
      <p>
        User List
        <span class="right badge badge-danger">new</span>
      </p>w
    </a>
  </li>
</ul>

<li class="nav-header">Setting</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!--User Details-->

<li class="nav-header">Option</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="{{ route('setting.version') }}" class="nav-link {{ request()->is(['setting/version', 'setting/version/*']) ? 'active' : '' }}">
      <i class="fas fa-cog"></i>
      <p>
        Version
      </p>
    </a>
  </li>
</ul>
