<?= $this->extend('peminjam/layout/peminjam_template'); ?>
<?= $this->section('content'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
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

        .alert-success {
            background-color: rgba(40, 167, 69, 0.8);
            color: white;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.8);
            color: white;
        }

        .table-dark th,
        .table-dark td {
            color: white;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
            width: 100%;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="container mt-5">
            <div class="row my-4">
                <div class="col-lg-12">
                    <div class="card shadow bg-dark">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="text-light fw-bold fs-3">Daftar Buku</div>
                            <div class="d-flex align-items-center gap-2">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari Buku..." style="width: 200px;">
                                <a href="<?= base_url('peminjam/koleksi/' . $UserID) ?>" class="btn btn-primary">Koleksi Saya</a>

                            </div>
                        </div>
                        <div class="card-body mb-4">
                            <div class="row">
                                <div class="container mt-3">
                                    <div id="cardView" class="row mb-4">
                                        <?php foreach ($buku as $item): ?>
                                            <div class="col-md-2 mb-4 card-wrapper">
                                                <div class="card cardD mb-4 book-card text-light position-relative"
                                                    data-bukuid="<?= $item['BukuID'] ?>"
                                                    data-judul="<?= $item['Judul'] ?>"
                                                    data-gambar="<?= $item['gambar'] ?>">
                                                    <div class="position-relative">
                                                        <img src="<?= base_url('assets/img/buku/' . $item['gambar']); ?>"
                                                            class="card-img-top"
                                                            alt="<?= $item['Judul']; ?>">
                                                        <button class="like-button" data-bukuid="<?= $item['BukuID'] ?>">
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
                                    </div>
                                </div>

                                <!-- Modal Detail Buku -->
                                <div class="modal fade" id="detailModal" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Buku (ID: <span id="detailId"></span>)</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body d-flex align-items-start">
                                                <div class="me-3">
                                                    <img id="detailGambar" class="detail-img" src="" alt="Gambar Buku"
                                                        style="width: 100%; min-width: 450px; min-height: 560px; max-width: 410px; max-height: 510px; object-fit: cover;">

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
                                                        <tr>
                                                            <td>Kategori</td>
                                                            <td>:</td>
                                                            <td><span id="detailKategori"></span></td>
                                                        </tr>

                                                        <tr>
                                                            <td>Deskripsi</td>
                                                            <td>:</td>
                                                            <td><span id="detailDeskripsi"></span></td>
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

                                <!-- Modal Pinjam -->
                                <div class="modal fade" id="pinjamModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pinjam Buku (ID: <span id="bukuID"></span>)</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <img id="bukuGambar" src="" alt="Gambar Buku" style="max-width: 200px;">
                                                    <h6 id="bukuJudul" class="mt-2"></h6>
                                                </div>
                                                <form id="pinjamForm">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Peminjaman</label>
                                                        <input type="text" class="form-control" id="tanggalPeminjaman" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                                                        <input type="date" class="form-control" id="tanggalPengembalian" required>
                                                    </div>
                                                    <input type="hidden" id="bukuID" name="bukuID">
                                                    <button type="submit" class="btn btn-primary w-100">Konfirmasi Peminjaman</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ulasan -->
    <div class="modal fade" id="ulasanModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Beri Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="ulasanForm">
                    <div class="modal-body">
                        <input type="hidden" name="BukuID" id="BukuID">
                        <div class="mb-3">
                            <label for="Ulasan" class="form-label">Ulasan</label>
                            <textarea class="form-control" id="Ulasan" name="Ulasan" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Rating" class="form-label">Rating (1-10)</label>
                            <input type="number" class="form-control" id="Rating" name="Rating" min="1" max="10" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Ulasan</button>
                    </div>
                </form>
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

            // Check status koleksi saat halaman dimuat
            // Modifikasi fungsi checkCollectionStatus
            function checkCollectionStatus() {
                $('.book-card').each(function() {
                    const bukuID = $(this).data('bukuid');
                    const $likeButton = $(this).find('.like-button');

                    $.get(`<?= base_url('koleksi/check') ?>/${bukuID}`, function(response) {
                        if (response.isInCollection) {
                            $likeButton.addClass('liked');
                            $likeButton.find('i').removeClass('bi-heart').addClass('bi-heart-fill');
                        } else {
                            $likeButton.removeClass('liked');
                            $likeButton.find('i').removeClass('bi-heart-fill').addClass('bi-heart');
                        }
                    });
                });
            }


            // Panggil fungsi check status saat halaman dimuat
            checkCollectionStatus();

            // Handle klik pada card buku (PERBAIKAN: Exclude like button)
            $('.book-card').on('click', function(e) {
                // Jika yang diklik adalah tombol like atau bagian dari tombol like, jangan lakukan apa-apa
                if ($(e.target).closest('.like-button').length === 0) {
                    const bukuID = $(this).data('bukuid');
                    showDetailModal(bukuID);
                }
            });

            // Handle klik tombol like (PERBAIKAN: Prevent event bubbling)
            // Modifikasi bagian handle click tombol like
            $(document).on('click', '.like-button', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $button = $(this);
                const bukuID = $button.data('bukuid');

                $.ajax({
                    url: '<?= base_url("koleksi/toggle") ?>',
                    type: 'POST',
                    data: {
                        bukuID: bukuID
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            if (response.isInCollection) {
                                $button.addClass('liked');
                                $button.find('i').removeClass('bi-heart').addClass('bi-heart-fill');
                            } else {
                                $button.removeClass('liked');
                                $button.find('i').removeClass('bi-heart-fill').addClass('bi-heart');
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat memproses permintaan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });

            // Modifikasi fungsi checkCollectionStatus
            function checkCollectionStatus() {
                $('.book-card').each(function() {
                    const bukuID = $(this).data('bukuid');
                    const $likeButton = $(this).find('.like-button');

                    $.get(`<?= base_url('koleksi/check') ?>/${bukuID}`, function(response) {
                        if (response.isInCollection) {
                            $likeButton.addClass('liked');
                            $likeButton.find('i').removeClass('bi-heart').addClass('bi-heart-fill');
                        } else {
                            $likeButton.removeClass('liked');
                            $likeButton.find('i').removeClass('bi-heart-fill').addClass('bi-heart');
                        }
                    });
                });
            }






            // Handle klik pada card buku
            $('.book-card').on('click', function() {
                const bukuID = $(this).data('bukuid');
                showDetailModal(bukuID);
            });

            // Fungsi untuk menampilkan modal detail
            // Modified showDetailModal function to handle borrowed books
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
                                $('#detailKategori').text(data.categories || '-');
                                $('#detailDeskripsi').text(data.Deskripsi || '-');

                                // Check if book is borrowed and update UI accordingly
                                if (data.isDipinjam) {
                                    $('#pinjamButton').prop('disabled', true)
                                        .text('Sedang Dipinjam')
                                        .addClass('btn-secondary')
                                        .removeClass('btn-primary');
                                } else {
                                    $('#pinjamButton').prop('disabled', false)
                                        .text('Pinjam')
                                        .addClass('btn-primary')
                                        .removeClass('btn-secondary');
                                }

                                $('#detailModal').data('bukuData', data);
                                $('#detailModal').modal('show');
                            } else {
                                console.error("Data buku tidak lengkap:", data);
                                Swal.fire('Error', 'Data buku tidak ditemukan', 'error');
                            }
                        } catch (e) {
                            console.error("Error parsing response:", e);
                            Swal.fire('Error', 'Gagal memproses data buku', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax Error:", {
                            xhr,
                            status,
                            error
                        });
                        Swal.fire('Error', 'Gagal mengambil data buku', 'error');
                    }
                });
            }

            // Modify the book card click handler
            $('.book-card').on('click', function(e) {
                if ($(e.target).closest('.like-button').length === 0) {
                    const bukuID = $(this).data('bukuid');
                    if (!$(this).hasClass('borrowed')) {
                        showDetailModal(bukuID);
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Buku Sedang Dipinjam',
                            text: 'Maaf, buku ini sedang dipinjam oleh pengguna lain.',
                            showConfirmButton: true
                        });
                    }
                }
            });

            // Handle klik tombol Pinjam di modal detail
            $('#pinjamButton').on('click', function() {
                const bukuData = $('#detailModal').data('bukuData');
                if (bukuData) {
                    // Set data ke modal peminjaman
                    $('#bukuID').val(bukuData.BukuID);
                    $('#bukuJudul').text(bukuData.Judul);
                    $('#bukuGambar').attr('src', '<?= base_url("assets/img/buku/") ?>/' + bukuData.gambar);

                    // Set tanggal peminjaman ke hari ini
                    const today = new Date().toISOString().split('T')[0];
                    $('#tanggalPeminjaman').val(today);

                    // Set minimal tanggal pengembalian ke hari berikutnya
                    const tomorrow = new Date();
                    tomorrow.setDate(tomorrow.getDate() + 1);
                    $('#tanggalPengembalian').attr('min', tomorrow.toISOString().split('T')[0]);

                    // Tutup modal detail dan buka modal peminjaman
                    $('#detailModal').modal('hide');
                    $('#pinjamModal').modal('show');
                }
            });

            // Handle submit form peminjaman
            $('#pinjamForm').on('submit', function(e) {
                e.preventDefault();

                const bukuID = $('#bukuID').val();
                const tanggalPengembalian = $('#tanggalPengembalian').val();

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("index.php/peminjaman/pinjam/") ?>' + bukuID,
                    data: {
                        tanggalPengembalian: tanggalPengembalian
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message || 'Buku berhasil dipinjam',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#pinjamModal').modal('hide');
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message || 'Terjadi kesalahan saat meminjam buku'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax Error:", {
                            xhr,
                            status,
                            error
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server'
                        });
                    }
                });
            });

            // Handle klik tombol ulasan
            $('#ulasanButton').on('click', function() {
                const bukuData = $('#detailModal').data('bukuData');
                if (bukuData) {
                    // Set BukuID ke modal ulasan
                    $('#BukuID').val(bukuData.BukuID);
                    // Reset form
                    $('#ulasanForm')[0].reset();
                    // Set judul di modal
                    $('#ulasanModalLabel').text('Beri Ulasan: ' + bukuData.Judul);
                    // Tutup modal detail
                    $('#detailModal').modal('hide');
                    // Buka modal ulasan
                    $('#ulasanModal').modal('show');
                }
            });

            // Handle submit form ulasan
            $('#ulasanForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '<?= base_url("index.php/ulasan/save") ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#ulasanModal').modal('hide');
                                // Optional: refresh halaman atau update tampilan ulasan
                                // location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax Error:", {
                            xhr,
                            status,
                            error
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server'
                        });
                    }
                });
            });
        });
    </script>
</body>


</html>
<?= $this->endSection(); ?>