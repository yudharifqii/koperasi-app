<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Pengguna</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pengguna Koperasi</h4>
                </div>
                <div class="card-body">
                    <a href="?page=penggunacreate" class="btn btn-info btn-sm"><i class="fa fa-plus-circle"></i> Tambah Pengguna</a>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = $koneksi->query("select u.*, p.* from users as u inner join profil_pengguna as p on u.id_user = p.id_user");
                            while ($row = $query->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['no_hp'] ?></td>
                                    <td>
                                        <a href="?page=penggunadetail&id=<?= $row['id_user'] ?>" class="btn btn-secondary btn-circle btn-sm"><i class="fa fa-info"></i></a>
                                        <a href="?page=penggunaedit&id=<?= $row['id_user'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="?page=penggunadelete&id=<?= $row['id_user'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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