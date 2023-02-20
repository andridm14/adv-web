<?php

header('content-Type: application/json');

require '../config/app.php';

//menerima
$stnk       = $_POST['stnk'];
$id_user    = $_POST['id_user'];
$model      = $_POST['model'];
$warna      = $_POST['warna'];
$tahun      = $_POST['tahun'];

//query add
$query = "INSERT INTO tb_kendaraan VALUES('$stnk', '$id_user', '$model', '$warna', '$tahun')";

mysqli_query($db, $query);

// cek data
if ($query) {

    // $response = $query

    $response = array(
        'status'            => true,
        'message'           => "Data successfully added",
        'data kendaraan'    => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Failed to add data"
    );
}
echo json_encode($response);
