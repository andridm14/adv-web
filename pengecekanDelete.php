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

$id_saran = (int)$_GET['id_saran'];
if (delete_saran($id_saran) > 0) {
    echo "<script>
        alert('Pengecekan Berhasil Dihapus');
        document.location.href='pengecekan.php';
        </script>";
} else {
    echo "<script>
        alert('Pengecekan Gagal Dihapus');
        document.location.href='pengecekan.php';
        </script>";
}