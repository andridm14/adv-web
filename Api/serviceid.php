<?php

header('content-Type: application/json');

require '../config/app.php';

$id_user = $_GET['id_user'];
$query = select("SELECT * FROM tb_servis WHERE id_user=$id_user");

// cek data
if ($query) {

    $response = array(
        'status'            => true,
        'message'           => "Data GET Success",
        'data service'      => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Data Not Found"
    );
}
echo json_encode($response);
