@extends('components.layout')

@section('content')
  <div class="card d-flex justify-content-center align-items-center m-4">
    <div class="card-header w-100">
      <h1 class="card-title">Online Users</h1>
    </div>
    <div class="card-body">
      <div class="d-flex align-items-stretch">
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
  </div>
@endsection

@section('script')
@endsection
