@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Role</button>

<div class="modal" id="myModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('datarole') }}">
            	@csrf
            	<input id='id_' type="hidden" name="id" required>
            	<div class="mb-3">
            		<input id='name_' class='form-control' type="text" name="name" placeholder="Name" required>
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
            <h4 id="titleModal">Delete Role</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('datarole') }}">
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
            <th>Name</th>
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
    fetch('{{ route("getDataRole") }}')
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

            const nameCell = document.createElement('td');
            nameCell.textContent = menu.name;
            row.appendChild(nameCell);

            const subMenuCell = document.createElement('td');
            subMenuCell.textContent = menu.description;
            row.appendChild(subMenuCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <button onClick='modalEdit(${menu.id},"${menu.name}","${menu.description}")' class="btn btn-xs btn-success">Edit</button>
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
        document.getElementById('name_').value='';
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

    function modalEdit(id,name,description){
        document.getElementById('id_').value=id;
        document.getElementById('name_').value=name;
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
        titleModal.textContent = "Edit Role"            

        window.onclick = function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        }
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

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    }
</script>
@endsection
