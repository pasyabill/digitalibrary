<?php
include 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $query = "SELECT id_user, username, role FROM user WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo "<script>
                alert('Pengguna tidak ditemukan.');
                window.location.href = 'admin.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ID Pengguna tidak ditemukan.');
            window.location.href = 'admin.php';
          </script>";
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

  <div class="container">
    <h2 class="text-center mb-4">Edit Pengguna</h2>
    <form action="update_user.php" method="POST">
        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
            <span class="text-muted">*Username cannot be changed</span>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role">
                <option value="user" <?= ($user['role'] == 'user') ? 'selected' : ''; ?>>User </option>
                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-danger btn-block">Simpan Perubahan</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>