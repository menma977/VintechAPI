@extends('components.layout')

@section('content')
  <div class="card">
    <div class="card-header w-100">
      User Profile
    </div>
    <div class="card-body">
      <div class="card">
        <div class="m-1 p-4 row justify-content-center align-items-center">
          <div class="col-md-4 col-xs-12">
            <h4>Username</h4>
            <p>{{$user->username}}</p>
          </div>
          <div class="col-md-4 col-xs-12">
            <h4>Username Doge</h4>
            <p>{{$user->username_doge}}</p>
          </div>
          <div class="col-md-4 col-xs-12">
            <h4>Wallet Deposit</h4>
            <p>{{$user->wallet_deposit}}</p>
          </div>
          <div class="col-md-4 col-xs-12">
            <h4>Wallet Withdraw</h4>
            <p>{{$user->wallet_withdraw}}</p>
          </div>
          <div class="col-md-4 col-xs-12">
            <h4>Date Join</h4>
            <p>{{$user->created_at}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card col-12 col-md-6 col-xs-12">
            <div class="info-box">
              <span class="{{"info-box-icon ".($user->suspand?"bg-warning":"bg-info")." elevation-1"}}" ><i class="{{($user->suspand?"fas fa-lock":"fas fa-lock-open")}}"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Status</span>
                <span class="info-box-number">
                  {{$user->suspend?"Suspended":"Not Suspended"}}
                </span>
              </div>
            </div>
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1" ><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Win</span>
                <span class="info-box-number">
                  {{$totalWin}}
                </span>
              </div>
            </div>
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1" ><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Lose</span>
                <span class="info-box-number">
                  {{$totalLose}}
                </span>
              </div>
            </div>
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1" ><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Trade Count (Today)</span>
                <span class="info-box-number">
                  {{$totalTrade}}
                </span>
              </div>
            </div>
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1" ><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Trade Count (All Time)</span>
                <span class="info-box-number">
                  {{$totalTrade}}
                </span>
              </div>
            </div>
        </div>
        <div class="card col-12 col-md-6 col-xs-12">
          <div class="card-header">
            Trading History
          </div>
          <div class="card-body p-0">
            <div class="direct-chat-messages" style="min-height: 100vh">
            @foreach ($trades as $trade)
              <div class="direct-chat-msg">
                <div class="d-block mb-1 clearfix">
                  <span class="direct-chat-name float-left">{{$trade->status}}</span>
                  <span class="direct-chat-timestamp float-right">{{$trade->created_at}}</span>
                </div>
                <div class="px-1 py-2 {{$trade->status=='WIN'?"bg-success":"bg-warning"}} mb-1 rounded  text-right">
                  {{$trade->fund." Doge"}}
                </div>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
