<?php

header('content-Type: application/json');

require '../config/app.php';

$query = select("SELECT * FROM tb_pengerjaan");

// cek data
if ($query) {

    $response = $query;

    //tampil seluruh response data
    // $response = array(
    //     'status'            => true,
    //     'message'           => "Data GET Success",
    //     'data pengerjaan'   => $query
    // );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Data Not Found"
    );
}
echo json_encode($response);
