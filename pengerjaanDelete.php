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

$id_pgj = (int)$_GET['id_pgj'];
if (delete_pgj($id_pgj) > 0) {
    echo "<script>
        alert('Pengerjaan Berhasil Dihapus');
        document.location.href='pengerjaan.php';
        </script>";
} else {
    echo "<script>
        alert('Pengerjaan Gagal Dihapus');
        document.location.href='pengerjaan.php';
        </script>";
}