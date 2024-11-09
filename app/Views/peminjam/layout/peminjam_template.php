<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #212529;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background-color: #1a1d20 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #fff !important;
        }
        
        .nav-link.active {
            color: #fff !important;
            font-weight: 500;
        }
        
        footer {
            margin-top: auto;
            background-color: #1a1d20 !important;
            padding: 1.5rem 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('peminjam/dashboard/'. $UserID); ?>">
                <i class="fas fa-book-reader me-2"></i>Perpustakaan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('peminjam/dashboard/'. $UserID) ?>">Dashboard</a></li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('buku/' . session()->get('UserID')) ?>">Lihat Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('peminjaman/' . session()->get('UserID')) ?>">Daftar Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('ulasan'); ?>" class="nav-link">Ulasan Saya</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('peminjam/koleksi/' . session()->get('UserID')) ?>">Koleksi Saya</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">
                    <i class="fas fa-book-reader me-2"></i>
                    &copy; <?= date('Y'); ?> Perpustakaan CI-4. Sulaiman AR
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>