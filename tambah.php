<?php include "koneksi/db.php"; ?>
<form method="POST" enctype="multipart/form-data" class="container mt-4">
    <h3>Tambah User</h3>
    <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
    <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <input type="file" name="foto" class="form-control mb-2" required>
    <button name="simpan" class="btn btn-success">Simpan</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</form>

<?php
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $foto     = $_FILES['foto']['name'];
    $tmp      = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "uploads/$foto");

    mysqli_query($conn, "INSERT INTO users (username, password, nama, foto) VALUES ('$username', '$password', '$nama', '$foto')");
    echo "<script>alert('Data berhasil ditambahkan');window.location='dashboard.php';</script>";
}
?>
