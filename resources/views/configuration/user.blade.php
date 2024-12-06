@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add User</button>

<div class="modal" id="modalAdd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal">Add User</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('crudUser') }}">
                @csrf
                <div class="mb-3">
                    <input id='name_' class='form-control' type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="mb-3">
                    <input id='username_' class='form-control' type="text" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input id='email_' class='form-control' type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input id='password_' class='form-control' type="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input id='confirmpassword_' class='form-control' type="password" name="confirmpassword" placeholder="Password Confirm" required>
                </div>
                <button id="submit_" type="submit" class="btn btn-primary w-100">Save</button>
            </form>
        </div>
    </div>
</div>

<table id="menus-table" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getUser") }}')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('menus-tbody');
        tbody.innerHTML = '';
        let autoIncrementId = 1;
        data.forEach(menu => {
            const row = document.createElement('tr');
            const noCell = document.createElement('td');
            noCell.textContent += autoIncrementId;
            row.appendChild(noCell);
            autoIncrementId++;

            const nameCell = document.createElement('td');
            nameCell.textContent = menu.name;
            row.appendChild(nameCell);

            const usernameCell = document.createElement('td');
            usernameCell.textContent = menu.username;
            row.appendChild(usernameCell);

            const emailCell = document.createElement('td');
            emailCell.textContent = menu.email;
            row.appendChild(emailCell);

            const actionCell = document.createElement('td');
            if(menu.username != "administrator"){
                if (menu.is_active == 1) {
                    const url = `{{ route('statusUser', ['status' => 0, 'username' => '__username__']) }}`;
                    actionCell.innerHTML = `<a href="${url.replace('__username__', menu.username)}" class="btn btn-xs btn-danger">Disabled</a>`;
                } else {
                    const url = `{{ route('statusUser', ['status' => 1, 'username' => '__username__']) }}`;
                    actionCell.innerHTML = `<a href="${url.replace('__username__', menu.username)}" class="btn btn-xs btn-success">Enabled</a>`;
                }
            }
            row.appendChild(actionCell);

            tbody.appendChild(row);
        });
        $('#menus-table').DataTable();
    });
});
</script>
<script type="text/javascript">
    function modalAdd(){
        document.getElementById('name_').value='';
        document.getElementById('username_').value='';
        document.getElementById('email_').value='';

        const btnSubmit = document.getElementById("submit_");

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('modalAdd');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }
</script>
@endsection