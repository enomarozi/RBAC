<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/unand-sm.png') }}">
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" crossorigin="anonymous">
	<!-- Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

</head>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%; 
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        width: 30%;
        margin: 15% 35% 35%;
        padding: 15px;
        border: 1px solid #888;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<body>

<nav class="navbar topbar">
    <div class="btn-close-sidebar">        
        <img class="logo" src="{{ asset('assets/images/unand.png') }}" alt="Logo">
        <div class="d-flex" style="height: 70px;">
            <div class="vr"></div>
        </div>
        <button class="btn btn-custom" id="sidebarMinimize" aria-label="Minimize sidebar">
            <img src="{{ asset('assets/images/menu.png') }}" alt="Toggle">
        </button>
    </div>

        <div class="dropdown">
            <button class="btn btn-account" type="button" id="dropdownAccount" data-bs-toggle="dropdown" aria-expanded="false">
                Eno Marozi <i class="fas fa-user-circle dark-icon"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="sidebar" id="sidebar">
    <div class="sidebar-body">
        <ul class="nav flex-column">
            <div class="card-title">
                <span class='text-muted'>MASTER</span>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle fas fa-cog" data-bs-toggle="collapse" href="#submenu1" role="button" aria-expanded="true" aria-controls="submenu1"> Konfigurasi</a>
                    <div class="collapse" id="submenu1">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Menu</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </div>
        </ul>
    </div>
</div>
<div class="content" id="content">
	<button id="modalAdd" class="btn btn-primary mb-3">Add Menu</button>

	<div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4>Add Menu</h4>
            <div class="modal-body">
                <form method="POST" action="{{ route('storeMenu') }}">
                	@csrf
                	<input type="hidden" name="action" value="save" required>
                	<div class="mb-3">
                		<input class='form-control' type="text" name="name" placeholder="Name" required>
                	</div>
                	<div class="mb-3">
                		<input class='form-control' type="text" name="path" placeholder="Path" required>
                	</div>
                	<div class="mb-3">
                		<input class='form-control' type="text" name="description" placeholder="Description" required>
                	</div>
                	<button id="saveChangesBtn" type="submit" class="btn btn-primary w-100">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
	<table id="menus-table" class="display table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Path</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="menus-tbody">
        </tbody>
    </table>
    <script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    	document.addEventListener("DOMContentLoaded",function(){
    		fetch('{{ route("getData")}}')
    		.then(response=>response.json())
    		.then(data=>{
    			const tbody = document.getElementById('menus-tbody');
    			tbody.innerHTML = '';
    			data.data.forEach(menu=>{
    				const row = document.createElement('tr');
    				const idCell = document.createElement('td');
    				idCell.textContent = menu.id;
    				row.appendChild(idCell);

    				const nameCell = document.createElement('td');
    				nameCell.textContent = menu.name;
    				row.appendChild(nameCell);

    				const pathCell = document.createElement('td');
    				pathCell.textContent = menu.path;
    				row.appendChild(pathCell);

    				const actionCell = document.createElement('td');
    				actionCell.innerHTML = menu.action;
    				row.appendChild(actionCell);
    				tbody.append(row);
    			});
    			$('#menus-table').DataTable();
    		})
    	})
    </script>
    <script type="text/javascript">
    	const modal = document.getElementById('myModal');
    	const btnAdd = document.getElementById("modalAdd");
    	const btnEdit = document.getElementById("modalEdit");
    	const span = document.getElementsByClassName("close")[0];
    	const saveBtn = document.getElementById("saveChangesBtn");

    	btnAdd.onclick = function(){
    		modal.style.display = "block";
    	}

    	btnEdit.onclick = function(){
    		modal.style.display = "block";
    	}

    	span.onclick = function(){
    		modal.style.display = "none";
    	}

    	window.onclick = function(event){
    		if(event.target === modal){
    			modal.style.display = "none";
    		}
    	}

    	saveBtn.onclick = function(){
    		modal.style.display = "none";
    	}
    </script>
    

</div>
<script>
    document.getElementById("sidebarMinimize").addEventListener("click", function(){
        document.getElementById("sidebar").classList.toggle("collapsed");
        document.getElementById("content").classList.toggle("collapsed");

        var navLinks = document.querySelectorAll('.nav-link');
        var subTitle = document.querySelectorAll('.text-muted');

        if (!document.getElementById("sidebar").classList.contains("collapsed")) {
            navLinks.forEach(function(link) {
                if (link.dataset.text) {
                    link.textContent = link.dataset.text;
                }
            });
            subTitle.forEach(function(link) {
                if(link.dataset.text){
                    link.textContent = link.dataset.text;
                }
            });
        } else {
            navLinks.forEach(function(link) {
                link.dataset.text = link.textContent;
                link.textContent = '';
            });
            subTitle.forEach(function(link) {
                link.dataset.text = link.textContent;
                link.textContent = '';
            });
        }
    });
</script>
</body>
</html>
