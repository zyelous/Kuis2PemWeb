<?php
include "koneksi/db.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
?>

<form method="POST" enctype="multipart/form-data" class="container mt-4">
    <h3>Edit User</h3>
    <input type="text" name="username" value="<?= $data['username'] ?>" class="form-control mb-2" readonly>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control mb-2" required>
    <input type="file" name="foto" class="form-control mb-2">
    <button name="update" class="btn btn-warning">Update</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</form>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];

    if ($_FILES['foto']['name'] != '') {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "uploads/$foto");
        mysqli_query($conn, "UPDATE users SET nama='$nama', foto='$foto' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET nama='$nama' WHERE id=$id");
    }

    echo "<script>alert('Data berhasil diupdate');window.location='dashboard.php';</script>";
}
?>
