@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Access Role</button>

<div class="modal" id="modalAdd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('crudAccessRole') }}">
                @csrf
                <input id='id_' type="hidden" name="id" required>
                <div class="mb-3">
                    <select id='username_' class="form-select" aria-label="Default select example" name='username'>
                        <option value="" selected disabled hidden>--- Choose User ---</option>
                        @foreach($users as $user)
                            @if($user->username !== "administrator")
                                <option value="{{ $user->username }}">{{ $user->username }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select id='role_' class="form-select" aria-label="Default select example" name='role'>
                        <option value="" selected disabled hidden>--- Choose Role ---</option>
                        @foreach($roles as $role)
                            @if($role->name !== "administrator")
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input id='permission_' class='form-control' type="text" name="permission" placeholder="Permission" value="Create Read Update Delete" required readonly>
                </div>
                <button id="submit_" type="submit" name="action" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modalDel">
    <div class="modal-content">
        <span class="close" style="cursor: pointer;">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal">Delete Access Role</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('crudAccessRole') }}">
                @csrf
                <input type="hidden" id="idDel" name="id">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary w-50" id="cancelButton">Cancel</button>
                    <button id="submit_" type="submit" name="action" value="DELETE" class="btn btn-danger w-50">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<table id="menus-table" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Role</th>
            <th>Permission</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getAccessRole") }}')
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

            const userCell = document.createElement('td');
            userCell.textContent = menu.user;
            row.appendChild(userCell);

            const roleCell = document.createElement('td');
            roleCell.textContent = menu.role;
            row.appendChild(roleCell);

            const permissionCell = document.createElement('td');
            permissionCell.textContent = menu.permission;
            row.appendChild(permissionCell);

            const actionCell = document.createElement('td');
            if(menu.user != "administrator" && menu.role != "administrator"){
                actionCell.innerHTML = `
                    <button onClick='modalEdit(${menu.id},"${menu.user}", "${menu.role}")' class="btn btn-xs btn-success">Edit</button>
                    <button onClick='modalDelete(${menu.id})' class="btn btn-xs btn-danger">Delete</button>
                `;
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
        document.getElementById('id_').value='';
        document.getElementById('username_').value='';
        document.getElementById('role_').value='';

        const btnSubmit = document.getElementById("submit_");
        btnSubmit.textContent = "Save"
        btnSubmit.value = "SAVE"

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('modalAdd');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }
        
        const titleModal = document.getElementById("titleModal");
        titleModal.textContent = "Add Access Role"

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalEdit(id,username,role){
        document.getElementById('id_').value=id;
        document.getElementById('username_').value=username;
        document.getElementById('role_').value=role;

        const btnSubmit = document.getElementById("submit_");
        btnSubmit.textContent = "Update"
        btnSubmit.value = "UPDATE"

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('modalAdd');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }

        const titleModal = document.getElementById("titleModal");
        titleModal.textContent = "Edit Access Role"            

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }
    function modalDelete(id) {
        document.getElementById('idDel').value = id;
        const modal = document.getElementById('modalDel');
        modal.style.display = "block";

        const span = document.getElementsByClassName("close")[1];
        span.onclick = function() {
            modal.style.display = "none";
        }

        const cancelButton = document.getElementById('cancelButton');
        cancelButton.onclick = function() {
            modal.style.display = "none";
        }
    }
</script>
@endsection