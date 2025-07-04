<?php
// Ambil ID anggota dari sesi
$id_user = $_SESSION['id_user'];


// Query untuk mengambil data anggota, termasuk status simpanan pokok
$sql = "SELECT * FROM users WHERE id_user = '$id_user'";
$stmt = $koneksi->query($sql);
$result = $stmt->fetch_assoc();
$sql = "SELECT nama, simpanan_pokok_dibayar FROM anggota WHERE id_anggota = '" . $result['id_anggota'] . "'";
$stmt = $koneksi->query($sql);
$result_anggota = $stmt->fetch_assoc();
?>
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>


    <?php
    if ($result_anggota['simpanan_pokok_dibayar'] == 0) {
        echo "<div class='alert alert-danger'>
        <p> <strong>Pembayaran simpanan pokok anggota belum dilakukan </strong></p>
        <p?> <a href='?page=simpanancreate'> klik disini untuk pembayaran</a></p>
        </div>
        ";
    }
    ?>


</div>