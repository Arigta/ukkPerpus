<?= $this->extend('peminjam/layout/peminjam_template'); ?>
<?= $this->section('content'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }

        .cardD {
            background-color: #333;
            border-color: #444;
            transition: transform 0.2s;
        }

        .cardD:hover {
            transform: scale(1.05);
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

        .table-dark th,
        .table-dark td {
            color: white;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        .card-title {
            font-size: 16px;
            margin-bottom: 0.5rem;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
        }

        .detail-img {
            width: 150px;
            height: auto;
        }

        .modal-body {
            align-items: center;
        }

        .modal-body .line {
            height: 150px;
            width: 1px;
            background-color: #fff;
            margin: 0 15px;
        }

        #cardView {
            display: flex;
            flex-wrap: wrap;
        }

        .hidden {
            display: none !important;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        td {
            padding: 10px;
        }

        /* Style untuk tombol like */
        .like-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
            z-index: 10;
        }

        .like-button:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        .like-button.liked svg {
            fill: #ff4444;
            color: #ff4444;
        }

        .empty-collection {
            text-align: center;
            padding: 50px 0;
        }

        .empty-collection i {
            font-size: 48px;
            color: #666;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container mt-5">
            <div class="row my-4">
                <div class="col-lg-12">
                    <div class="card shadow bg-dark">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="text-light fw-bold fs-3">Koleksi Buku Saya</div>
                            <div class="d-flex align-items-center">
                                <input type="text" id="searchInput" class="form-control me-2" placeholder="Cari Buku..." style="width: 200px;">
                                <a href="<?= base_url('buku/' . $UserID) ?>" class="btn btn-primary">Kembali ke Daftar Buku</a>
                            </div>
                        </div>
                        <div class="card-body mb-4">
                            <div class="row">
                                <div class="container mt-3">
                                    <div id="cardView" class="row mb-4">
                                        <?php if (empty($buku)): ?>
                                            <div class="col-12 empty-collection">
                                                <i class="bi bi-book"></i>
                                                <h4>Koleksi Masih Kosong</h4>
                                                <p>Anda belum menambahkan buku ke koleksi</p>
                                                <a href="<?= base_url('buku') ?>" class="btn btn-primary">Jelajahi Buku</a>
                                            </div>
                                        <?php else: ?>
                                            <?php foreach ($buku as $item): ?>
                                                <div class="col-md-2 mb-4 card-wrapper">
                                                    <div class="card cardD book-card text-light position-relative" data-bukuid="<?= $item['BukuID'] ?>" data-judul="<?= $item['Judul'] ?>" data-gambar="<?= $item['gambar'] ?>">
                                                        <div class="position-relative">
                                                            <img src="<?= base_url('assets/img/buku/' . $item['gambar']); ?>" class="card-img-top" alt="<?= $item['Judul']; ?>">
                                                            <button class="like-button liked" onclick="toggleKoleksi(<?= $item['BukuID'] ?>, this, event)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title"><?= $item['Judul'] ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Buku -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-start">
                    <div class="me-3">
                        <img id="detailGambar" class="detail-img" src="" alt="Gambar Buku" style="width: 100%; max-width: 550px; max-height: 400px; object-fit: cover;">
                    </div>
                    <div class="line"></div>
                    <div>
                        <h5 style="font-weight: bold;" id="detailJudul"></h5>
                        <hr>
                        <table>
                            <tr>
                                <td>Penulis</td>
                                <td>:</td>
                                <td><span id="detailPenulis"></span></td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td>:</td>
                                <td><span id="detailPenerbit"></span></td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td>:</td>
                                <td><span id="detailTahun"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pinjamButton">Pinjam</button>
                    <button type="button" class="btn btn-primary" id="ulasanButton">Beri Ulasan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Pencarian buku
            $('#searchInput').on('input', function() {
                var searchValue = $(this).val().toLowerCase();
                $('.card-wrapper').filter(function() {
                    $(this).toggleClass('hidden',
                        $(this).find('.card-title').text().toLowerCase().indexOf(searchValue) === -1
                    );
                });
            });

            // Handle klik pada card buku
            $('.book-card').on('click', function() {
                const bukuID = $(this).data('bukuid');
                showDetailModal(bukuID);
            });
        });

        // Fungsi untuk toggle koleksi
        function toggleKoleksi(bukuID, button, event) {
            event.stopPropagation();
            
            $.ajax({
                url: '<?= base_url("koleksi/toggle") ?>',
                type: 'POST',
                data: { bukuID: bukuID },
                success: function(response) {
                    if (response.status === 'success') {
                        if (!response.isInCollection) {
                            // Hapus card buku dari tampilan
                            $(button).closest('.card-wrapper').fadeOut(300, function() {
                                $(this).remove();
                                // Cek jika koleksi kosong
                                if ($('.card-wrapper').length === 0) {
                                    $('#cardView').html(`
                                        <div class="col-12 empty-collection">
                                            <i class="bi bi-book"></i>
                                            <h4>Koleksi Masih Kosong</h4>
                                            <p>Anda belum menambahkan buku ke koleksi</p>
                                            <a href="<?= base_url('buku') ?>" class="btn btn-primary">Jelajahi Buku</a>
                                        </div>
                                    `);
                                }
                            });
                        }
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server'
                    });
                }
            });
        }

        // Fungsi untuk menampilkan modal detail
        function showDetailModal(bukuID) {
            $.ajax({
                url: '<?= base_url("index.php/peminjam/buku/detail/") ?>' + bukuID,
                method: 'GET',
                success: function(response) {
                    try {
                        const data = typeof response === 'string' ? JSON.parse(response) : response;

                        if (data && data.BukuID) {
                            $('#detailId').text(data.BukuID);
                            $('#detailGambar').attr('src', '<?= base_url("assets/img/buku/") ?>/' + data.gambar);
                            $('#detailJudul').text(data.Judul);
                            $('#detailPenulis').text(data.Penulis);
                            $('#detailPenerbit').text(data.Penerbit);
                            $('#detailTahun').text(data.TahunTerbit);

                            $('#detailModal').data('bukuData', data);
                            $('#detailModal').modal('show');
                        } else {
                            Swal.fire('Error', 'Data buku tidak ditemukan', 'error');
                        }
                    } catch (e) {
                        console.error("Error parsing response:", e);
                        Swal.fire('Error', 'Gagal memproses data buku', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax Error:", { xhr, status, error });
                    Swal.fire('Error', 'Gagal mengambil data buku', 'error');
                }
            });
        }
    </script>
</body>

<?= $this->endSection(); ?>