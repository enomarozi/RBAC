@extends('index')
@section('content')
<select id='role_' class="form-select" aria-label="Default select example" name='role'>
    <option value="" selected disabled hidden>--- Pilih User ---</option>
    @foreach($users as $user)
        <option value="{{$user->username }}">{{ $user->username }}</option>
    @endforeach
</select>
@php
$data = array();
@endphp
@foreach($roles as $role)
    @foreach($permissions as $permission)
        @if($permission->role == $role->name)
            $print_role = array_push($data,$role->name)
        @endif
    @endforeach
@endforeach
@endsection