<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="icon" href="{{ asset('assets/images/unand-sm.png') }}" type="image/x-icon">
	<title>Login</title>
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
        <form action="{{ route('loginAction') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
        <div class="container d-flex justify-content-center align-items-center">
            @if (session('success'))
                <div class="text-success small mt-2 text-center w-100">
                    {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->has('error'))
                <div class="text-danger small mt-2 text-center w-100">
                    {{ $errors->first('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>