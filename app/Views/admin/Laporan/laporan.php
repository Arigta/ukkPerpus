<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: #f8f9fa;
        }
        .card {
            background-color: #212529;
            border: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Generate Laporan</h2>
        <div class="row">

            <!-- Laporan Peminjaman -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Peminjaman</h5>
                        <p class="card-text">Laporan mengenai daftar peminjaman, termasuk tanggal peminjaman, pengembalian, dan status buku.</p>
                        <a href="<?= base_url('/admin/laporan/peminjaman') ?>" class="btn btn-primary">Generate Laporan</a>
                    </div>
                </div>
            </div>

            <!-- Laporan Keanggotaan -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Keanggotaan</h5>
                        <p class="card-text">Laporan keanggotaan perpustakaan, termasuk daftar anggota aktif dan statistik anggota baru.</p>
                        <a href="<?= base_url('/admin/laporan/keanggotaan') ?>" class="btn btn-primary">Generate Laporan</a>
                    </div>
                </div>
            </div>

            <!-- Laporan Ulasan -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Ulasan</h5>
                        <p class="card-text">Laporan mengenai ulasan yang diberikan oleh anggota perpustakaan beserta rating buku.</p>
                        <a href="<?= base_url('/admin/laporan/ulasan') ?>" class="btn btn-primary">Generate Laporan</a>
                    </div>
                </div>
            </div>

            <!-- Laporan Buku Populer -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Buku </h5>
                        <p class="card-text">Laporan buku paling populer, termasuk daftar buku yang paling sering dipinjam dan kategori favorit.</p>
                        <a href="/generateLaporan/bukuPopuler" class="btn btn-primary">Generate Laporan</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
