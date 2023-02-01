<?php

// koneksi database
$server     = "localhost";
$username   = "root";
$password   = "root";
$database   = "coba";
$koneksi    = mysqli_connect($server, $username, $password, $database);

if(mysqli_connect_errno()) {
    echo "Gagal konek dengan Database" . mysqli_connect_errno();
}

// tangkap data yang dikirim dari Android
$username = $_POST['post_username'];
$password = $_POST['post_password'];

//proses periksa username dan password di database
$query = "SELECT * FROM user where username= '$username' AND password= '$password'";
$obj_query = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($obj_query);

// perikasa apakah login sudah benar
if ($data) {
    echo json_encode(
        array(
            'response' => true,
            'payload'  => array(
                "nm_user"   => $data["nm_user"],
                "username"  => $data["username"],
                "role"      => $data["role"]
            )
        )
    );
}else {
    echo json_encode(
        array(
            'response' => false,
            'payload'  => null
        )
    );
}
header('content-Type: application/json');