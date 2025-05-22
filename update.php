<?php
include 'koneksi/db.php'; 

if (isset($_POST['update'])) {
    $id     = $_POST['id'];
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    
    if ($_FILES['foto']['name'] != '') {
        $foto       = $_FILES['foto']['name'];
        $tmp        = $_FILES['foto']['tmp_name'];
        $path       = "uploads/" . $foto;
        if (move_uploaded_file($tmp, $path)) {
            $sql = "UPDATE users SET nama='$nama', email='$email', foto='$foto' WHERE id=$id";
        } else {
            echo "Gagal upload foto.";
            exit;
        }
    } else {
        $sql = "UPDATE users SET nama='$nama', email='$email' WHERE id=$id";
    }

    if (mysqli_query($koneksi, $sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error saat update: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak sah!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
