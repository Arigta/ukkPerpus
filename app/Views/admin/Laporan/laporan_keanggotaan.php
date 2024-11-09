<!-- Views/admin/Laporan/laporan_keanggotaan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Keanggotaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #e0f2f1;
            text-align: left;
        }

        h2,
        p {
            text-align: center;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>

<body>

    <button class="btn btn-success" onclick="window.print()">Cetak Laporan</button>

    <h2>LAPORAN DATA KEANGGOTAAN</h2>
    <p>APLIKASI PERPUSTAKAAN DIGITAL SMK NEGERI 9 MEDAN</p>
    <p>Data ini merupakan data keseluruhan keanggotaan perpustakaan</p>
    <br><br>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th scope="col">ID User</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Alamat</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['UserID'] ?></td>
                        <td><?= $user['Username'] ?></td>
                        <td><?= $user['Email'] ?></td>
                        <td><?= $user['NamaLengkap'] ?></td>
                        <td><?= $user['Alamat'] ?></td>
                        <td><?= $user['role'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Data keanggotaan tidak tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature text-start mt-4">
        <p>Mengetahui:</p>
        <p>Kepala Sekolah</p>
        <br><br>
        <p><strong>Bapak Kepala Sekolah</strong></p>
    </div>

</body>

</html>
