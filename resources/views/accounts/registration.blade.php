<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="icon" href="{{ asset('assets/images/unand-sm.png') }}" type="image/x-icon">
	<title>Registration</title>
</head>
<style type="text/css">
	form{
		margin-top: 20px;
	}
</style>
<body>
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card col-md-3 p-3 shadow">
        <img src="{{ asset('assets/images/unand.png')}}"> 
        <form action="{{ route('registrationAction') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirmpassword" class="form-control" placeholder="Password Confirm" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Registration</button>
        </form>
        @if ($errors->any())
            <div class="text-danger small mt-2 text-center w-100">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
    
</div>
</body>
</html>