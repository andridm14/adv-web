<?php

header('content-Type: application/json');

require '../config/app.php';

$query = select("SELECT * FROM tb_saran INNER JOIN tb_servis ON tb_saran.id_servis = tb_servis.id_servis
INNER JOIN user ON tb_servis.id_user = user.id_user");

// $query = select("SELECT * FROM tb_servis
// INNER JOIN tb_pengerjaan ON tb_servis.id_servis=tb_pengerjaan.id_servis
// INNER JOIN tb_saran ON tb_servis.id_servis=tb_saran.id_servis WHERE tb_servis.id_user");


// cek data
if ($query) {

    $response = $query;

    //tampil seluruh response data
    // $response = array(
    //     'status'            => true,
    //     'message'           => "Data GET Success",
    //     'data saran'        => $query
    // );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Data Not Found"
    );
}
echo json_encode($response);
