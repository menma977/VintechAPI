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
        <th>Wallet Withdraw</th>
        <th>Wallet Deposit</th>
        <th>Detail</th>
      </tr>
      </thead>

      <template id="template-user-row">
        <tr>
          <td class="username"></td>
          <td class="doge-username"></td>
          <td class="wallet-withdraw"></td>
          <td class="wallet-deposit"></td>
          <td>
            <a class="detail btn btn-default" href="{{ route('admin.user.detail', '##username##') }}">
              Detail
            </a>
          </td>
        </tr>
      </template>
    </table>
  </div>

@endsection

@section('script')
  <script language="javascript">
    const table = document.querySelector("#user-table")
    const row = document.querySelector('#template-user-row').content.querySelector("tr");
    refreshTable(null);

    async function refreshTable(e) {
      if(e)
        e.preventDefault();
      const filter = document.getElementById('search-user').value;
      const response = await fetch("{{ route('admin.user.search', '##filter##') }}".replace("##filter##", filter), {
        method: 'GET',
        headers: {
          Accept: "application/json",
          "X-CSRF-TOKEN": $("input[name='_token']").val()
        }
      });
      if (response && response.ok) {
        const users = await response.json();
        const old_tbody = table.querySelector("tbody");
        const new_tbody = document.createElement('tbody');
        for (const user of users) {
          console.log(user)
          const newRow = row.cloneNode(true);
          newRow.querySelector(".username").innerText = user.username;
          newRow.querySelector(".doge-username").innerText = user.username_doge;
          newRow.querySelector(".wallet-withdraw").innerText = user.wallet_withdraw;
          newRow.querySelector(".wallet-deposit").innerText = user.wallet_deposit;
          newRow.querySelector(".detail").href = newRow.querySelector(".detail").href.replace("##username##", user.id)
          new_tbody.appendChild(newRow);
        }
        if(old_tbody)
          old_tbody.parentNode.replaceChild(new_tbody, old_tbody)
        else
          table.appendChild(new_tbody)
      }
    }
  </script>

@endsection
