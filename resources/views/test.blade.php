<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Template</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </header>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar flex-shrink-0 p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#submenu1" role="button" aria-expanded="false" aria-controls="submenu1">Menu 1</a>
                    <div class="collapse" id="submenu1">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Submenu 1-1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Submenu 1-2</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#submenu2" role="button" aria-expanded="false" aria-controls="submenu2">Menu 2</a>
                    <div class="collapse" id="submenu2">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Submenu 2-1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Submenu 2-2</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="content">
            <h1>Welcome to the Admin Panel</h1>
            <p>Content goes here...</p>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3">
            &copy; 2024 Admin Panel
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
