<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_GET['id'];
    $query = $koneksi->query("select u.*, p.* from users as u inner join profil_pengguna as p on u.id_user = p.id_user WHERE u.id_user='$id_user'");
    $pengguna = $query->fetch_assoc();
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $status_aktif = $_POST['status'];

    // Upload foto
    $foto_name = '';
    if ($_FILES['foto']['name'] != '') {
        $file_foto = $pengguna['foto']; //ambil foto pengguna
        if (file_exists('assets/uploads/' . $file_foto)) {
            unlink('assets/uploads/' . $file_foto);
        }
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_name = 'foto_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'assets/uploads/' . $foto_name);
    } else {
        $foto_name = $pengguna['foto'];
    }

    // Simpan ke tabel users
    $stmt2 = $koneksi->prepare("UPDATE users set username=?, email=?, role=?, status_aktif=? WHERE id_user=?");
    $stmt2->bind_param("sssss", $username, $email, $role, $status_aktif, $id_user);
    $stmt2->execute();
    $stmt2->close();

    // Simpan ke tabel anggota
    $stmt = $koneksi->prepare("UPDATE profil_pengguna SET nama_lengkap=?, no_hp=?, alamat=?, foto=? WHERE id_user=?");
    $stmt->bind_param("sssss", $nama, $no_hp, $alamat, $foto_name, $id_user);
    $stmt->execute();
    $stmt->close();

    if ($_POST['password'] != '') {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt3 = $koneksi->prepare('UPDATE users SET password=? WHERE id_user=?');
        $stmt3->bind_param("ss", $password, $id_user);
        $stmt3->execute();
        $stmt3->close();
    }



    echo "<script>alert('Perbaharui akun pengguna berhasil dilakukan!'); window.location = '?page=pengguna';</script>";
}
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Pengguna</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Perbaharui Data Pengguna Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=pengguna" class="btn btn-info btn-sm">
                        <i class="fa fa-arrow-left"></i> Kembali ke Data
                    </a>
                    <hr>
                    <?php
                    $id_user = $_GET['id'];
                    $query = $koneksi->query("select u.*, p.* from users as u inner join profil_pengguna as p on u.id_user = p.id_user WHERE u.id_user='$id_user'");
                    $pengguna = $query->fetch_assoc();
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">

                                <label class="mt-2">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required value="<?= $pengguna['nama_lengkap'] ?>">

                                <label class="mt-2">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="admin" <?php if ($pengguna['role'] == 'admin') echo "selected"; ?>>Admin</option>
                                    <option value="bendahara" <?php if ($pengguna['role'] == 'bendahara') echo "selected"; ?>>Bendahara</option>
                                </select>
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="4" required><?= $pengguna['alamat'] ?></textarea>
                                <label class="mt-2">No HP</label>
                                <input type="text" name="no_hp" class="form-control" required value="<?= $pengguna['no_hp'] ?>">
                            </div>
                            <div class="col-md-6">

                                <label class="mt-2">Username</label>
                                <input type="text" name="username" class="form-control" required value="<?= $pengguna['username'] ?>">
                                <label class="mt-2">Email</label>
                                <input type="email" name="email" class="form-control" required value="<?= $pengguna['email'] ?>">
                                <label class="mt-2">Password</label>
                                <input type="password" name="password" class="form-control">
                                <label class="mt-2">Upload Foto</label> <span class="text-danger">(Opsional)</span>
                                <input type="file" name="foto" class="form-control">
                                <label class="mt-2">Status Aktif</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="aktif" <?php if ($pengguna['status_aktif'] == 'aktif') echo "selected"; ?>>Aktif</option>
                                    <option value="nonaktif" <?php if ($pengguna['status_aktif'] == 'nonaktif') echo "selected"; ?>>Non Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success w-50"> <i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>