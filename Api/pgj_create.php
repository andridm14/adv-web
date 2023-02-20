<?php

header('content-Type: application/json');

require '../config/app.php';

//menerima
$id_servis  = $_POST['id_servis'];
$pgj        = $_POST['pgj'];
$ket        = $_POST['ket'];
$estimasi   = $_POST['estimasi'];

//query add
$query = "INSERT INTO tb_pengerjaan VALUES(null, '$id_servis', '$pgj', '$ket', '$estimasi')";

mysqli_query($db, $query);

// cek data
if ($query) {

    // $response = $query;

    $response = array(
        'status'            => true,
        'message'           => "Data Post Success",
        'data pgj'          => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Data Not Found"
    );
}
echo json_encode($response);