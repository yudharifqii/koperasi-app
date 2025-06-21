<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('location: landing/login-view.php');
}

$page = ($_GET['page'] == '') ? 'dashboard' : $_GET['page'];

include "config/koneksi.php";
include "template/header.php";
include "template/sidebar.php";
include "template/navbar.php";
if ($page == "dashboard") {
    if ($_SESSION['role'] == 'anggota') {
        include "dashboard/dashboard-anggota.php";
    } else {
        include "dashboard/dashboard-pengguna.php";
    }
} else if ($page == "pengguna") {
    include "pengguna/pengguna-view.php";
} else if ($page == "penggunacreate") {
    include "pengguna/pengguna-create.php";
} else if ($page == "penggunadetail") {
    include "pengguna/pengguna-detail.php";
} else if ($page == "penggunaedit") {
    include "pengguna/pengguna-edit.php";
}
include "template/footer.php";
