<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }

        .cardD {
            background-color: #333;
            border-color: #444;
            transition: transform 0.2s;
            /* Efek saat hover */
        }

        .cardD:hover {
            transform: scale(1.05);
            /* Efek zoom saat hover */
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

        /* Tabel */
        .table-dark th,
        .table-dark td {
            color: white;
            /* Warna font agar terlihat */
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
            /* Ukuran gambar */
        }

        .card-title {
            font-size: 14px;
        }

        /* Gambar Buku */
        .detail-img {
            width: 150px;
            /* Ukuran gambar detail */
            height: auto;
        }

        .modal-body {
            /*display: flex; /* Menampilkan konten secara horizontal */
            align-items: center;
            /* Vertikal center */
        }

        .modal-body .line {
            height: 150px;
            /* Tinggi garis */
            width: 1px;
            /* Lebar garis */
            background-color: #fff;
            /* Warna garis */
            margin: 0 15px;
            /* Spasi antara gambar dan detail */
        }

        table {
            border-collapse: separate;
            /* Memisahkan border */
            border-spacing: 0 10px;
            /* Menambahkan jarak antar baris */
        }

        td {
            padding: 10px;
            /* Menambahkan padding dalam cell */

        }

        .btn-icon {
            cursor: pointer;
            width: 30px;
            height: 30px;
            transition: transform 0.2s, opacity 0.2s;
            /* Transisi untuk efek hover */
        }

        .btn-icon:hover {
            transform: scale(1.2);
            /* Membesarkan gambar saat hover */
            opacity: 0.8;
            /* Mengubah opacity saat hover */
        }

        #searchInput {
            width: 200px;
            /* Atur leba
            r input pencarian sesuai kebutuhan */
        }

        /* Di dalam tag <style> */
        select[multiple] {
            min-height: 100px;
        }

        .form-select option {
            padding: 8px;
            margin: 2px;
        }
    </style>
</head>

