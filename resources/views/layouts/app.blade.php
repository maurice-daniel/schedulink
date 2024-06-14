<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/favicon.png">
    <title>Schedulink</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Sidebar content -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="image/logo.png" style="width: 35px; height: auto;">
                        Schedulink
                    </a>
                </div>
                <div class="sidebar-nav-wrapper">
                    <ul class="sidebar-nav">
                        <li class="sidebar-header">Assign</li>
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-list pe-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="sidebar-header">Add on</li>
                        <li class="sidebar-item">
                            <a href="{{ route('faculty.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-users pe-2"></i>
                                Faculty
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('section.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-file-lines pe-2"></i>
                                Section
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('subject.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                Subject
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('room.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-university pe-2"></i>
                                Room
                            </a>
                        </li>
                        <li class="sidebar-header">Settings</li>
                        <li class="sidebar-item">
                            <a href=# class="sidebar-link">
                                <i class="fa-regular fa-calendar-days pe-2"></i>
                                Calendar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                                <i class="fas fa-user fa-fw"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                @yield('contents')
                <div class="container-fluid"></div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
