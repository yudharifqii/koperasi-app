<?php
$message = '';
$message_type = ''; // success or error


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_simpanan = $_POST['jenis_simpanan'];
    $jumlah = $_POST['jumlah'];


    // Validasi input
    if (empty($jenis_simpanan) || empty($jumlah) || !is_numeric($jumlah) || $jumlah <= 0) {
        $message = "Jenis simpanan dan jumlah harus diisi dengan benar.";
        $message_type = 'error';
    } else {
        $bukti_pembayaran_path = null;


        // Proses upload file bukti pembayaran
        if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "assets/uploads/bukti_simpanan/"; // Folder tempat menyimpan bukti pembayaran
            // Pastikan folder ini ada dan memiliki izin tulis
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }


            $file_name = uniqid() . "_" . basename($_FILES['bukti_pembayaran']['name']);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            // Periksa tipe file
            $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
            if (!in_array($imageFileType, $allowed_types)) {
                $message = "Maaf, hanya file JPG, JPEG, PNG & PDF yang diizinkan.";
                $message_type = 'error';
            } elseif ($_FILES['bukti_pembayaran']['size'] > 5000000) { // Max 5MB
                $message = "Maaf, ukuran file terlalu besar (maks 5MB).";
                $message_type = 'error';
            } else {
                if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $target_file)) {
                    $bukti_pembayaran_path = $target_file;
                } else {
                    $message = "Terjadi kesalahan saat mengunggah bukti pembayaran.";
                    $message_type = 'error';
                }
            }
        } else {
            // Jika tidak ada file diunggah atau ada error upload
            $message = "Mohon unggah bukti pembayaran.";
            $message_type = 'error';
        }


        if ($message_type != 'error') {
            // Ambil ID anggota dari sesi
            $id_user = $_SESSION['id_user'];


            // Query untuk mengambil data anggota, termasuk status simpanan pokok
            $sql = "SELECT * FROM users WHERE id_user = '$id_user'";
            $stmt = $koneksi->query($sql);
            $result = $stmt->fetch_assoc();
            $tgl = date('Y-m-d');

            // Masukkan data ke tabel transaksi_simpanan dengan status 'pending'
            $stmt_insert = $koneksi->prepare("INSERT INTO simpanan (anggota_id, jenis_simpanan, nominal, file_bukti, status_verifikasi) VALUES (?, ?, ?, ?, ?, 'pending')");
            $stmt_insert->bind_param("sisds", $tgl, $result['id_anggota'], $jenis_simpanan, $jumlah, $bukti_pembayaran_path);


            if ($stmt_insert->execute()) {
                $message = "Pengajuan simpanan berhasil. Menunggu verifikasi admin/bendahara.";
                $message_type = 'success';
            } else {
                $message = "Terjadi kesalahan saat menyimpan data: " . $stmt_insert->error;
                $message_type = 'error';
            }
            $stmt_insert->close();
        }
    }
}



?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Simpanan Anggota</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Simpanan Anggota Koperasi</h4>
                </div>
                <div class="card-body">

                    <?php
                    if (!empty($message)):
                    ?>
                        <div class="alert alert-<?= $message_type ?>">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>
                    <a href="?page=simpanan" class="btn btn-info btn-sm">
                        <i class="fa fa-arrow-left"></i> Kembali ke Data
                    </a>
                    <hr>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">

                                <label class="mt-2">Jenis Simpanan</label>
                                <select id="jenis_simpanan" name="jenis_simpanan" class="form-control" required>
                                    <option value="">-- Pilih Jenis Simpanan --</option>
                                    <option value="pokok">Simpanan Pokok</option>
                                    <option value="wajib">Simpanan Wajib</option>
                                    <option value="sukarela">Simpanan Sukarela</option>
                                </select>


                                <label class="mt-2">Jumlah (Rp .)</label>
                                <input type="number" name="jumlah" class="form-control" min="1000">

                                <label for="bukti_pembayaran">Unggah Bukti Pembayaran:</label>
                                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="form-control" accept=".jpg, .jpeg, .png, .pdf" required>
                                <small>Format: JPG, JPEG, PNG, PDF. Maksimal 5MB.</small>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success w-50"> <i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>