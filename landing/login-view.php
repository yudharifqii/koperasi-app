<?php session_start();
include '../config/koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $koneksi->prepare("SELECT id_user, username, password, role, status_aktif FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if ($user['status_aktif'] != 'aktif') {
            $error = "Akun tidak aktif.";
        } elseif (password_verify($password, $user['password'])) {
            // Login berhasil
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Redirect berdasarkan role
            header("Location: ../index.php?page=dashboard.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "User tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">


<head>
    <meta charset="UTF-8">
    <title>Login Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Login Koperasi</h4>
                    </div>
                    <div class="card-body"> <?php if ($error): ?> <div class="alert alert-danger text-center"><?= $error ?></div> <?php endif; ?> <form method="POST">
                            <div class="mb-3"> <label>Username</label> <input type="text" name="username" class="form-control" required autofocus> </div>
                            <div class="mb-3"> <label>Password</label> <input type="password" name="password" class="form-control" required> </div>
                            <div class="d-grid"> <button class="btn btn-success" type="submit">Login</button> </div>
                        </form>
                    </div>
                    <div class="card-footer text-center"> Belum punya akun? <a href="register-view.php">Daftar di sini</a> </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>