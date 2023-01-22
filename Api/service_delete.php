<?php

header('content-Type: application/json');

require '../config/app.php';

// request url delete/put
parse_str(file_get_contents('php://input'), $DELETE);

//menerima
$id_servis      = $DELETE['id_servis'];

//query
$query = "DELETE FROM tb_servis  WHERE id_servis = $id_servis";

mysqli_query($db, $query);

// cek data
if ($query) {

    $response = array(
        'status'            => true,
        'message'           => "Data successfully delete",
        'data service'      => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Failed delete data"
    );
}
echo json_encode($response);
