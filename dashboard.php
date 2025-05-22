<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi/db.php';
$data = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Data User</h2>
    <a href="tambah.php" class="btn btn-primary">+ Tambah User</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr><th>No</th><th>Username</th><th>Nama</th><th>Foto</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><img src="uploads/<?= $row['foto'] ?>" width="50"></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>
</html>