<body>

    <!-- Pesan Flash -->
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    <div class="container ">
        <div class="container mt-5">
            <div class="row my-4">
                <div class="col-lg-12">
                    <div class="card shadow bg-dark">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="text-light fw-bold fs-3">Daftar Buku</div>
                            <div class="d-flex align-items-center">

                                <img src="<?= base_url('assets/img/add.png'); ?>" class="btn-icon me-2" alt="Tambah Buku" style="cursor: pointer; width: 30px; height: 30px;" data-bs-toggle="modal" data-bs-target="#addEditModal" title="Tambah Buku">
                                <img src="<?= base_url('assets/img/table.png'); ?>" class="btn-icon me-2" id="toggleView" style="cursor: pointer; width: 30px; height: 30px;" title="Tampilkan sebagai Tabel">
                                <input type="text" id="searchInput" class="form-control me-2" placeholder="Cari Buku..." style="width: 200px;">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="container mt-3">
                                    <div id="cardView" class="row">
                                        <?php foreach ($buku as $item): ?>
                                            <div class="col-md-2">
                                                <div class="card cardD mb-4" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="<?= $item['BukuID'] ?>">
                                                    <img src="<?= base_url('assets/img/buku/' . $item['gambar']); ?>" class="card-img-top" alt="<?= $item['Judul']; ?>">

                                                    <div class="card-body text-center">
                                                        <h5 class="card-title"><?= $item['Judul'] ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Tabel Buku -->
                                <table id="tableView" class="table table-dark" style="display:none;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($buku as $item): ?>
                                            <tr>
                                                <td><?= $item['BukuID'] ?></td>
                                                <td><?= $item['Judul'] ?></td>
                                                <td><?= $item['Penulis'] ?></td>
                                                <td><?= $item['Penerbit'] ?></td>
                                                <td><?= $item['TahunTerbit'] ?></td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="editBuku(<?= $item['BukuID'] ?>, '<?= $item['Judul'] ?>', '<?= $item['Penulis'] ?>', '<?= $item['Penerbit'] ?>', '<?= $item['TahunTerbit'] ?>')">Edit</button>
                                                    <button class="btn btn-danger" onclick="confirmDelete(<?= $item['BukuID'] ?>)">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Buku -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Buku (ID: <span id="detailId"></span>)</h5> <!-- ID Buku di dalam Judul -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-start">
                        <!-- Bagian gambar di sebelah kiri -->
                        <div class="me-3">
                            <img id="detailGambar" class="detail-img" src="" alt="Gambar Buku"  style="width: 100%; min-width: 450px; min-height: 560px; max-width: 410px; max-height: 510px; object-fit: cover;">
                        </div>

                        <!-- Garis vertikal pemisah -->
                        <div class="line" style="border-left: 2px solid #ccc; height: 100%; margin-right: 20px;"></div>

                        <!-- Bagian detail buku di sebelah kanan -->
                        <div>
                            <h5 style="font-weight: bold;" id="detailJudul"></h5>
                            <hr>
                            <table>
                                <tr>
                                    <td>Penulis </td>
                                    <td>:</td>
                                    <td><span id="detailPenulis"></span></td>
                                </tr>
                                <tr>
                                    <td>Penerbit </td>
                                    <td> : </td>
                                    <td><span id="detailPenerbit"></span></td>
                                </tr>
                                <tr>
                                    <td>Tahun </td>
                                    <td> : </td>
                                    <td><span id="detailTahun"></span></td>
                                </tr>
                                <tr>
                                    <td>Kategori </td>
                                    <td> : </td>
                                    <td><span id="detailKategori"></span></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi </td>
                                    <td> : </td>
                                    <td><span id="detailDeskripsi"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-danger me-2" id="deleteButton" confirmDelete(<?= $item['BukuID'] ?>)>Hapus</button>
                        <button class="btn btn-primary" id="editButton" data-bs-toggle="modal" data-bs-target="#addEditModal">Edit</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Tambah/Edit Buku -->
        <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditModalLabel">Tambah/Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="bukuForm" action="/admin/buku/save" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="bukuId">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control bg-dark text-light" id="judul" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control bg-dark text-light" id="penulis" name="penulis" required>
                            </div>
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control bg-dark text-light" id="penerbit" name="penerbit" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                <input type="number" class="form-control bg-dark text-light" id="tahun_terbit" name="tahun_terbit" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select bg-dark text-light" id="kategori" name="kategori[]" multiple required>
                                    <?php foreach ($kategori as $kat): ?>
                                        <option value="<?= $kat['KategoriID'] ?>"><?= $kat['NamaKategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control bg-dark text-light" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control bg-dark text-light" id="gambar" name="gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            const baseUrl = '<?= base_url() ?>';
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                // Tampilkan pesan flash
                if ($('.alert').length) {
                    setTimeout(function() {
                        $('.alert').fadeOut('slow');
                    }, 3000);
                }

                // Tombol Toggle View
                $('#toggleView').click(function() {
                    $('#cardView').toggle();
                    $('#tableView').toggle();
                    const isTableView = $('#tableView').is(':visible');
                    $(this).attr('src', isTableView ? baseUrl + '/assets/img/card.png' : baseUrl + '/assets/img/table.png');
                });

                // fungsi search
                $('#searchInput').on('input', function() {
                    var searchValue = $(this).val().toLowerCase();

                    // Filter card view
                    $('#cardView .card').filter(function() {
                        $(this).toggle($(this).find('.card-title').text().toLowerCase().indexOf(searchValue) > -1);
                    });

                    // Filter table view
                    $('#tableView tbody tr').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                    });
                });
            });

            // Pindahkan confirmDelete ke luar dari fungsi editBuku agar bisa diakses global
            function confirmDelete(id) {
                if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                    // Gunakan base_url yang benar
                    window.location.href = baseUrl + '/admin/buku/delete/' + id;
                }
            }

            // Menampilkan detail buku
            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                console.log("ID Buku:", id);

                $.ajax({
                    url: baseUrl + '/admin/buku/detail/' + id,
                    method: 'GET',
                    success: function(data) {
                        console.log("Data dari server:", data);
                        if (data) {
                            $('#detailId').text(data.BukuID);
                            $('#detailGambar').attr('src', baseUrl + '/assets/img/buku/' + data.gambar);
                            $('#detailJudul').text(data.Judul);
                            $('#detailPenulis').text(data.Penulis);
                            $('#detailPenerbit').text(data.Penerbit);
                            $('#detailTahun').text(data.TahunTerbit);
                            $('#detailKategori').text(data.categories || '-');
                            $('#detailDeskripsi').text(data.Deskripsi || '-');

                            // Update tombol edit dan delete dengan ID yang benar
                            $('#editButton').attr('onclick', `editBuku(${data.BukuID}, '${data.Judul}', '${data.Penulis}', '${data.Penerbit}', '${data.TahunTerbit}', '${data.Deskripsi}')`);
                            $('#deleteButton').attr('onclick', `confirmDelete(${data.BukuID})`);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        console.log("Status:", status);
                        console.log("Response:", xhr.responseText);
                        alert('Error mengambil data buku');
                    }
                });
            });

            function editBuku(id, judul, penulis, penerbit, tahun, deskripsi) {
                $('#bukuId').val(id);
                $('#judul').val(judul);
                $('#penulis').val(penulis);
                $('#penerbit').val(penerbit);
                $('#tahun_terbit').val(tahun);
                $('#deskripsi').val(deskripsi);

                // Reset kategori
                $('#kategori option').prop('selected', false);

                // Jika ada kategori, select them
                if (typeof kategoris !== 'undefined' && kategoris) {
                    let kategoriArray = kategoris.split(',');
                    kategoriArray.forEach(function(kat) {
                        $(`#kategori option:contains('${kat.trim()}')`).prop('selected', true);
                    });
                }

                $('#gambar').val('');
                $('#gambar').removeAttr('required');

                $('#addEditModalLabel').text('Edit Buku');
                $('#addEditModal').modal('show');
                $('#detailModal').modal('hide');
            }
        </script>
</body>

</html>