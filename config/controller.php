<?php

//function menampilkan data
function select($query)
{
    //panggil koneksi db
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

//Tambah data user 0 /ok
function tambah_user($post)
{

    global $db;

    $nm_user    = $post['nm_user'];
    $username   = $post['username'];
    $password   = $post['password'];
    $role       = $post['role'];
    
    //query add
    $query = "INSERT INTO user VALUES(null, '$nm_user', '$username', '$password', '$role')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//Tambah servis customer 1 /ok
function tambahData($post)
{

    global $db;

    $id_user        = $post['id_user'];
    $stnk           = $post['stnk'];
    $model          = $post['model'];
    $jenis_servis   = $post['jenis_servis'];
    $keluhan        = $post['keluhan'];
    
    //query add
    $query = "INSERT INTO tb_servis VALUES(null, '$id_user', '$stnk', '$model', '$jenis_servis', '$keluhan', CURRENT_TIMESTAMP()";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//Tambah pengerjaan 2 /ok
function tambahPgj($post)
{

    global $db;

    $id_servis      = $post['id_servis'];
    $pgj            = $post['pgj'];
    $ket            = $post['ket'];
    $estimasi       = $post['estimasi'];
    
    //query add
    $query = "INSERT INTO tb_pengerjaan VALUES (null, '$id_servis', '$pgj', '$ket', '$estimasi')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//Tambah saran 3 /ok
function tambahSrn($post)
{

    global $db;

    $id_servis      = $post['id_servis'];
    $saran_at       = $post['saran_at'];
    $saran_n        = $post['saran_n'];
    
    //query add
    $query = "INSERT INTO tb_saran VALUES (null, '$id_servis', '$saran_at', '$saran_n')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//delete 0 data user /
function delete_user($id_user) 
{
    global $db;

    //query
    $query = "DELETE FROM user WHERE id_user=$id_user";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//update 0 data users /ok
function update_users($post)
{
    global $db;

    $id_user       = $post['id_user'];
    $nm_user       = $post['nm_user'];
    $username      = $post['username'];
    $password      = $post['password'];
    $role          = $post['role'];

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //query update
    $query = "UPDATE user SET nm_user='$nm_user', username='$username', password='$password', role='$role' WHERE id_user = $id_user";
    
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
//update 1 data servis /ok
function update_servis($post)
{
    global $db;

    $id_servis     = $post['id_servis'];
    $id_user       = $post['id_user'];
    $stnk          = $post['stnk'];
    $model         = $post['model'];
    $jenis_servis  = $post['jenis_servis'];
    $keluhan       = $post['keluhan'];

    //query update
    $query = "UPDATE tb_servis SET id_user='$id_user', stnk='$stnk', model='$model', jenis_servis='$jenis_servis', keluhan='$keluhan' WHERE id_servis = $id_servis";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

//update 2 pengerjaan /ok
function update_pgj($post)
{
    global $db;

    $id_pgj         = $post['id_pgj'];
    $id_servis      = $post['id_servis'];
    $pgj            = $post['pgj'];
    $ket            = $post['ket'];
    $estimasi       = $post['estimasi'];

    //query update
    $query = "UPDATE tb_pengerjaan SET id_servis='$id_servis', pgj='$pgj', ket='$ket', estimasi='$estimasi' WHERE id_pgj = $id_pgj";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
//update 3 saran /ok
function update_saran($post)
{
    global $db;

    $id_saran       = $post['id_saran'];
    $id_servis      = $post['id_servis'];
    $saran_at       = $post['saran_at'];
    $saran_n        = $post['saran_n'];

    //query update
    $query = "UPDATE tb_saran SET id_servis='$id_servis', saran_at='$saran_at', saran_n='$saran_n' WHERE id_saran = $id_saran";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
