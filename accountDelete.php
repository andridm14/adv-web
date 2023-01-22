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

$id_user = (int)$_GET['id_user'];
if (delete_user($id_user) > 0) {
    echo "<script>
        alert('User Berhasil Dihapus');
        document.location.href='account.php';
        </script>";
} else {
    echo "<script>
        alert('User Gagal Dihapus');
        document.location.href='account.php';
        </script>";
}
