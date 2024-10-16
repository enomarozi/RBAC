@extends('index')
@section('content')
<div class="row">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-bg-success h4">Total User</h5>
        <p class="card-text text-success h6"> {{ $user }} User</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-bg-warning h4">Total Role</h5>
        <p class="card-text text-warning h6"> {{ $role }} Role</p>
      </div>
    </div>
  </div>
</div>
@endsection