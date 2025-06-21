<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Upload foto
    $foto_name = '';
    if ($_FILES['foto']['name'] != '') {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_name = 'foto_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'assets/uploads/' . $foto_name);
    }

    // Simpan ke tabel users
    $stmt2 = $koneksi->prepare("INSERT INTO users (username, email, password, role, status_aktif, id_anggota, created_at) VALUES (?, ?, ?, ?, 'aktif', null, NOW())");
    $stmt2->bind_param("ssss", $username, $email, $password, $role);
    $stmt2->execute();
    $user_id = $stmt2->insert_id;
    $stmt2->close();

    // Simpan ke tabel anggota
    $stmt = $koneksi->prepare("INSERT INTO profil_pengguna VALUES (null, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_id, $nama, $no_hp, $alamat, $foto_name);
    $stmt->execute();
    $stmt->close();



    echo "<script>alert('Tambah Akun pengguna, Berhasil Dilakukan!'); window.location = '?page=pengguna';</script>";
}
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Pengguna</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Data Pengguna Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=pengguna" class="btn btn-info btn-sm">
                        <i class="fa fa-arrow-left"></i> Kembali ke Data
                    </a>
                    <hr>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">

                                <label class="mt-2">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required>

                                <label class="mt-2">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="admin">Admin</option>
                                    <option value="bendahara">Bendahara</option>
                                </select>
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="4" required></textarea>
                                <label class="mt-2">No HP</label>
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                            <div class="col-md-6">

                                <label class="mt-2">Username</label>
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
                            <button type="submit" class="btn btn-success w-50"> <i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>