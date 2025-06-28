<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Simpanan Anggota</h1>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Simpanan Anggota Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=simpanancreate" class="btn btn-info btn-sm">
                        <i class="fa fa-plus-circle"></i> Tambah Simpanan Anggota
                    </a>
                    <hr>


                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Jenis Simpanan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = $koneksi->query("select s.*, a.* from simpanan as s inner join anggota as a on s.anggota_id = a.id_anggota");
                            while ($row = $query->fetch_assoc()) {
                                $status = "<span class='badge badge-success'>Acc</span>";
                                if ($row['status_verifikasi'] == 'tolak') {
                                    $status = "<span class='badge badge-danger'>Ditolak</span>";
                                }
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['kode_anggota'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenis_simpanan'] ?></td>
                                    <td><?= $row['nominal'] ?></td>
                                    <td><?= $status ?></td>
                                    <td><a href="assets/upload/bukti/<?= $row['file_bukti'] ?>" target='_blank' class="btn btn-secondary"><i class="fa fa-file"></i></a></td>
                                    <td>
                                        <a href="?page=simpanandetail&id=<?= $row['id'] ?>" class="btn btn-secondary btn-circle btn-sm"><i class="fa fa-info"></i></a>
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