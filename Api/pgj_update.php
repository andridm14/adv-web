<?php

header('content-Type: application/json');

require '../config/app.php';

// request url delete/put
parse_str(file_get_contents('php://input'), $PUT);

//menerima
$id_pgj         = $PUT['id_pgj'];
$id_servis      = $PUT['id_servis'];
$pgj            = $PUT['pgj'];
$estimasi       = $PUT['estimasi'];

//query
$query = "UPDATE tb_pengerjaan SET id_servis='$id_servis', pgj='$pgj', estimasi='$estimasi' WHERE id_pgj = $id_pgj";

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
