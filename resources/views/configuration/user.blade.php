@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add User</button>

<div class="modal" id="myModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('data_user') }}">
                @csrf
                <input id='id_' type="hidden" name="id" required>
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
                    <input id='confirmpassword_' class='form-control' type="email" name="confirmpassword_" placeholder="Password Confirm" required>
                </div>
                <button id="submit_" type="submit" name="action" class="btn btn-primary w-100"></button>
            </form>
        </div>
    </div>
</div>

<table id="menus-table" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>
<script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("userData") }}')
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

            const idCell = document.createElement('td');
            idCell.textContent = menu.id;   
            row.appendChild(idCell);

            const nameCell = document.createElement('td');
            nameCell.textContent = menu.name;
            row.appendChild(nameCell);

            const usernameCell = document.createElement('td');
            usernameCell.textContent = menu.username;
            row.appendChild(usernameCell);

            const emailCell = document.createElement('td');
            emailCell.textContent = menu.email;
            row.appendChild(emailCell);

            tbody.appendChild(row);
        });
        $('#menus-table').DataTable();
    });
});
</script>
<script type="text/javascript">
    function modalAdd(){
        document.getElementById('id_').value='';
        document.getElementById('name_').value='';
        document.getElementById('username_').value='';
        document.getElementById('email_').value='';

        const btnSubmit = document.getElementById("submit_");
        btnSubmit.textContent = "Save"
        btnSubmit.value = "SAVE"

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('myModal');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }
        
        const titleModal = document.getElementById("titleModal");
        titleModal.textContent = "Add Role"

        window.onclick = function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        }
        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }
</script>
@endsection