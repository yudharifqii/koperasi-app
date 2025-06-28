<?php
if ($_SESSION['role'] == 'anggota'):
    echo "<script>location.replace('?page=dashboard');</script>";
endif;
?>
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Anggota</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Anggota Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=anggotacreate" class="btn btn-info btn-sm"><i class="fa fa-plus-circle"></i> Tambah Anggota</a>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Anggota</th>
                                <th>Username</th>
                                <th>Nama Anggota</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Status Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = $koneksi->query("select u.*, a.* from users as u inner join anggota as a on u.id_anggota = a.id_anggota");
                            while ($row = $query->fetch_assoc()) {
                                $status = "<span class='badge badge-success'>Aktif</span>";
                                if ($row['status_aktif'] == 'nonaktif') {
                                    $status = "<span class='badge badge-danger'>Non Aktif</span>";
                                } else if ($row['status_aktif'] == 'pending') {
                                    $status = "<span class='badge badge-warning'>Pending</span>";
                                }
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode_anggota'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['no_hp'] ?></td>
                                    <td><?= $status ?></td>
                                    <td>
                                        <a href="?page=anggotadetail&id=<?= $row['id_anggota'] ?>" class="btn btn-secondary btn-circle btn-sm"><i class="fa fa-info"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>