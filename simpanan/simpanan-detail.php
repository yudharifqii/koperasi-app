<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Simpanan</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Data Simpanan Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=simpanan" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali ke Data</a>
                    <hr>
                    <?php
                    $id_simpanan = $_GET['id'];
                    $query = $koneksi->query("select s.*, a.* from simpanan as s inner join anggota as a on s.anggota_id = a.id_anggota WHERE s.id='$id_simpanan'");
                    $pengguna = $query->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="card p-3">
                                <img src="assets/uploads/<?= $pengguna['foto'] ?>"
                                    class="img-fluid rounded-circle mb-3 mx-auto d-block"
                                    alt="Foto Profil Anggota"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <h4 class="mt-2"><?php echo htmlspecialchars($pengguna['nama_lengkap']); ?></h4>
                                <p class="text-muted"><?php echo htmlspecialchars($pengguna['email']); ?></p>
                                <a href="edit_profile.php" class="btn btn-primary mt-2">Edit Profil</a>
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="card p-4">
                                <h5 class="mb-3">Informasi Lengkap</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($pengguna['nama_lengkap']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($pengguna['email']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Nomor HP:</strong> <?php echo htmlspecialchars($pengguna['no_hp']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Alamat:</strong> <?php echo htmlspecialchars($pengguna['alamat']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status Akun:</strong>
                                        <span class="badge <?php echo ($pengguna['status_aktif'] == 'aktif' ? 'bg-success' : ($pengguna['status_aktif'] == 'pending' ? 'bg-warning' : 'bg-danger')); ?>">
                                            <?php echo htmlspecialchars(ucfirst($pengguna['status_aktif'])); ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Tanggal Bergabung:</strong> <?php echo htmlspecialchars(date('d F Y', strtotime($pengguna['created_at']))); ?>
                                    </li>
                                </ul>
                                <div class="mt-4 text-end">
                                    <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>