<?php

session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
    document.location.href = 'error.php';
    </script>";
    exit;
}

$_SESSION = [];

session_unset();
session_destroy();
header("location: login.php");
