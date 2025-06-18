<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('location: landing/login-view.php');
}

include "template/header.php";
include "template/sidebar.php";
include "template/navbar.php";
include "dashboard/dashboard-pengguna.php";
include "template/footer.php";
