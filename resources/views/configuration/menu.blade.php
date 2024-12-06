@extends('index')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Child Menu</button>

<div class="modal" id="modalAdd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('crudMenu') }}">
            	@csrf
            	<input id='id_' type="hidden" name="id" required>
                <div class="mb-3">
                    <select id='parent_code_' class="form-select" aria-label="Default select example" name='parent_code'>
                        <option value="" selected disabled hidden>--- Choose Parent Code ---</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->parent_code }}">{{ $parent->parent_code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input id='content_' class='form-control' type="text" name="content" placeholder="Content Name" required>
                </div>
            	<div class="mb-3">
            		<input id='route_name_' class='form-control' type="text" name="route_name" placeholder="Route Name" required>
            	</div>
                <div class="mb-3">
                    <input id='order_' class='form-control' type="number" name="ordered" placeholder="Order" required>
                </div>
                <div class="mb-3">
                    <input id='icon_' class='form-control' type="text" name="icon" placeholder="Icon" required>
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
            <h4 id="titleModal">Delete Menu</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('crudMenu') }}">
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
            <th>Parent Code</th>
            <th>Content Name</th>
            <th>Route Name</th>
            <th>Order</th>
            <th>Icon</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getMenu") }}')
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

            const parentCodeCell = document.createElement('td');
            parentCodeCell.textContent = menu.parent_code;
            row.appendChild(parentCodeCell);

            const contentCell = document.createElement('td');
            contentCell.textContent = menu.content;
            row.appendChild(contentCell);

            const routeCell = document.createElement('td');
            routeCell.textContent = menu.route_name;
            row.appendChild(routeCell);

             const orderedCell = document.createElement('td');
            orderedCell.textContent = menu.ordered;
            row.appendChild(orderedCell);

             const iconCell = document.createElement('td');
            iconCell.textContent = menu.icon;
            row.appendChild(iconCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <button onClick='modalEdit(${menu.id},"${menu.parent_code}","${menu.content}","${menu.route_name}","${menu.ordered}","${menu.icon}")' class="btn btn-xs btn-success">Edit</button>
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
        document.getElementById('parent_code_').value='';
        document.getElementById('content_').value='';
        document.getElementById('route_name_').value='';
        document.getElementById('order_').value='';
        document.getElementById('icon_').value='';

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
        titleModal.textContent = "Add Child Menu"

        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalEdit(id,parent_code,content,path,order,icon){
        document.getElementById('id_').value=id;
        document.getElementById('parent_code_').value=parent_code;
        document.getElementById('content_').value=content;
        document.getElementById('route_name_').value=path;
        document.getElementById('order_').value=order;
        document.getElementById('icon_').value=icon;

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
        titleModal.textContent = "Edit Child Menu"            

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
