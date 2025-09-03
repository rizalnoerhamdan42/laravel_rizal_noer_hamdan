<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi RS</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery & Bootstrap Bundle -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Aplikasi RS</a>

            <!-- Tombol toggle untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu kanan -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item d-flex align-items-center me-3">
                            <span class="fw-bold">👋 Hai, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse text-white" id="sidebarMenu"
                    style="min-height: 100vh;">
                    <div class="bg-dark text-white p-3 min-vh-100" style="width:220px;">
                        <h4 class="mb-4">Menu</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('hospitals.index') }}" class="nav-link text-white">🏥 Daftar Rumah
                                    Sakit</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('patients.index') }}" class="nav-link text-white">👤 Daftar Pasien</a>
                            </li>
                            <li class="nav-item mt-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            @endauth

            <!-- Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>