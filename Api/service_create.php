<?php

header('content-Type: application/json');

require '../config/app.php';

//menerima
$id_user        = $_POST['id_user'];
$stnk           = $_POST['stnk'];
$model          = $_POST['model'];
$jenis_servis   = $_POST['jenis_servis'];
$keluhan        = $_POST['keluhan'];

//query
$query = "INSERT INTO tb_servis VALUES (null, '$id_user', '$stnk', '$model', '$jenis_servis', '$keluhan', CURRENT_TIMESTAMP())";

mysqli_query($db, $query);

// cek data
if ($query) {

    $response = array(
        'status'            => true,
        'message'           => "Data successfully added",
        'data service'      => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Failed to add data"
    );
}
echo json_encode($response);
