@extends('components.layout')

@section('content')
  <div class="card-body m-3 d-flex flex-column">
    <div class="col-sm-6">
      <h3 class="m-0 text-dark">List User Details</h3>
    </div>

    <form role="form" class="align-self-end" onsubmit="refreshTable">
      <div class="form-group">
        <label for="search-user">Search: </label>
        <input type="text" id="search-user"/>
      </div>
    </form>
    <table id="user-table" class="table table-bordered table-hover">

      <thead>
      <tr>
        <th>Username</th>
        <th>Username Doge</th>
        <th>Password Doge</th>
        <th>Wallet Withdraw</th>
        <th>Wallet Deposit</th>
        <th>Detail</th>
      </tr>
      </thead>

      <tbody id="template-user-row">
      <tr>
        <td class="username"></td>
        <td class="doge-username"></td>
        <td class="doge-password"></td>
        <td class="wallet-withdraw"></td>
        <td class="wallet-deposit"></td>
        <td>
          <a class="detail btn btn-default" href="{{ route('admin.user.detail', '##username##') }}">
            Detail
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>

@endsection

@section('script')
  <script language="javascript">
    const table = document.querySelector("#user-table")
    const row = document.querySelector('#template-user-row').firstChild;

    function refreshTable(e) {
      e.preventDefault();
      const filter = document.getElementById('search-user').value;
      const respose = await fetch("{{ route('admin.user.search', '##filter##') }}".replace("##filter##", filter), {
        method: 'GET',
        headers: {
          Accept: "application/json",
          "X-CSRF-TOKEN": $("input[name='_token']").val()
        }
      });
      if (response.ok) {
        const users = await response.json();
        while (table.firstChild)
          table.removeChild(table.firstChild);
        for (const user of users) {
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
