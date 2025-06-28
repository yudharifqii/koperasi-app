<div class="container-fluid">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_anggota = $_GET['id'];
        $status = $_POST['status'];
        $stmt = $koneksi->prepare('UPDATE users SET status_aktif=? WHERE id_anggota=?');
        $stmt->bind_param("ss", $status, $id_anggota);
        $stmt->execute();
        echo "<script>alert('Status Akun pengguna berhasil di $status kan!'); location.replace('?page=anggota');</script>";
    }
    ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Anggota</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Data Anggota Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=anggota" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali ke Data</a>
                    <hr>
                    <?php
                    $id_user = $_GET['id'];
                    $query = $koneksi->query("select u.*, a.* from users as u inner join anggota as a on u.id_anggota = a.id_anggota where u.id_anggota='$id_user'");
                    $anggota = $query->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="card p-3">
                                <img src="assets/uploads/<?= $anggota['foto'] ?>"
                                    class="img-fluid rounded-circle mb-3 mx-auto d-block"
                                    alt="Foto Profil Anggota"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <h4 class="mt-2"><?php echo htmlspecialchars($anggota['nama']); ?></h4>
                                <p class="text-muted"><?php echo htmlspecialchars($anggota['email']); ?></p>
                                <a href="edit_profile.php" class="btn btn-primary mt-2">Edit Profil</a>
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="card p-4">
                                <h5 class="mb-3">Informasi Lengkap</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>NIK:</strong> <?php echo htmlspecialchars($anggota['no_ktp']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($anggota['nama']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($anggota['email']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Nomor HP:</strong> <?php echo htmlspecialchars($anggota['no_hp']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Alamat:</strong> <?php echo htmlspecialchars($anggota['alamat']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status Akun:</strong>
                                        <span class="badge <?php echo ($anggota['status_aktif'] == 'aktif' ? 'bg-success' : ($anggota['status_aktif'] == 'pending' ? 'bg-warning' : 'bg-danger')); ?>">
                                            <?php echo htmlspecialchars(ucfirst($anggota['status_aktif'])); ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Tanggal Lahir:</strong> <?php echo htmlspecialchars(date('d F Y', strtotime($anggota['tanggal_lahir']))); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Jenis Kelamin:</strong> <?php echo ($anggota['jenis_kelamin'] == "L") ? "Laki-Laki" : "Perempuan"; ?>
                                    </li>
                                </ul>
                                <div class="mt-4 text-end">
                                    <?php
                                    if ($anggota['status_aktif'] == 'pending') {
                                        $tombol = "<a href='#' data-toggle='modal' data-target='#aktifkanModal' class='btn btn-success btn-sm'><i class='fa fa-check'></i> Aktifkan</a>
                      <a href='#' data-toggle='modal' data-target='#nonaktifkanModal' class='btn btn-danger btn-sm'><i class='fa fa-ban'></i> Non Aktifkan</a>
                      ";
                                    } else if ($anggota['status_aktif'] == 'aktif') {
                                        $tombol = "<a href='#' data-toggle='modal' data-target='#nonaktifkanModal' class='btn btn-danger btn-sm'><i class='fa fa-ban'></i> Non Aktifkan</a>
                      ";
                                    } else {
                                        $tombol = "<a href='#' data-toggle='modal' data-target='#aktifkanModal' class='btn btn-success btn-sm'><i class='fa fa-check'></i> Aktifkan</a>
                      ";
                                    }
                                    echo $tombol;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="aktifkanModal" tabindex="-1" role="dialog" aria-labelledby="modalAktifkan"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAktifkan">Aktifkan Akun</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin ingin mengaktifkan akun anggota ini?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="" method="post">
                    <input type="hidden" value="aktif" name="status">
                    <button class="btn btn-primary" type="submit">Aktifkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nonaktifkanModal" tabindex="-1" role="dialog" aria-labelledby="nonmodalAktifkan"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nonmodalAktifkan">Nonaktifkan Akun</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin ingin mengnonaktifkan akun anggota ini?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="" method="post">
                    <input type="hidden" value="nonaktif" name="status">
                    <button class="btn btn-danger" type="submit">Nonaktifkan</button>
                </form>
            </div>
        </div>
    </div>
</div>