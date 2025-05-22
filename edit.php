<?php
include 'koneksi/db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
    }
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
</head>
<body class="container py-5">
    <h2>Edit User</h2>
    <form method="POST">
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</body>
</html>