

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('<?= base_url('assets/img/minecarftLibriary.jpg') ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            background-color: rgba(0, 0, 0, 0.8);
            padding-top: 20px;
            transition: width 0.3s;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .sidebar .navbar-brand {
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

        h2 {
            margin-top: 20px;
        }

        .container p {
            font-size: 1.1rem;
            line-height: 1.6;
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

        /* Warna pesan agar sesuai dengan background gelap */
        .alert-success {
            background-color: rgba(40, 167, 69, 0.8);
            color: white;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.8);
            color: white;
        }

        /* Fade-out animation */
        .alert-hide {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .copyright {
            position: fixed;
            bottom: 0;
            /* Memastikan posisinya di bawah */
            left: 0;
            /* Menempatkan di kiri */
            width: 100%;
            /* Membuat lebar penuh */
            background-color: rgba(0, 0, 0, 0.1);
            /* Warna gelap dengan transparansi */
            color: white;
            /* Warna teks */
            text-align: center;
            /* Mengatur teks agar berada di tengah */
            padding: 10px 0;
            /* Jarak atas dan bawah */
        }
    </style>
</head>

<body>


    <!-- Sidebar -->
    <div class="sidebar">
        
        <a class="navbar-brand" href="#">Admin Panel</a>
        <a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a>
        <a href="<?= base_url('/admin/buku'); ?>">Data Buku</a>
        <a href="<?= base_url('/admin/kategori'); ?>">Kategori</a>
        <a href="<?= base_url('/admin/users'); ?>">Data Anggota</a>
        <a href="<?= base_url('/admin/peminjaman'); ?>">Data Peminjam</a>
        <a href="<?= base_url('admin/data-ulasan'); ?>">Data Ulasan</a>
        <a href="<?= base_url('admin/laporan'); ?>">Laporan</a>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger logout-btn">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-info alert-dismissible fade show font-weight-bold" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
        <div class="container mt-5">
            <h2>Selamat Datang di Dashboard Admin</h2>
            <p>Anda dapat mengelola data buku, anggota, peminjam, ulasan, serta melihat laporan di sini. Navigasi menggunakan menu di samping.</p>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Tampilkan pesan dengan animasi fade-in
            setTimeout(function() {
                $('.alert').addClass('alert-show');
            }, 200);

            // Setelah beberapa detik, hilangkan pesan dengan fade-out
            setTimeout(function() {
                $('.alert').removeClass('alert-show').addClass('alert-hide');
            }, 5000); // 5 detik sebelum hilang

            // Hapus elemen pesan setelah animasi selesai
            setTimeout(function() {
                $('.alert').remove();
            }, 6000); // 6 detik total, setelah fade-out selesai
        });
    </script>
      <div class="copyright">
        &copy; SMK NEGERI 9 MEDAN 2024. Sulaiman AR
    </div>
</body>

</html>
