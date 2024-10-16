@extends('index')
@section('content')
<h1 class='display-7 border-bottom pb-3 mb-5'>Profile</h1>
<div class="mb-3">
  <label for="email" class="form-label">Full Name</label>
  <input type="email" class="form-control" id="email" value="{{ $fullname[0]->name }}" readonly>
</div>
<div class="mb-3">
  <label for="username" class="form-label">Username</label>
  <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
</div>
<div class="mb-3">
  <label for="role" class="form-label">Role</label>
  <input type="text" class="form-control" id="role" value="{{ $role }}" readonly>
</div>
<div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
</div>
@endsection