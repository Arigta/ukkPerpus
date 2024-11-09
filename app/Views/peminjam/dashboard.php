<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
        }

        .container {
            position: relative;
            z-index: 1;
            color: white;
            padding-bottom: 60px;
            max-width: 1000px;
            /* Mengecilkan lebar maksimum container */
        }

        .copyright {
            position: absolute;
            
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .alert {
            opacity: 0;
            transition: opacity 1s ease-in-out;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .alert-show {
            opacity: 1;
        }

        .alert-hide {
            opacity: 0;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.8);
            color: white;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.8);
            color: white;
        }

        .dashboard-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
            height: 180px;
            /* Menetapkan tinggi tetap */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.15);
        }

        .card-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 0.9rem;
            margin-bottom: 5px;
            text-align: center;
        }

        .card-value {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .welcome-section {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            max-width: 800px;
            /* Mengecilkan lebar welcome section */
            margin-left: auto;
            margin-right: auto;
        }

        .data-card {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(5px);
        }

        .data-card h4 {
            color: white;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .table {
            color: white;
            font-size: 0.9rem;
        }

        .table thead th {
            border-color: rgba(255, 255, 255, 0.2);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .table td {
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Spacing untuk kartu statistik */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 0 auto;
            max-width: 900px;
        }

        /* Responsif untuk tablet dan mobile */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .dashboard-card {
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <video autoplay muted loop class="video-background">
        <source src="<?= base_url('assets/img/readingMinecarft.mp4') ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Perpustakaan Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('peminjam/dashboard/' . $UserID) ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('buku/' . $UserID) ?>">Lihat Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('peminjaman/' . $UserID) ?>">Daftar Peminjaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('ulasan') ?>">Ulasan Saya</a></li>
                </ul>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
    </nav>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="container mt-4">
        <div class="welcome-section">
            <h2>Selamat Datang, <?= $user['NamaLengkap'] ?></h2>
            <p>Selamat datang di Dashboard Perpustakaan Digital. Di sini Anda dapat melihat ringkasan aktivitas dan koleksi Anda.</p>
        </div>

        <div class="stats-container">
            <div class="dashboard-card">
                <i class="fas fa-book card-icon"></i>
                <div class="card-title">Peminjaman Aktif</div>
                <div class="card-value"><?= $total_peminjaman_aktif ?></div>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-history card-icon"></i>
                <div class="card-title">Total Peminjaman</div>
                <div class="card-value"><?= $total_semua_peminjaman ?></div>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-star card-icon"></i>
                <div class="card-title">Ulasan Diberikan</div>
                <div class="card-value"><?= $total_ulasan ?></div>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-heart card-icon"></i>
                <div class="card-title">Koleksi Pribadi</div>
                <div class="card-value"><?= $total_koleksi ?></div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="data-card">
                    <h4><i class="fas fa-clock me-2"></i>Peminjaman Terbaru</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peminjaman_terbaru as $pinjam): ?>
                                    <tr>
                                        <td><?= $pinjam['Judul'] ?></td>
                                        <td><?= date('d M Y', strtotime($pinjam['TanggalPeminjaman'])) ?></td>
                                        <td>
                                            <span class="badge <?= $pinjam['StatusPeminjaman'] === 'Dikembalikan' ? 'bg-success' : 'bg-primary' ?>">
                                                <?= $pinjam['StatusPeminjaman'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="data-card">
                    <h4><i class="fas fa-comments me-2"></i>Ulasan Terbaru</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Rating</th>
                                    <th>Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ulasan_terbaru as $ulasan): ?>
                                    <tr>
                                        <td><?= $ulasan['Judul'] ?></td>
                                        <td>
                                            <?php
                                            $bintang = $ulasan['Rating'] / 2; // Mengonversi rating menjadi skala 0-5
                                            $bintangPenuh = floor($bintang);  // Jumlah bintang penuh
                                            $bintangSetengah = ($bintang - $bintangPenuh) >= 0.5 ? 1 : 0; // Setengah bintang jika ada
                                            ?>

                                            <!-- Menampilkan bintang penuh -->
                                            <?= str_repeat('⭐', $bintangPenuh) ?>
                                            <!-- Menampilkan setengah bintang jika ada -->
                                            <?= $bintangSetengah ? '✩' : '' ?>
                                        </td>
                                        <td><?= substr($ulasan['Ulasan'], 0, 30) ?>...</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <p class="mb-0">
            <i class="fas fa-book-reader me-2"></i>
            &copy; <?= date('Y'); ?> Perpustakaan CI-4. Sulaiman AR
        </p>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').addClass('alert-show');
            }, 200);

            setTimeout(function() {
                $('.alert').removeClass('alert-show').addClass('alert-hide');
            }, 5000);

            setTimeout(function() {
                $('.alert').remove();
            }, 6000);
        });
    </script>
</body>

</html>