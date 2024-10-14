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
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="sidebar" id="sidebar">
    <div class="sidebar-body">
        <ul class="nav flex-column">
            <div class="card-title">
                <span class='text-muted'>KONFIGURASI</span>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle fas fa-th-list"  href="{{ route('indexmenu') }}" role="button" aria-expanded="true" aria-controls="submenu1"> Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle fas fa-user-shield" href="{{ route('indexrole') }}" role="button" aria-expanded="true" aria-controls="submenu1"> Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle fas fa-user-lock" href="{{ route('indexpermission') }}" role="button" aria-expanded="true" aria-controls="submenu1"> Permission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle fas fa-user-tag" href="{{ route('indexroleAccess') }}" role="button" aria-expanded="true" aria-controls="submenu1"> Access Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle fas fa-user-check" href="#submenu1" role="button" aria-expanded="true" aria-controls="submenu1"> Access User</a>
                </li>
            </div>
            <div class="card-title">
                <span class='text-muted'>Content</span>
            </div>
        </ul>
    </div>
</div>
<div class="content" id="content">
@yield('content')
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
