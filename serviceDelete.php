<?php
session_start();

//  block halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
    document.location.href = 'error.php;
    </script>";
    exit;
}
include 'config/app.php';

$id_servis = (int)$_GET['id_servis'];
if (delete_servis($id_servis) > 0) {
    echo "<script>
        alert('Service Berhasil Dihapus');
        document.location.href='service.php';
        </script>";
} else {
    echo "<script>
        alert('Service Gagal Dihapus');
        document.location.href='service.php';
        </script>";
}