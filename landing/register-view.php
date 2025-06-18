<?php
include '../config/function.php';
include '../config/koneksi.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_anggota'];
    $nama = $_POST['nama'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $tgl_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jenis_kelamin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Upload foto
    $foto_name = '';
    if ($_FILES['foto']['name'] != '') {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_name = 'foto_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/uploads' . $foto_name);
    }

    // Simpan ke tabel anggota
    $stmt = $koneksi->prepare("INSERT INTO anggota (kode_anggota, nama, no_ktp, alamat, no_hp, tanggal_lahir, jenis_kelamin, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $kode, $nama, $no_ktp, $alamat, $no_hp, $tgl_lahir, $jk, $foto_name);
    $stmt->execute();
    $anggota_id = $stmt->insert_id;
    $stmt->close();

    // Simpan ke tabel users
    $stmt2 = $koneksi->prepare("INSERT INTO users (username, email, password, role, status_aktif, id_anggota, created_at) VALUES (?, ?, ?, 'anggota', 'aktif', ?, NOW())");
    $stmt2->bind_param("sssi", $username, $email, $password, $anggota_id);
    $stmt2->execute();
    $stmt2->close();

    echo "<script>alert('Registrasi berhasil!'); window.location = 'register-view.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Registrasi Anggota Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Form Registrasi Anggota Koperasi</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Kode Anggota</label>
                                    <input type="text" name="kode_anggota" value="<?= kodeOtomatis() ?>" class="form-control" required readonly>
                                    <label class="mt-2">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required>
                                    <label class="mt-2">No KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" required>
                                    <label class="mt-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                    <label class="mt-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="4" required></textarea>
                                    <label class="mt-2">No HP</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                    <label
                                        class="mt-2">Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                    <label class="mt-2">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                    <label class="mt-2">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <label class="mt-2">Upload Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success w-50">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        &copy; <?= date('Y') ?> Koperasi Simpan Pinjam
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>