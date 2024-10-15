@extends('index')
@section('content')
<h2 class="mb-4">Access Role</h2>
<form action="{{ route('roleAction') }}" method="POST">
    @csrf
    <div class="mb-3">
        <select id='username_' class="form-select" aria-label="Default select example" name='username'>
            <option value="" selected disabled hidden>--- Choose User ---</option>
            @foreach($users as $user)
                <option value="{{$user->username}}">{{ $user->username }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <select id='role_' class="form-select" aria-label="Default select example" name='role'>
            <option value="" selected disabled hidden>--- Choose Role ---</option>
            @foreach($roles as $role)
                <option value="{{$role->name}}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <input id='permission_' class='form-control' type="text" name="permission" placeholder="Permission" value="Create Read Update Delete" required readonly>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br><br><br>
<table id="menus-table" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Role</th>
            <th>Permission</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>
<script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getDataAccessRole") }}')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('menus-tbody');
        tbody.innerHTML = '';
        let autoIncrementId = 1;
        data.forEach(menu => {
            const row = document.createElement('tr');
            const idCell = document.createElement('td');
            idCell.textContent += autoIncrementId;
            row.appendChild(idCell);
            autoIncrementId++;

            const userCell = document.createElement('td');
            userCell.textContent = menu.user;
            row.appendChild(userCell);

            const roleCell = document.createElement('td');
            roleCell.textContent = menu.role;
            row.appendChild(roleCell);

            const permissionCell = document.createElement('td');
            permissionCell.textContent = menu.permission;
            row.appendChild(permissionCell);

            tbody.appendChild(row);
        });
        $('#menus-table').DataTable();
    });
});
</script>
@endsection