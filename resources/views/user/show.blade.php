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
</div>

<table id="user-table" class="table table-bordered table-hover">

  <tr>
    <th>Username</th>
    <th>Username Doge</th>
    <th>Password Doge</th>
    <th>Wallet Withdraw</th>
    <th>Wallet Deposit</th>
    <th>Detail</th>
  </tr>

  <template id="template-user-row">
    <tr>
      <td class="username"></td>
      <td class="doge-username"></td>
      <td class="doge-password"></td>
      <td class="wallet-withdraw"></td>
      <td class="wallet-deposit"></td>
        <a class="detail btn btn-default" href="{{ route('admin.user.profile', '##username##') }}">
          Detail
        </a>
      </td>
    </tr>
  <template>
</table>

<script>
  const table = document.querySelector("#user-table")
  const row = document.querySelector('#template-user-row').firstChild;

  async function refreshTable(filter) {
    const respose =  await fetch("{{ route('search', '##filter##') }}".replace("##filter##",filter),{
      method: 'GET',
      headers: {
        Accept: "application/json",
        "X-CSRF-TOKEN": $("input[name='_token']").val()
      }
    });
    if(response.ok){
      const users = await response.json();
      while(table.firstChild)
        table.removeChild(table.firstChild);
      for(const user of users){
        const newRow = row.cloneNode(true);
        newRow.querySelector(".username") = user.username;
        newRow.querySelector(".doge-username") = user.username_doge;
        newRow.querySelector(".doge-password") = user.password_doge;
        newRow.querySelector(".wallet-withdraw") = user.wallet_withdraw;
        newRow.querySelector(".wallet-deposit") = user.wallet_deposit;
        newRow.querySelector(".detail").href = newRow.querySelector(".detail").href.replace("##username##", user.username)
        table.appendChild(newRow);
      }
    }
  }
</script>

@endsection
