<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Database Test</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1">
        <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
        </tr>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $user): ?>
                <tr>
                    <td><?= $user['UserID'] ?></td>
                    <td><?= $user['Username'] ?></td>
                    <td><?= $user['Email'] ?></td>
                    <td><?= $user['NamaLengkap'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
