<?php

header('content-Type: application/json');

require '../config/app.php';

// request url delete/put
parse_str(file_get_contents('php://input'), $PUT);

//menerima
$id_servis      = $PUT['id_servis'];
$id_user        = $PUT['id_user'];
$stnk           = $PUT['stnk'];
$model          = $PUT['model'];
$jenis_servis   = $PUT['jenis_servis'];
$keluhan        = $PUT['keluhan'];

//query
$query = "UPDATE tb_servis SET id_user='$id_user', stnk='$stnk', model='$model', jenis_servis='$jenis_servis', keluhan='$keluhan' WHERE id_servis = $id_servis";

mysqli_query($db, $query);

// cek data
if ($query) {

    $response = array(
        'status'            => true,
        'message'           => "Data successfully update",
        'data service'      => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Failed to update data"
    );
}
echo json_encode($response);
