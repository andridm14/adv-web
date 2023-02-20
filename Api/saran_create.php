<?php

header('content-Type: application/json');

require '../config/app.php';

//menerima
$id_servis  = $_POST['id_servis'];
$stnk       = $_POST['stnk'];
$saran      = $_POST['saran'];

//query add
$query = "INSERT INTO tb_saran VALUES(null, '$id_servis', '$stnk', '$saran')";

mysqli_query($db, $query);

// cek data
if ($query) {

    // $response = $query;

    $response = array(
        'status'            => true,
        'message'           => "Data Post Success",
        'data saran'        => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Data Not Found"
    );
}
echo json_encode($response);