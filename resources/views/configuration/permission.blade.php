@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Permission</button>

<div class="modal" id="myModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('datapermission') }}">
            	@csrf
            	<input id='id_' type="hidden" name="id" required>
                <div class="mb-3">
                    <select id='role_' class="form-select" aria-label="Default select example" name='role'>
                        <option value="" selected disabled hidden>--- Pilih Role ---</option>
                        @foreach($roles as $role)
                            <option value="{{$role->name}}">{{ $role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input id='permission_' class='form-control' type="text" name="permission" placeholder="Permission" required>
                </div>
            	<div class="mb-3">
            		<input id='description_' class='form-control' type="text" name="description" placeholder="Description" required>
            	</div>
            	<button id="submit_" type="submit" name="action" class="btn btn-primary w-100"></button>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="myModalDel">
    <div class="modal-content">
        <span class="close" style="cursor: pointer;">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal">Delete Permission</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('datapermission') }}">
                @csrf
                <input type="hidden" id="iddel" name="id">
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
            <th>ID</th>
            <th>Role</th>
            <th>Permission</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>
<script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getDataPermission") }}')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('menus-tbody');
        tbody.innerHTML = '';
        let autoIncrementId = 1;
        data.forEach(menu => {
            const row = document.createElement('tr');
            const idCell = document.createElement('td');
            idCell.textContent = autoIncrementId;
            row.appendChild(idCell);
            autoIncrementId++;

            const roleCell = document.createElement('td');
            roleCell.textContent = menu.role;
            row.appendChild(roleCell);

            const permissionCell = document.createElement('td');
            permissionCell.textContent = menu.permission;
            row.appendChild(permissionCell);

            const subMenuCell = document.createElement('td');
            subMenuCell.textContent = menu.description;
            row.appendChild(subMenuCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <button onClick='modalEdit(${menu.id},"${menu.role}","${menu.permission}","${menu.description}")' class="btn btn-xs btn-success">Edit</button>
                <button onClick='modalDelete(${menu.id})' class="btn btn-xs btn-danger">Delete</button>
            `;
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
        document.getElementById('role_').value='';
        document.getElementById('permission_').value='';
        document.getElementById('description_').value='';

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
        titleModal.textContent = "Add Permission"

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalEdit(id,role,permission,description){
        document.getElementById('id_').value=id;
        document.getElementById('role_').value=role;
        document.getElementById('permission_').value=permission;
        document.getElementById('description_').value=description;

        const btnSubmit = document.getElementById("submit_");
        btnSubmit.textContent = "Update"
        btnSubmit.value = "UPDATE"

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('myModal');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }

        const titleModal = document.getElementById("titleModal");
        titleModal.textContent = "Edit Permission"            

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalDelete(id) {
        document.getElementById('iddel').value = id;
        const modal = document.getElementById('myModalDel');
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
