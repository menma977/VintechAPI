@extends('components.layout')

@section('content')
  <div class="card d-flex justify-content-center align-items-center m-4">
    <div class="card-header w-100">
      <h1 class="card-title">Application Version</h1>

      <form action="{{route("setting.update_version")}}" method="post" class="card-tools">
        @csrf
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-danger">Update Versi</button>
            </div>
            <input class="form-control" type="text" name="version" id="newver" value="{{$version}}" />
          </div>
      </form>

    </div>
    <div class="card-body row">
      <div class="d-flex align-items-stretch">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{"App Version $version"}}</h3>
            <p>Vintech&trade;</p>
          </div>
          <div class="icon">
            <i class="fas fa-mobile-alt"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
@endsection
