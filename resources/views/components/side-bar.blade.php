<li class="nav-header">DashBoard</li>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ request()->is(['home', 'home/*']) ? 'active' : '' }}">
      <i class="fas fa-home"></i>
      <p>
        Home
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->is(['user', 'user/*']) ? 'active' : '' }}">
      <i class="fas fa-users"></i>
      <p>
        User List
        <!--span class="right badge badge-danger">new</span-->
      </p>
    </a>
  </li>
</ul>

<li class="nav-header">Setting</li>
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
