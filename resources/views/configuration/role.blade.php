@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Role</button>

<div class="modal" id="modalAdd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('crudRole') }}">
            	@csrf
            	<input id='id_' type="hidden" name="id" required>
            	<div class="mb-3">
            		<input id='name_' class='form-control' type="text" name="name" placeholder="Role Name" required>
            	</div>
                <div class="mb-3 d-flex justify-content-between">
                    <label class="mr-2">
                        <input type="checkbox" name="permissions[]" value="CREATE"> CREATE
                    </label>
                    <label class="mr-2">
                        <input type="checkbox" name="permissions[]" value="READ"> READ
                    </label>
                    <label class="mr-2">
                        <input type="checkbox" name="permissions[]" value="UPDATE"> UPDATE
                    </label>
                    <label class="mr-2">
                        <input type="checkbox" name="permissions[]" value="DELETE"> DELETE
                    </label>
                </div>
            	<div class="mb-3">
            		<input id='description_' class='form-control' type="text" name="description" placeholder="Description">
            	</div>
            	<button id="submit_" type="submit" name="action" class="btn btn-primary w-100"></button>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modalDel">
    <div class="modal-content">
        <span class="close" style="cursor: pointer;">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal">Delete Role</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('crudRole') }}">
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
            <th>Name</th>
            <th>Permissions</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getRole") }}')
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

            const permissionsCell = document.createElement('td');
            permissionsCell.textContent = menu.permissions;
            row.appendChild(permissionsCell);

            const descriptionCell = document.createElement('td');
            descriptionCell.textContent = menu.description;
            row.appendChild(descriptionCell);

            const actionCell = document.createElement('td');
            if(menu.name != "administrator"){
                actionCell.innerHTML = `
                    <button onClick='modalEdit(${menu.id},"${menu.name}","${menu.description}")' class="btn btn-xs btn-success">Edit</button>
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
        document.getElementById('name_').value='';
        document.getElementById('description_').value='';

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
        titleModal.textContent = "Add Role"

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalEdit(id,name,description,permission){
        document.getElementById('id_').value=id;
        document.getElementById('name_').value=name;
        document.getElementById('description_').value=description;

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
        titleModal.textContent = "Edit Role"            

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
