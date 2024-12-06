@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Parent Menu</button>

<div class="modal" id="modalAdd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('crudParentMenu') }}">
            	@csrf
            	<input id='id_' type="hidden" name="id" required>
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
                    <input id='parent_code_' class='form-control' type="text" name="parent_code" placeholder="Parent Code" required>
                </div>
                <div class="mb-3">
                    <input id='parent_name_' class='form-control' type="text" name="parent_name" placeholder="Parent Name" required>
                </div>
                <div class="mb-3">
                    <input id='ordered_' class='form-control' type="number" name="ordered" placeholder="Order" required>
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
            <h4 id="titleModal">Delete Parent Menu</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('crudParentMenu') }}">
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
            <th>Role</th>
            <th>Parent Code</th>
            <th>Parent Menu</th>
            <th>Order</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getParentMenu") }}')
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

            const roleCell = document.createElement('td');
            roleCell.textContent = menu.role;
            row.appendChild(roleCell);

            const parentCodeCell = document.createElement('td');
            parentCodeCell.textContent = menu.parent_code;
            row.appendChild(parentCodeCell);

            const parentNameCell = document.createElement('td');
            parentNameCell.textContent = menu.parent_name;
            row.appendChild(parentNameCell);

            const orderedCell = document.createElement('td');
            orderedCell.textContent = menu.ordered;
            row.appendChild(orderedCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <button onClick='modalEdit(${menu.id},"${menu.role}","${menu.parent_code}","${menu.parent_name}",${menu.ordered})' class="btn btn-xs btn-success">Edit</button>
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
        document.getElementById('parent_code_').value='';
        document.getElementById('parent_name_').value='';
        document.getElementById('ordered_').value='';

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
        titleModal.textContent = "Add Parent Menu"

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalEdit(id,role,parent_code,parent_name,ordered){
        document.getElementById('id_').value=id;
        document.getElementById('role_').value=role;
        document.getElementById('parent_code_').value=parent_code;
        document.getElementById('parent_name_').value=parent_name;
        document.getElementById('ordered_').value=ordered;

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
        titleModal.textContent = "Edit Parent Menu"            

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
