@extends('index')
@section('content')
<h1 class='display-7 border-bottom pb-3 mb-5'>Setting</h1>
<form action="{{ route('passwordAction') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="password" name="oldpassword" class="form-control" placeholder="Old Password" required>
    </div>
    <div class="mb-3">
        <input type="password" name="newpassword" class="form-control" placeholder="New Password" required>
    </div>
    <div class="mb-3">
        <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection