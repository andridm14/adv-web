<?php

header('content-Type: application/json');

require '../config/app.php';

//menerima
$nm_user    = $_POST['nm_user'];
$username   = $_POST['username'];
$password   = $_POST['password'];
$role       = $_POST['role'];

//query add
$query = "INSERT INTO user VALUES(null, '$nm_user', '$username', '$password', '$role')";

mysqli_query($db, $query);

// cek data
if ($query) {

    // $response = $query

    $response = array(
        'status'            => true,
        'message'           => "Data successfully added",
        'data user'         => $query
    );
} else {
    $response = array(
        'status'    => false,
        'message'   => "Failed to add data"
    );
}
echo json_encode($response);
